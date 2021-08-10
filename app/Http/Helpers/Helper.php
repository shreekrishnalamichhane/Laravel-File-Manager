<?php

if (!function_exists('sendSimpleMail')) {
    function sendSimpleMail($to, $subject, $content)
    {
        $from_name    = env('MAIL_FROM_NAME', 'Test');
        $from_address = env('MAIL_FROM_ADDRESS', 'test@gmail.com');
        Mail::send('emails.simpleEmail', ['content' => $content], function ($message) use ($to, $from_name, $from_address, $subject, $content) {
            $message->from($from_address, $from_name);
            $message->subject($subject);
            $message->to($to);
        });
        return response()->json(['message' => 'Request completed']);
    }
}

if (!function_exists('generateUsername')) {
    function generateUsername($name)
    {
        return strtolower($name . rand(100, 999));
    }
}
if (!function_exists('render_breadcrumb')) {
    function render_breadcrumb()
    {
        $uri = \Request::getRequestUri();
        $uri = explode('/', $uri);

        $ret = '<nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">';
        $ret = $ret . '<li class="breadcrumb-item"><a class="text-nowrap" href="/"><i        class="ci-home"></i>Home</a></li>';

        for ($i = 1; $i < count($uri); $i++) {
            $ret = $ret . '<li class="breadcrumb-item text-nowrap"><a href="#">' . ucfirst($uri[$i]) . '</a></li>';
        }

        $ret .= "</ol></nav>";
        return $ret;
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($size, $precision = 2)
    {
        $base     = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}

if (!function_exists('activeMenuItem')) {
    function activeMenuItem($i)
    {
        $uri = \Request::getRequestUri();
        $uri = explode('/', $uri);
        return ($i == $uri[1]) ? 'active' : '';

    }
}
if (!function_exists('getFileTypeFromExtension')) {
    function getFileTypeFromExtension($ext)
    {
        $extensions = [
            'jpg'   => 'image',
            'jpeg'  => 'image',
            'gif'   => 'image',
            'png'   => 'image',
            'm4a'   => 'audio',
            'flac'  => 'audio',
            'mp3'   => 'audio',
            'wav'   => 'audio',
            'wma'   => 'audio',
            'aac'   => 'audio',
            'mp4'   => 'video',
            'mov'   => 'video',
            'wmv'   => 'video',
            'avi'   => 'video',
            'avchd' => 'video',
            'flv'   => 'video',
            'f4v'   => 'video',
            'swf'   => 'video',
            'mkv'   => 'video',
            'webm'  => 'video',
            'mpeg'  => 'video',
            'pdf'   => 'files',
            'xlsx'  => 'files',
            'doc'   => 'files',
            'docx'  => 'files',
            'pptx'  => 'files',
            'exe'   => 'files',
            'txt'   => 'files',
            'zip'   => 'files',
            'rar'   => 'files',
            'eps'   => 'files',
            'raw'   => 'files',
            'psd'   => 'files',
            'ai'    => 'files',
            'indd'  => 'files',
            'ico'   => 'files',
            'tiff'  => 'files',
            'tif'   => 'files',
            'bmp'   => 'files',
        ];

        if (array_key_exists($ext, $extensions)) {
            return $extensions[$ext];
        }
        return 'other';

    }
}

if (!function_exists('getOrientationOfImage')) {
    function getOrientationOfImage($length, $breadth)
    {
        return $length . 'x' . $breadth . ' px';
    }
}
