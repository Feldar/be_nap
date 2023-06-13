<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileuploadController extends Controller
{
    function upload(Request $request){
        $result = $request->file('file')->store('./fileuploads');

        return $result;
    }

    function download(Request $request){
        $path = public_path('storage/fileuploads/AJkwppUqYKCJZ14f03xODT3wUB9w7YJq9TPL8X7Y.png');
        return response()->download($path);
    }
}
