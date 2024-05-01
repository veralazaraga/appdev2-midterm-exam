<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class UploadFileController extends Controller
{
    public function uploadLocal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put($filename, file_get_contents($file));

        return response()->json([
            'message' => 'File uploaded successfully!',
            'filename' => $filename
        ]);
    }

    public function uploadPublic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        Storage::disk('public')->put($filename, file_get_contents($file));

        return response()->json([
            'message' => 'File uploaded successfully!',
            'filename' => $filename
        ]);
    }
}
