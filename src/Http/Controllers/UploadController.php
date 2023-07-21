<?php

namespace Mr4Lax\TinyMce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function tinyMCEUpload()
    {
        $request = request();
        $url = null;
        try {
            if ($request->has('file')) {
                $thumb = $request->file('file')->store(config('admin.extensions.mr4lax.tinymce.upload.store', 'public/mr4lax/tinymce'));
                $url = Storage::url($thumb);
                $message = trans('mr4laxtinymce.upload.succeeded');
            } else {
                $message = trans('mr4laxtinymce.upload.no_content');
            }
        } catch (\Exception $ex) {
            $message = $ex->getMessage();
            return response([
                'message' => trans('mr4laxtinymce.upload.failed'),
                'error' => $message,
            ], 400);
        }

        $url = url($url);

        return response([
            'message' => $message,
            'url' => $url,
            'location' => $url,
        ], 200);
    }
}
