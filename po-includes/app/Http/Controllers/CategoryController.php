<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

use App\Category;
use App\Post;

class CategoryController extends Controller
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
     * Show the application category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($seotitle)
    {
		$category = Category::where([['seotitle', '=', $seotitle],['active', '=', 'Y']])->first();
		
		if($category) {
			$twitterid = explode('/', getSetting('twitter'));
			SEOTools::setTitle($category->title.' - '.getSetting('web_name'));
			SEOTools::setDescription($category->title.' - '.getSetting('web_description'));
			SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
			SEOTools::setCanonical(getSetting('web_url') . '/category/' . $category->seotitle);
			SEOTools::opengraph()->setTitle($category->title.' - '.getSetting('web_name'));
			SEOTools::opengraph()->setDescription($category->title.' - '.getSetting('web_description'));
			SEOTools::opengraph()->setUrl(getSetting('web_url') . '/category/' . $category->seotitle);
			SEOTools::opengraph()->setSiteName(getSetting('web_author'));
			SEOTools::opengraph()->addImage($category->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($category->picture, null, $category->updated_by));
			SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
			SEOTools::twitter()->setTitle($category->title.' - '.getSetting('web_name'));
			SEOTools::twitter()->setDescription($category->title.' - '.getSetting('web_description'));
			SEOTools::twitter()->setUrl(getSetting('web_url') . '/category/' . $category->seotitle);
			SEOTools::twitter()->setImage($category->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($category->picture, null, $category->updated_by));
			SEOTools::jsonLd()->setTitle($category->title.' - '.getSetting('web_name'));
			SEOTools::jsonLd()->setDescription($category->title.' - '.getSetting('web_description'));
			SEOTools::jsonLd()->setType('WebPage');
			SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/category/' . $category->seotitle);
			SEOTools::jsonLd()->setImage($category->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($category->picture, null, $category->updated_by));
			
			$posts = Post::leftJoin('users', 'users.id', 'posts.created_by')
				->leftJoin('categories', 'categories.id', 'posts.category_id')
				->where([['posts.category_id', '=', $category->id],['posts.active', '=', 'Y']])
				->select('posts.*', 'categories.title as ctitle', 'categories.seotitle as cseotitle', 'users.name')
				->orderBy('posts.id', 'desc')
				->paginate(5);
			
			return view(getTheme('category'), compact('category', 'posts'));
		} else {
			if($seotitle == 'all') {
				$twitterid = explode('/', getSetting('twitter'));
				SEOTools::setTitle('All Category - '.getSetting('web_name'));
				SEOTools::setDescription('All Category - '.getSetting('web_description'));
				SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
				SEOTools::setCanonical(getSetting('web_url') . '/category/all');
				SEOTools::opengraph()->setTitle('All Category - '.getSetting('web_name'));
				SEOTools::opengraph()->setDescription('All Category - '.getSetting('web_description'));
				SEOTools::opengraph()->setUrl(getSetting('web_url') . '/category/all');
				SEOTools::opengraph()->setSiteName(getSetting('web_author'));
				SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
				SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
				SEOTools::twitter()->setTitle('All Category - '.getSetting('web_name'));
				SEOTools::twitter()->setDescription('All Category - '.getSetting('web_description'));
				SEOTools::twitter()->setUrl(getSetting('web_url') . '/category/all');
				SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
				SEOTools::jsonLd()->setTitle('All Category - '.getSetting('web_name'));
				SEOTools::jsonLd()->setDescription('All Category - '.getSetting('web_description'));
				SEOTools::jsonLd()->setType('WebPage');
				SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/category/all');
				SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
				
				$posts = Post::leftJoin('users', 'users.id', 'posts.created_by')
					->leftJoin('categories', 'categories.id', 'posts.category_id')
					->where([['posts.active', '=', 'Y']])
					->select('posts.*', 'categories.title as ctitle', 'categories.seotitle as cseotitle', 'users.name')
					->orderBy('posts.id', 'desc')
					->paginate(5);
				
				return view(getTheme('category'), compact('posts'));
			} else {
				return redirect('404');
			}
		}
	}
}
