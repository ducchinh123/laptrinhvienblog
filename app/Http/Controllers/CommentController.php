<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    //

    public function IndexComment()
    {
        $comments_list = DB::table('comments')->join('users', 'users.id', '=', 'comments.user_id')->join('posts_tbl', 'posts_tbl.id', '=', 'comments.commentable_id')->select('users.username', 'users.email', 'comments.id', 'comments.created_at', 'comments.body', 'posts_tbl.title')->paginate(10);
        return view('admin.comment.index', compact('comments_list'));
    }
    public function SearchComment(Request $request)
    {
        if ($request->isMethod('POST')) {
            $comments_list = DB::table('comments')->join('users', 'users.id', '=', 'comments.user_id')->join('posts_tbl', 'posts_tbl.id', '=', 'comments.commentable_id')->where('comments.body', 'like', "%" . $request->body . "%")->select('users.username', 'users.email', 'comments.id', 'comments.created_at', 'comments.body', 'posts_tbl.title')->paginate(10);
            return view('admin.comment.index', compact('comments_list'));
        }
    }

    public function DeleteComment(Request $request)
    {

        $id = $request->id;
        if ($id > 0) {

            $check_parent = DB::table('comments')->where('id', $id)->whereNull('parent_id')->exists();

            if ($check_parent) {
                $comment = DB::table('comments')->where('id', $id)->delete();
            } else {
                $comment_child = DB::table('comments')->where('parent_id', $id)->select('id')->get()->pluck('id')->toArray();
                $comment = DB::table('comments')->where('id', $id)->delete();

                foreach ($comment_child as $id) {
                    $comment = DB::table('comments')->where('id', $id)->delete();
                }

            }

            return response()->json(['message' => 'Delete Successfully'], 200);
        }
    }
}
