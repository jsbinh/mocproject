<?php

namespace Framework\Http\Controllers\Admin;

use Framework\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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

        $changeId = json_decode($request->input('meta'), true)['change_id'];
        $meta = [
            'original_name' => $file->getClientOriginalName(),
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
        $attachment->user_id = backpack_user()->id;
        $attachment->save();

        return response()->json(['data' => $attachment->toArray() + ['user' => backpack_user()]]);
        /*try{
            DB::transaction(function () use ($request){
                $file = $request->file;
                $path = $file->store('attachments/' . date('Ym', now()->timestamp));

                $changeId = json_decode($request->input('meta'), true)['change_id'];
                $meta = [
                    'original_name' => $file->getClientOriginalName(),
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
                $attachment->user_id = backpack_user()->id;
                $attachment->save();

                return response()->json(['data' => $attachment->toArray() + ['user' => backpack_user()]]);
            });
        }catch (\Exception $e){
            return 'Server error! Can not upload file! Please try again!';
        }*/
    }

    public function download(Request $request, string $id = null)
    {
        try{
            $path = $request->input('path');
            $attachment = Attachment::query()->find($id);
            if ($attachment) {
                return Storage::download($attachment->path, $attachment->name);
            }

            if($path){
                return Storage::download($path);
            }
            return 'Can not find file!';
        }catch (\Exception $e){
            return 'Can not find file! Please check again!';
        }
    }

    public function remove(Request $request, string $id)
    {
        return response()->json(['result' => (new Attachment)->find($id)->delete()]);
    }
}
