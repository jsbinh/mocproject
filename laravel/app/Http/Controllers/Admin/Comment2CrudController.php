<?php

namespace Framework\Http\Controllers\Admin;

use Framework\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class Comment2CrudController
 * @package Framework\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class Comment2CrudController extends CommentCrudController
{
    public function post(Request $request)
    {
        $changeId = $request->input('change_id');
        $content = $request->input('content');

        // Comment
        $comment = new Comment;
        $comment->change_id = $changeId;
        $comment->content = $content;
        $comment->user_id = backpack_user()->id;
        $comment->save();

        return response()->json(['data' => $comment->toArray() + ['user' => backpack_user()]]);
    }
}
