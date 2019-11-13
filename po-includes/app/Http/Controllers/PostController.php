<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Validator;

use App\Post;
use App\Comment;

use DB;

class PostController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($seotitle)
    {
		$checkpost = Post::where([['seotitle', '=', $seotitle],['active', '=', 'Y']])->first();
		
		if($checkpost) {
			$checkpost->update([
				'hits' => DB::raw('hits+1')
			]);
			
			$post = Post::leftJoin('users', 'users.id', 'posts.created_by')
				->leftJoin('categories', 'categories.id', 'posts.category_id')
				->where([['posts.seotitle', '=', $seotitle],['posts.active', '=', 'Y']])
				->select('posts.*', 'categories.title as ctitle', 'categories.seotitle as cseotitle', 'users.name')
				->orderBy('posts.id', 'desc')
				->withCount('comments')
				->first();
			
			$twitterid = explode('/', getSetting('twitter'));
			SEOTools::setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::setDescription($post->meta_description);
			SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
			SEOTools::setCanonical(getSetting('web_url'));
			SEOTools::opengraph()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::opengraph()->setDescription($post->meta_description);
			SEOTools::opengraph()->setUrl(getSetting('web_url'));
			SEOTools::opengraph()->setSiteName(getSetting('web_author'));
			SEOTools::opengraph()->addImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
			SEOTools::twitter()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::twitter()->setDescription($post->meta_description);
			SEOTools::twitter()->setUrl(getSetting('web_url'));
			SEOTools::twitter()->setImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			SEOTools::jsonLd()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::jsonLd()->setDescription($post->meta_description);
			SEOTools::jsonLd()->setType('WebPage');
			SEOTools::jsonLd()->setUrl(getSetting('web_url'));
			SEOTools::jsonLd()->setImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			
			return view(getTheme('detailpost'), compact('post'));
		} else {
			return redirect('404');
		}
	}
	
	/**
     * Show the application search post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	public function search(Request $request)
    {
		$validator = $this->validate($request,[
			'terms' => 'required|max:255',
		]);
		
		$terms = strip_tags($request->terms);
		
		$twitterid = explode('/', getSetting('twitter'));
		SEOTools::setTitle($terms.' - '.getSetting('web_name'));
		SEOTools::setDescription($terms.' - '.getSetting('web_description'));
		SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
		SEOTools::setCanonical(getSetting('web_url'));
		SEOTools::opengraph()->setTitle($terms.' - '.getSetting('web_name'));
		SEOTools::opengraph()->setDescription($terms.' - '.getSetting('web_description'));
		SEOTools::opengraph()->setUrl(getSetting('web_url'));
		SEOTools::opengraph()->setSiteName(getSetting('web_author'));
		SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
		SEOTools::twitter()->setTitle($terms.' - '.getSetting('web_name'));
		SEOTools::twitter()->setDescription($terms.' - '.getSetting('web_description'));
		SEOTools::twitter()->setUrl(getSetting('web_url'));
		SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::jsonLd()->setTitle($terms.' - '.getSetting('web_name'));
		SEOTools::jsonLd()->setDescription($terms.' - '.getSetting('web_description'));
		SEOTools::jsonLd()->setType('WebPage');
		SEOTools::jsonLd()->setUrl(getSetting('web_url'));
		SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		
		$posts = Post::leftJoin('users', 'users.id', 'posts.created_by')
			->leftJoin('categories', 'categories.id', 'posts.category_id')
			->where([
				['posts.title', 'LIKE', '%'.$terms.'%'],
				['posts.active', '=', 'Y']
			])
			->orWhere([
				['posts.content', 'LIKE', '%'.$terms.'%'],
				['posts.tag', 'LIKE', '%'.$terms.'%']
			])
			->select('posts.*', 'categories.title as ctitle', 'categories.seotitle as cseotitle', 'users.name')
			->orderBy('posts.id', 'desc')
			->paginate(5);
		
		$posts->appends(['terms' => $terms]);
		
		return view(getTheme('search'), compact('terms', 'posts'));
    }
	
	public function send($seotitle, Request $request)
    {
		$validator = Validator::make($request->all(), [
			'parent' => 'required',
			'post_id' => 'required',
			'name' => 'required|string|min:3',
			'email' => 'required|string|max:255|email',
			'content' => 'required|string|min:25',
			'g-recaptcha-response' => 'required|captcha'
		]);
		
		if($validator->fails()) {
			return redirect('detailpost/'.$seotitle.'#comment-form')
				->withErrors($validator)
				->withInput();
		}
		
		$request->request->add([
			'created_by' => 1,
			'updated_by' => 1
		]);
		$requestData = $request->all();
		
		Comment::create($requestData);
		
		return redirect('detailpost/'.$seotitle.'#comment-form')->with('flash_message', __('comment.send_notif'));
    }
}
