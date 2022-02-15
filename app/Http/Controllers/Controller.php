<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($response)
    {
        return response()->json([
            'success' => true,
            'data' => $response
        ]);
    }

    public function responseFail($code, $error = null)
    {
        return response()->json([
            'success' => false,
            'error_code' => $code,
            'message' => $error
        ], $code);
    }

    public function responseDelete($message = null)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function uploadFile($file, $path)
    {
        $filename = md5($file->getClientOriginalName()).time().'.'.$file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs($path, $file, $filename);
        return Storage::url($path.'/'.$filename);
    }
}
