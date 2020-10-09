<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

use App\Album;
use App\Gallery;

class GalleryController extends Controller
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
     * Show the application album.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($seotitle)
    {
		$album = Album::where([['seotitle', '=', $seotitle],['active', '=', 'Y']])->first();
		
		if($album) {
			$twitterid = explode('/', getSetting('twitter'));
			SEOTools::setTitle($album->title.' - '.getSetting('web_name'));
			SEOTools::setDescription($album->title.' - '.getSetting('web_description'));
			SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
			SEOTools::setCanonical(getSetting('web_url') . '/album/' . $album->seotitle);
			SEOTools::opengraph()->setTitle($album->title.' - '.getSetting('web_name'));
			SEOTools::opengraph()->setDescription($album->title.' - '.getSetting('web_description'));
			SEOTools::opengraph()->setUrl(getSetting('web_url') . '/album/' . $album->seotitle);
			SEOTools::opengraph()->setSiteName(getSetting('web_author'));
			SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
			SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
			SEOTools::twitter()->setTitle($album->title.' - '.getSetting('web_name'));
			SEOTools::twitter()->setDescription($album->title.' - '.getSetting('web_description'));
			SEOTools::twitter()->setUrl(getSetting('web_url') . '/album/' . $album->seotitle);
			SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
			SEOTools::jsonLd()->setTitle($album->title.' - '.getSetting('web_name'));
			SEOTools::jsonLd()->setDescription($album->title.' - '.getSetting('web_description'));
			SEOTools::jsonLd()->setType('WebPage');
			SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/album/' . $album->seotitle);
			SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
			
			$gallerys = Gallery::leftJoin('users', 'users.id', 'gallerys.created_by')
				->leftJoin('albums', 'albums.id', 'gallerys.album_id')
				->where('gallerys.album_id', '=', $album->id)
				->select('gallerys.*', 'albums.title as atitle', 'users.name')
				->orderBy('gallerys.id', 'desc')
				->paginate(12);
			
			return view(getTheme('gallery'), compact('album', 'gallerys'));
		} else {
			if($seotitle == 'all') {
				$twitterid = explode('/', getSetting('twitter'));
				SEOTools::setTitle('All Category - '.getSetting('web_name'));
				SEOTools::setDescription('All Category - '.getSetting('web_description'));
				SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
				SEOTools::setCanonical(getSetting('web_url') . '/album/all');
				SEOTools::opengraph()->setTitle('All Category - '.getSetting('web_name'));
				SEOTools::opengraph()->setDescription('All Category - '.getSetting('web_description'));
				SEOTools::opengraph()->setUrl(getSetting('web_url') . '/album/all');
				SEOTools::opengraph()->setSiteName(getSetting('web_author'));
				SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
				SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
				SEOTools::twitter()->setTitle('All Category - '.getSetting('web_name'));
				SEOTools::twitter()->setDescription('All Category - '.getSetting('web_description'));
				SEOTools::twitter()->setUrl(getSetting('web_url') . '/album/all');
				SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
				SEOTools::jsonLd()->setTitle('All Category - '.getSetting('web_name'));
				SEOTools::jsonLd()->setDescription('All Category - '.getSetting('web_description'));
				SEOTools::jsonLd()->setType('WebPage');
				SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/album/all');
				SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
				
				$gallerys = Album::where('active', '=', 'Y')
					->has('gallerys')
					->paginate(6);
				
				return view(getTheme('gallery'), compact('gallerys'));
			} else {
				return redirect('404');
			}
		}
	}
}
