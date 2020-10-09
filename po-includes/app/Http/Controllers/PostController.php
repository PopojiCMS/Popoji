<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Post;
use App\PostGallery;
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
		config([
			'captcha.secret' => getSetting('recaptcha_secret'),
			'captcha.sitekey' => getSetting('recaptcha_key'),
		]);
		
        // $this->middleware('auth');
    }

    /**
     * Show the application post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($seotitle, Request $request)
    {
		if(getSetting('slug') == 'post/slug-id') {
			$expseotitle = explode('-', $seotitle);
			array_pop($expseotitle);
			$seotitle = implode('-', $expseotitle);
		} else {
			$seotitle = $seotitle;
		}
		
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
			
			$gallery = PostGallery::where('post_id', '=', $post->id)->get();
			
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
			
			$seturl = '';
			if(getSetting('slug') == 'post/slug-id') {
				$seturl = '/detailpost/' . $post->seotitle . '-' . $post->id;
			} else {
				$seturl = '/detailpost/' . $post->seotitle;
			}
			
			$twitterid = explode('/', getSetting('twitter'));
			SEOTools::setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::setDescription($post->meta_description);
			SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
			SEOTools::setCanonical(getSetting('web_url') . $seturl);
			SEOTools::opengraph()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::opengraph()->setDescription($post->meta_description);
			SEOTools::opengraph()->setUrl(getSetting('web_url') . $seturl);
			SEOTools::opengraph()->setSiteName(getSetting('web_author'));
			SEOTools::opengraph()->addImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
			SEOTools::twitter()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::twitter()->setDescription($post->meta_description);
			SEOTools::twitter()->setUrl(getSetting('web_url') . $seturl);
			SEOTools::twitter()->setImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			SEOTools::jsonLd()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::jsonLd()->setDescription($post->meta_description);
			SEOTools::jsonLd()->setType('WebPage');
			SEOTools::jsonLd()->setUrl(getSetting('web_url') . $seturl);
			SEOTools::jsonLd()->setImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			
			return view(getTheme('detailpost'), compact('post', 'content', 'paginator', 'gallery'));
		} else {
			return redirect('404');
		}
	}
	
	/**
     * Show the application post.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function article($year, $month, $day, $seotitle, Request $request)
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
			
			$gallery = PostGallery::where('post_id', '=', $post->id)->get();
			
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
			
			$seturl = '/article/' . $year . '/' . $month . '/' . $day . '/' . $post->seotitle;
			
			$twitterid = explode('/', getSetting('twitter'));
			SEOTools::setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::setDescription($post->meta_description);
			SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
			SEOTools::setCanonical(getSetting('web_url') . $seturl);
			SEOTools::opengraph()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::opengraph()->setDescription($post->meta_description);
			SEOTools::opengraph()->setUrl(getSetting('web_url') . $seturl);
			SEOTools::opengraph()->setSiteName(getSetting('web_author'));
			SEOTools::opengraph()->addImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
			SEOTools::twitter()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::twitter()->setDescription($post->meta_description);
			SEOTools::twitter()->setUrl(getSetting('web_url') . $seturl);
			SEOTools::twitter()->setImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			SEOTools::jsonLd()->setTitle($post->title.' - '.getSetting('web_name'));
			SEOTools::jsonLd()->setDescription($post->meta_description);
			SEOTools::jsonLd()->setType('WebPage');
			SEOTools::jsonLd()->setUrl(getSetting('web_url') . $seturl);
			SEOTools::jsonLd()->setImage($post->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($post->picture, null, $post->updated_by));
			
			return view(getTheme('detailpost'), compact('post', 'content', 'paginator', 'gallery'));
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
		SEOTools::setCanonical(getSetting('web_url') . '/search');
		SEOTools::opengraph()->setTitle($terms.' - '.getSetting('web_name'));
		SEOTools::opengraph()->setDescription($terms.' - '.getSetting('web_description'));
		SEOTools::opengraph()->setUrl(getSetting('web_url') . '/search');
		SEOTools::opengraph()->setSiteName(getSetting('web_author'));
		SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
		SEOTools::twitter()->setTitle($terms.' - '.getSetting('web_name'));
		SEOTools::twitter()->setDescription($terms.' - '.getSetting('web_description'));
		SEOTools::twitter()->setUrl(getSetting('web_url') . '/search');
		SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::jsonLd()->setTitle($terms.' - '.getSetting('web_name'));
		SEOTools::jsonLd()->setDescription($terms.' - '.getSetting('web_description'));
		SEOTools::jsonLd()->setType('WebPage');
		SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/search');
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
