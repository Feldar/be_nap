<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileuploadController extends Controller
{
    function upload(Request $request){
        $originalname = $request->file->getClientOriginalName();
        $result = $request->file('file')->store('files', ['disk' => 'my_files']);

        return $result;
    }

    function download(Request $request){
        $myFilePath = $request->query('myFilePath');
        $path = public_path($myFilePath);
        return response()->download($path);
    }
}
