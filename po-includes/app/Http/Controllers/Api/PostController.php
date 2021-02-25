<?php

namespace App\Http\Controllers\Api;

use App\PostGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function get(Request $request)
    {
        $per_page = $request->per_page ?: 20;
        $category = $request->category ?: null;
        $search =  $request->search ?: null;
        $headline = $request->headline == 'Y' ? 'Y' : null;
        $orderBy = $request->orderBy == 'ASC' ? 'ASC' : 'DESC';
        $query = Post::with(['category:id,parent,title,seotitle,picture', 'createdBy:id,name,username,bio,picture', 'updatedBy:id,name,username,bio,picture'])->withCount('comments')->where('active', 'Y');
        // Filter post by category
        if($category != null) {
            $query->where('category_id', $category);
        }
        // Search post
        if($search != null) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }
        // Headline post
        if($headline != null) {
            $query->where('headline', $headline);
        }
        // OrderBy post
        if($orderBy != null) {
            $query->orderBy('created_at', $orderBy);
        }
        $posts = $query->paginate($per_page);
        foreach($posts as $post){
            // Change picture to url for get image.
            if($post->picture != null) {
                $post->picture = url('/po-content/uploads/' . $post->picture);
            }
        }
        if($posts) {
            // Hidden key
            $posts->makeHidden(['created_by', 'updated_by', 'category_id', 'active']);
        }
        return response()->json($posts);
    }
    public function show(Request $request, $id)
    {
        $post = Post::where('id',  $id)->with(['category:id,parent,title,seotitle,picture', 'createdBy:id,name,username,bio,picture', 'updatedBy:id,name,username,bio,picture'])->withCount('comments')->where('active', 'Y')->first();
        if(!$post){
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }
        if($post->picture != null) {
            $post->picture = url('/po-content/uploads/' . $post->picture);
        }
        if($post->type == 'picture') {
            $post->galleries = PostGallery::where('post_id', $post->id)->get();
            if($post->galleries) {
                $post->galleries->makeHidden(['post_id', 'created_by', 'updated_by', 'created_at', 'updated_at']);
            }
            foreach ($post->galleries as $gallery) {
                $gallery->picture = url('/po-content/uploads/' . $gallery->picture );
            }
        }
        $segment = isset($request->segment) ? $request->segment : 1;
        $expcontent = explode('<hr />', $post->content);
        $paginator = $this->customPaginate($expcontent, 1, $segment, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'segment'
        ]);
        $content = '';
        if($post->type == 'pagination') {
            if(count($expcontent) > 0) {
                $content = $expcontent[$segment-1];
            } else {
                $content = $post->content;
            }
        } else {
            $content = $post->content;
        }
        $post->content = $content;
        $post->pagination = $paginator;
            // Update hits
        $post->increment('hits');
        // Hidden key
        $post->makeHidden(['created_by', 'updated_by', 'category_id', 'active']);
        return response()->json($post);
    }
    public function related(Request $request, $id)
    {
        $per_page = $request->per_page ?: 10;
        $orderBy = $request->orderBy == 'ASC' ? 'ASC' : 'DESC';
        $post = Post::where('id',  $id)->where('active', 'Y')->first();
        if(!$post){
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        $query = Post::with(['category:id,parent,title,seotitle,picture', 'createdBy:id,name,username,bio,picture', 'updatedBy:id,name,username,bio,picture'])
            ->withCount('comments')
            ->where('active', 'Y')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id);

        // OrderBy post
        if($orderBy != null) {
            $query->orderBy('created_at', $orderBy);
        }

        $related = $query->paginate($per_page);
        return response()->json($related);
    }
    public static function customPaginate($items, $perPage = 1, $page = null, $options = [])
    {

        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

        return [
            'current_page' => $lap->currentPage(),
            'data' => $lap ->values(),
            'first_page_url' => $lap ->url(1),
            'from' => $lap->firstItem(),
            'last_page' => $lap->lastPage(),
            'last_page_url' => $lap->url($lap->lastPage()),
            'next_page_url' => $lap->nextPageUrl(),
            'per_page' => $lap->perPage(),
            'prev_page_url' => $lap->previousPageUrl(),
            'to' => $lap->lastItem(),
            'total' => $lap->total(),
        ];
    }
}
