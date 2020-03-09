<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

use App\Post;
use App\Gallery;
use App\Subscribe;

class HomeController extends Controller
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
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$twitterid = explode('/', getSetting('twitter'));
		SEOTools::setTitle(getSetting('web_name'));
		SEOTools::setDescription(getSetting('web_description'));
		SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
		SEOTools::setCanonical(getSetting('web_url'));
		SEOTools::opengraph()->setTitle(getSetting('web_name'));
		SEOTools::opengraph()->setDescription(getSetting('web_description'));
		SEOTools::opengraph()->setUrl(getSetting('web_url'));
		SEOTools::opengraph()->setSiteName(getSetting('web_author'));
		SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
		SEOTools::twitter()->setTitle(getSetting('web_name'));
		SEOTools::twitter()->setDescription(getSetting('web_description'));
		SEOTools::twitter()->setUrl(getSetting('web_url'));
		SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::jsonLd()->setTitle(getSetting('web_name'));
		SEOTools::jsonLd()->setDescription(getSetting('web_description'));
		SEOTools::jsonLd()->setType('WebPage');
		SEOTools::jsonLd()->setUrl(getSetting('web_url'));
		SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		
        return view(getTheme('home'));
    }
	
	public function error404()
    {
		$twitterid = explode('/', getSetting('twitter'));
		SEOTools::setTitle('Not Found - '.getSetting('web_name'));
		SEOTools::setDescription(getSetting('web_description'));
		SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
		SEOTools::setCanonical(getSetting('web_url'));
		SEOTools::opengraph()->setTitle('Not Found - '.getSetting('web_name'));
		SEOTools::opengraph()->setDescription(getSetting('web_description'));
		SEOTools::opengraph()->setUrl(getSetting('web_url'));
		SEOTools::opengraph()->setSiteName(getSetting('web_author'));
		SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
		SEOTools::twitter()->setTitle('Not Found - '.getSetting('web_name'));
		SEOTools::twitter()->setDescription(getSetting('web_description'));
		SEOTools::twitter()->setUrl(getSetting('web_url'));
		SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::jsonLd()->setTitle('Not Found - '.getSetting('web_name'));
		SEOTools::jsonLd()->setDescription(getSetting('web_description'));
		SEOTools::jsonLd()->setType('WebPage');
		SEOTools::jsonLd()->setUrl(getSetting('web_url'));
		SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		
		return response()->view(getTheme('404'), [], 404);
	}
	
	public function subscribe(Request $request)
    {
		$this->validate($request,[
			'email' => 'required|string|max:255|email'
		]);
		
		$name = explode('@', $request->email);
		$finalname = ucfirst($name[0]);
		
		$request->request->add([
			'name' => $finalname,
			'created_by' => 1,
			'updated_by' => 1
		]);
		$requestData = $request->all();

		Subscribe::create($requestData);
		
		return redirect('contact')->with('flash_message', __('subscribe.send_notif'));
    }
}
