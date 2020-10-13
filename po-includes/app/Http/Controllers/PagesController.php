<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

use App\Pages;

class PagesController extends Controller
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
     * Show the application pages.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($seotitle)
    {
		$pages = Pages::where([['seotitle', '=', $seotitle],['active', '=', 'Y']])->first();
		
		if($pages) {
			$twitterid = explode('/', getSetting('twitter'));
			SEOTools::setTitle($pages->title.' - '.getSetting('web_name'));
			SEOTools::setDescription(\Str::limit(strip_tags($pages->content), 200));
			SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
			SEOTools::setCanonical(getSetting('web_url') . '/pages/' . $pages->seotitle);
			SEOTools::opengraph()->setTitle($pages->title.' - '.getSetting('web_name'));
			SEOTools::opengraph()->setDescription(\Str::limit(strip_tags($pages->content), 200));
			SEOTools::opengraph()->setUrl(getSetting('web_url') . '/pages/' . $pages->seotitle);
			SEOTools::opengraph()->setSiteName(getSetting('web_author'));
			SEOTools::opengraph()->addImage($pages->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($pages->picture, null, $pages->updated_by));
			SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
			SEOTools::twitter()->setTitle($pages->title.' - '.getSetting('web_name'));
			SEOTools::twitter()->setDescription(\Str::limit(strip_tags($pages->content), 200));
			SEOTools::twitter()->setUrl(getSetting('web_url') . '/pages/' . $pages->seotitle);
			SEOTools::twitter()->setImage($pages->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($pages->picture, null, $pages->updated_by));
			SEOTools::jsonLd()->setTitle($pages->title.' - '.getSetting('web_name'));
			SEOTools::jsonLd()->setDescription(\Str::limit(strip_tags($pages->content), 200));
			SEOTools::jsonLd()->setType('WebPage');
			SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/pages/' . $pages->seotitle);
			SEOTools::jsonLd()->setImage($pages->picture == '' ? asset('po-content/uploads/'.getSetting('logo')) : getPicture($pages->picture, null, $pages->updated_by));
			
			return view(getTheme('pages'), compact('pages'));
		} else {
			return redirect('404');
		}
	}
}
