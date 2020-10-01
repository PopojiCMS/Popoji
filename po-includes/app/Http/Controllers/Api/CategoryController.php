<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function get(Request $request)
    {
        $per_page = $request->per_page ?: 20;
        $search =  $request->search ?: null;
        $orderBy = $request->orderBy == 'ASC' ? 'ASC' : 'DESC';

        $query = Category::where('active', 'Y')->withCount('posts');
        // Search category
        if($search != null) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }
        if($orderBy != null) {
            $query->orderBy('created_at', $orderBy);
        }
        $categories = $query->paginate($per_page);
        foreach($categories as $category){
            // Change picture to url for get image.
            if($category->picture != null) {
                $category->picture = url('/po-content/uploads/' . $category->picture);
            }
        }
        if($categories) {
            // Hidden key
            $categories->makeHidden(['created_by', 'updated_by', 'active']);
        }
        return response()->json($categories);
    }
    public function show($id)
    {
        $category = Category::where('id', $id)->withCount('posts')->first();
        if(!$category){
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }
        if($category->picture != null) {
            $category->picture = url('/po-content/uploads/' . $category->picture);
        }
        $category->makeHidden(['created_by', 'updated_by', 'active']);
        return response()->json($category);
    }
}
