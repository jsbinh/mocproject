<?php

namespace Framework\Http\Controllers\Admin;

use Framework\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Log;
use Storage;

/**
 * Class Attachment2CrudController
 * @package Framework\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Attachment2CrudController extends AttachmentCrudController
{
    public function upload(Request $request)
    {
        $file = $request->file;
        $path = $file->store('attachments/' . date('Ym', now()->timestamp));

        $changeId = json_decode($request->input('meta'), true)['id'];
        $meta = [
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'time' => now()->timestamp
        ];

        // Attachment
        $attachment = new Attachment;
        $attachment->change_id = $changeId;
        $attachment->name = $meta['original_name'];
        $attachment->path = $path;
        $attachment->meta = json_encode($meta);
        $attachment->save();

        return response()->json(['data' => $attachment->toArray()]);
    }

    public function download(Request $request, string $id = null)
    {
        $path = $request->input('path');

        $attachment = new Attachment;
        $attachment = $attachment->find($id);

        if ($attachment) {
            return Storage::download($attachment->path, $attachment->name);
        }

        return Storage::download($path);
    }

    public function remove(Request $request, string $id)
    {
        return response()->json(['result' => (new Attachment)->find($id)->delete()]);
    }
}
