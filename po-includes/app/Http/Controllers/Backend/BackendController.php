<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Post;
use App\Category;
use App\Tag;
use App\Comment;
use App\Pages;
use App\Contact;
use App\Component;
use App\Theme;
use App\User;

use Analytics;
use Spatie\Analytics\Period;
use Google_Service_Analytics;

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
		
		if (Auth::user()->hasRole('member')) {
			$_SESSION['RF']['subfolder'] = 'users/user-'.Auth::user()->id;
		} else {
			$_SESSION['RF']['subfolder'] = '';
		}
		
		return view('backend.dashboard', compact('post', 'pages', 'category', 'tag', 'comment', 'commentunread', 'pages', 'contactunread', 'component', 'theme', 'user', 'populars'));
    }
	
	/**
     * Display analytics pages.
     *
     * @return void
     */
    public function analytics()
    {
		$fetchTotalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
		$fetchMostVisitedPages = Analytics::fetchMostVisitedPages(Period::days(7), 8);
		$fetchTopBrowsers = Analytics::fetchTopBrowsers(Period::days(7), 8);
		$fetchTopOperatingSystem = $this->fetchTopOperatingSystem(Period::days(7), 8);
		$fetchTopCountry = $this->fetchTopCountry(Period::days(7), 8);
		$fetchRealtimeUsers = $this->fetchRealtimeUsers();
		$fetchTopDevice = $this->fetchTopDevice(Period::days(7), 8);
		
		return view('backend.analytics', compact('fetchTotalVisitorsAndPageViews', 'fetchMostVisitedPages', 'fetchTopBrowsers', 'fetchTopOperatingSystem', 'fetchTopCountry', 'fetchRealtimeUsers', 'fetchTopDevice'));
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
	
	public function fetchRealtimeUsers() {
		$analytics = Analytics::getAnalyticsService();
		$results = $analytics->data_realtime
			->get(
				'ga:'.env('ANALYTICS_VIEW_ID'),
				'rt:activeUsers'
			);

		return $results->rows[0][0] ? $results->rows[0][0] : 0;
	}
	
	public function fetchTopOperatingSystem(Period $period, int $maxResults = 10): Collection
	{
		$response = Analytics::performQuery(
			$period,
			'ga:sessions',
			[
				'dimensions' => 'ga:operatingSystem,ga:operatingSystemVersion',
				'sort' => '-ga:sessions',
			]
		);

		$topOSs = collect($response['rows'] ?? [])->map(function (array $osRow) {
			return [
				'os' => $osRow[0],
				'version' => $osRow[1],
				'sessions' => (int) $osRow[2],
			];
		});

		if ($topOSs->count() <= $maxResults) {
			return $topOSs;
		}

		return $this->summarizeTopOperatingSystem($topOSs, $maxResults);
	}

	protected function summarizeTopOperatingSystem(Collection $topOSs, int $maxResults): Collection
	{
		return $topOSs
			->take($maxResults - 1)
			->push([
				'os' => 'Others',
				'version' => '-',
				'sessions' => $topOSs->splice($maxResults - 1)->sum('sessions'),
			]);
	}
	
	public function fetchTopCountry(Period $period, int $maxResults = 10): Collection
	{
		$response = Analytics::performQuery(
			$period,
			'ga:sessions',
			[
				'dimensions' => 'ga:country',
				'sort' => '-ga:sessions',
			]
		);

		$topCountrys = collect($response['rows'] ?? [])->map(function (array $countryRow) {
			return [
				'country' => $countryRow[0],
				'sessions' => (int) $countryRow[1],
			];
		});

		if ($topCountrys->count() <= $maxResults) {
			return $topCountrys;
		}

		return $this->summarizeTopCountry($topCountrys, $maxResults);
	}

	protected function summarizeTopCountry(Collection $topCountrys, int $maxResults): Collection
	{
		return $topCountrys
			->take($maxResults - 1)
			->push([
				'country' => 'Others',
				'sessions' => $topCountrys->splice($maxResults - 1)->sum('sessions'),
			]);
	}
	
	public function fetchTopDevice(Period $period): Collection
	{
		$response = Analytics::performQuery(
			$period,
			'ga:users',
			[
				'dimensions' => 'ga:deviceCategory'
			]
		);

		return collect($response['rows'] ?? [])->map(function (array $deviceRow) {
			return $deviceRow;
		});
	}
}
