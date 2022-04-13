<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $files = File::where('userId', '=', Auth::user()->id)->get();
        $totalSize = null;
        foreach ($files as $file) {
            $totalSize += $file->sizeInBytes;
        }
        $data = array(
            'user' => $user,
            'files' => $files,
            'totalSize' => $totalSize,
        );
        return view('files/index')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => ['required'],
            'parentFolder' => ['required'],
        ]);

        // Handle File Upload
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $fileSize = $file->getSize();
            $filenameWithExt = $file->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = strtolower($file->getClientOriginalExtension());

            $fileNameToStore = md5($filename . '_' . time()) . '.' . $extension;

            $path = $file->storeAs('public/files/original/', $fileNameToStore);

            if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp', 'bmp'])) {
                // make thumbnails

                $resize_grid_image = Image::make($file)->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resize_large_image = Image::make($file)->resize(740, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $resize_thumb_image = Image::make($file)->fit(200, 200);

                $folder_path = 'storage/files/';
                if (getimagesize($file)[0] > 200) {
                    $resize_thumb_image->save($folder_path . 'thumb/' . $fileNameToStore);
                    $resize_grid_image->save($folder_path . 'grid/' . $fileNameToStore);
                    $resize_large_image->save($folder_path . 'large/' . $fileNameToStore);
                }
            }
        } else {
            return redirect()->back()->with('danger', 'No Media Selected.');
        }

        $newFile = new File();
        $newFile->name = $filenameWithExt;
        $newFile->slugname = $fileNameToStore;
        $newFile->sizeInBytes = $fileSize;
        $newFile->sizeFormatted = formatBytes($fileSize);
        $newFile->extension = $extension;
        $newFile->type = getFileTypeFromExtension($extension);
        if ($newFile->type == 'image') {
            $imageSize = getimagesize($file);
            $newFile->width = $imageSize[0];
            $newFile->height = $imageSize[1];
            $newFile->dimension = getOrientationOfImage($imageSize[0], $imageSize[1]);
        }
        $newFile->parentFolder = $request->get('parentFolder');
        $newFile->userId = Auth::user()->id;

        $newFile->save();

        return redirect()->back()->with('success', 'File Uploaded Successfully.');
    }

    public function toggleFileStarred(Request $request)
    {
        $file = File::where('slugName', '=', $request->get('slug'))->first();
        if ($file) { //if file is found
            if ($file->userId == Auth::user()->id) { //if current auth user is owner of requested file.
                $file->starred = !$file->starred;
                $file->save();

                $message = '';
                if ($file->starred == true) {
                    $message = 'File has been starred.';
                } else {
                    $message = 'File has been unstarred.';
                }
                return response()->json([
                    'success' => 1,
                    'message' => $message,
                    'data' => [
                        'selector' => explode('.', $file->slugName)[0],
                        'status' => $file->starred,
                    ],
                ]);
            } else { //if current auth user is not owner of requested file.
                return response()->json([
                    'success' => 0,
                    'message' => 'Unauthorized Action !',
                    'data' => null,
                ]);
            }
        } else { //if file is not found
            return response()->json([
                'success' => 0,
                'message' => 'File Not Found !',
                'data' => null,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required',
        ]);

        $file = File::where('slugName', '=', $request->get('slug'))->first();

        if ($file) { //file found
            if ($file->userId == Auth::user()->id) { //current auth user is the owner of the file.

                //check if files are present in the filesystem, if yes then delete them.
                if (Storage::exists('public/files/original/' . $file->slugName)) {
                    Storage::delete('public/files/original/' . $file->slugName);
                }
                if (Storage::exists('public/files/large/' . $file->slugName)) {
                    Storage::delete('public/files/large/' . $file->slugName);
                }
                if (Storage::exists('public/files/grid/' . $file->slugName)) {
                    Storage::delete('public/files/grid/' . $file->slugName);
                }
                if (Storage::exists('public/files/thumb/' . $file->slugName)) {
                    Storage::delete('public/files/thumb/' . $file->slugName);
                }

                $file->delete();
                return response()->json([ //return success response
                    'success' => 1,
                    'message' => 'File deleted Successfully',
                    'data' => [
                        'selector' => explode('.', $file->slugName)[0],
                    ],
                ]);
            } else { //current auth user is not the owner of the file.
                return response()->json([
                    'success' => 0,
                    'message' => 'UnAuthorized Action.',
                    'data' => null,
                ]);
            }
        } else { //file not found
            return response()->json([
                'success' => 0,
                'message' => 'File Not Found !',
                'data' => null,
            ]);
        }
    }
}
