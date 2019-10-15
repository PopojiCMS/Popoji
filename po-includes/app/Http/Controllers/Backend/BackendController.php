<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;
use App\Comment;
use App\Pages;
use App\Contact;
use App\Component;
use App\Theme;
use App\User;

class BackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
		$post = Post::where('active', '=', 'Y')->count();
		$category = Category::where('active', '=', 'Y')->count();
		$tag = Tag::count();
		$comment = Comment::where('active', '=', 'Y')->count();
		$commentunread = Comment::where('status', '=', 'N')->count();
		$pages = Pages::where('active', '=', 'Y')->count();
		$contactunread = Contact::where('status', '=', 'N')->count();
		$component = Component::where('active', '=', 'Y')->count();
		$theme = Theme::where('active', '=', 'Y')->count();
		$user = User::where('block', '=', 'N')->count();
		$populars = Post::where('active', '=', 'Y')->orderBy('hits', 'desc')->limit(5)->get();
		
		return view('backend.dashboard', compact('post', 'pages', 'category', 'tag', 'comment', 'commentunread', 'pages', 'contactunread', 'component', 'theme', 'user', 'populars'));
    }
	
	/**
     * Display forbidden pages.
     *
     * @return void
     */
    public function forbidden()
    {
		return view('backend.forbiden');
	}
}
