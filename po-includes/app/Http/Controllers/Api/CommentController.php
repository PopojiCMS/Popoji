<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(Request $request, $id)
    {
        $parent = $request->parent ?: null;
        $orderBy = $request->orderBy == 'ASC' ? 'ASC' : 'DESC';
        $per_page = $request->per_page ?: 20;
        $post = Post::where('id',  $id)->where('active', 'Y')->first();
        if(!$post){
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }
        $query = Comment::query();
        if($parent) {
            $query->where('post_id', $id)->where('parent', $parent);
        } else {
            $query->where('post_id', $id)->where('parent', 0);
        }
        // OrderBy post
        if($orderBy != null) {
            $query->orderBy('created_at', $orderBy);
        }
        $comments = $query->withCount(['children as replies'])->where('active', 'Y')->where('status', 'Y')->paginate($per_page);
        if($comments) {
            $comments->makeHidden(['post_id', 'email', 'created_by', 'updated_by']);
        }
        return response()->json($comments);
    }
}
