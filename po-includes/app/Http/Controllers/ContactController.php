<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

use App\Contact;

class ContactController extends Controller
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
     * Show the application contact.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$twitterid = explode('/', getSetting('twitter'));
		SEOTools::setTitle('Contact - '.getSetting('web_name'));
		SEOTools::setDescription('Contact - '.getSetting('web_description'));
		SEOTools::metatags()->setKeywords(explode(',', getSetting('web_keyword')));
		SEOTools::setCanonical(getSetting('web_url') . '/contact');
		SEOTools::opengraph()->setTitle('Contact - '.getSetting('web_name'));
		SEOTools::opengraph()->setDescription('Contact - '.getSetting('web_description'));
		SEOTools::opengraph()->setUrl(getSetting('web_url') . '/contact');
		SEOTools::opengraph()->setSiteName(getSetting('web_author'));
		SEOTools::opengraph()->addImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::twitter()->setSite('@'.$twitterid[count($twitterid)-1]);
		SEOTools::twitter()->setTitle('Contact - '.getSetting('web_name'));
		SEOTools::twitter()->setDescription('Contact - '.getSetting('web_description'));
		SEOTools::twitter()->setUrl(getSetting('web_url') . '/contact');
		SEOTools::twitter()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		SEOTools::jsonLd()->setTitle('Contact - '.getSetting('web_name'));
		SEOTools::jsonLd()->setDescription('Contact - '.getSetting('web_description'));
		SEOTools::jsonLd()->setType('WebPage');
		SEOTools::jsonLd()->setUrl(getSetting('web_url') . '/contact');
		SEOTools::jsonLd()->setImage(asset('po-content/uploads/'.getSetting('logo')));
		
        return view(getTheme('contact'));
    }
	
	public function send(Request $request)
    {
		$this->validate($request,[
			'name' => 'required',
			'email' => 'required|string|max:255|email',
			'subject' => 'required',
			'message' => 'required',
			'g-recaptcha-response' => 'required|captcha'
		]);

		$request->request->add([
			'created_by' => 1,
			'updated_by' => 1
		]);
		$requestData = $request->all();

		Contact::create($requestData);
		
		return redirect('contact')->with('flash_message', __('contact.store_notif'));
    }
}
