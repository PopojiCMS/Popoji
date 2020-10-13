<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

use App\Tag;
use App\Post;

class TagController extends Controller
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
     * Show the application tag.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($seotitle)
    {
		$tag = Tag::where('seotitle', '=', $seotitle)->first();
		
		if($tag) {
			$twitterid = explode('/', getSetting('twitter'));
			SEOTools::setTitle($tag->title.' - '.getSetting('web_name'));
			SEOTools::setDescription($tag->title.' - '.getSetting('web_description'));
			SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
			SEOTools::setCanonical(getSetting('web_url') . '/tag/' . $tag->seotitle);
			SEOTools::opengraph()->setTitle($tag->title.' - '.getSetting('web_name'));
			SEOTools::opengraph()->setDescription($tag->title.' - '.getSetting('web_description'));
			SEOTools::opengraph()->setUrl(getSetting('web_url') . '/tag/' . $tag->seotitle);
			SEOTools::opengraph()->setSiteName(getSetting('web_author'));
			SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
			SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
			SEOTools::twitter()->setTitle($tag->title.' - '.getSetting('web_name'));
			SEOTools::twitter()->setDescription($tag->title.' - '.getSetting('web_description'));
			SEOTools::twitter()->setUrl(getSetting('web_url') . '/tag/' . $tag->seotitle);
			SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
			SEOTools::jsonLd()->setTitle($tag->title.' - '.getSetting('web_name'));
			SEOTools::jsonLd()->setDescription($tag->title.' - '.getSetting('web_description'));
			SEOTools::jsonLd()->setType('WebPage');
			SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/tag/' . $tag->seotitle);
			SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
			
			$posts = Post::leftJoin('users', 'users.id', 'posts.created_by')
				->leftJoin('categories', 'categories.id', 'posts.category_id')
				->where([['posts.tag', 'LIKE', '%'.$tag->title.'%'],['posts.active', '=', 'Y']])
				->select('posts.*', 'categories.title as ctitle', 'users.name')
				->orderBy('posts.id', 'desc')
				->paginate(5);
			
			return view(getTheme('tag'), compact('tag', 'posts'));
		} else {
			return redirect('404');
		}
	}
}
