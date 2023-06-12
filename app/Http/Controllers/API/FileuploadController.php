<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileuploadController extends Controller
{
    function upload(Request $request){
        $result = $request->file('file')->store('/public/fileuploads');

        return $result;
    }

    function download(Request $request){
        $path = public_path('fileuploads');
        return response()->download($path);
    }
}
