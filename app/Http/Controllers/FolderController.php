<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function my_drive()
    {
        $user = Auth::user();
        $files = File::where('parentFolder', '=', 'my-drive')->get();
        $folders = Folder::where('parentFolder', '=', 'my-drive')->get();
        $totalSize = null;
        foreach ($files as $file) {
            $totalSize += $file->sizeInBytes;
        }
        $data = array(
            'user' => $user,
            "files" => $files,
            "folders" => $folders,
            'totalSize' => $totalSize,
            'selfSlug' => 'my-drive',
        );
        return view('files.index')->with('data', $data);
    }

    public function starred()
    {
        $user = Auth::user();
        $files = File::where('userId', '=', Auth::user()->id)->where('starred', '=', true)->get();
        $totalSize = null;
        foreach ($files as $file) {
            $totalSize += $file->sizeInBytes;
        }
        $data = array(
            'user' => $user,
            "files" => $files,
            'totalSize' => $totalSize,
            'selfSlug' => 'my-drive',
        );
        return view('files/starred')->with('data', $data);
    }

    public function index($slug)
    {
        $user = Auth::user();
        $files = File::where('parentFolder', '=', $slug)->get();
        $folders = Folder::where('parentFolder', '=', $slug)->get();
        $totalSize = null;
        foreach ($files as $file) {
            $totalSize += $file->sizeInBytes;
        }
        $data = array(
            'user' => $user,
            "files" => $files,
            "folders" => $folders,
            'totalSize' => $totalSize,
            'selfSlug' => $slug,
        );
        return view('files.index')->with('data', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'parentFolder' => ['required'],
        ]);

        $newFolder = new Folder;
        $newFolder->name = $request->get('name');
        $newFolder->slugName = getRandomSlug(20);
        $newFolder->parentFolder = $request->get('parentFolder');
        $newFolder->userId = Auth::user()->id;
        $success = $newFolder->save();
        if ($success) {
            return redirect()->back()->with('success', 'File Uploaded Successfully.');
        } else {
            return redirect()->back()->with('danger', 'Something Went Wrong.');
        }
    }
}
