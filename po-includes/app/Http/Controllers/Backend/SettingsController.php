<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Event;

use App\Setting;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;
use Spatie\Sitemap\SitemapGenerator;
use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use ZipArchive;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-settings')) {
			$groups = Setting::selectRaw("min(id), `groups`")->groupBy('groups')->orderBy('min(id)', 'asc')->get();
			
			return view('backend.settings.index', compact('groups'));
		} else {
			return redirect('forbidden');
		}
    }
	
	/**
	 * Displays datatables front end view
	 *
	 * @return \Illuminate\View\View
	 */
    public function getIndex()
	{
		if(Auth::user()->can('read-settings')) {
			return view('backend.settings.datatable');
		} else {
			return redirect('forbidden');
		}
	}
	
	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function anyData()
	{
		$settings = Setting::leftJoin('users', 'users.id', '=', 'settings.created_by')
			->select('settings.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($settings)
			->addColumn('check', function ($setting) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($setting->id).'" disabled />
				</div>';
				return $check;
			})
            ->addColumn('action', function ($setting) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/settings/'.Hashids::encode($setting->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/settings/'.Hashids::encode($setting->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/settings/'.Hashids::encode($setting->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($setting) {
				$check = '<div style="text-align:center;"><a href="javascript:void(0);" class="btn btn-secondary btn-xs btn-icon" data-placement="left"><i class="fa fa-plus"></i></a></div>';
				return $check;
			})
			->escapeColumns([])
			->make(true);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
		if(Auth::user()->can('create-settings')) {
			return view('backend.settings.create');
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
		if(Auth::user()->can('create-settings')) {
			$this->validate($request,[
				'groups' => 'required',
				'options' => 'required|string|unique:settings',
				'value' => 'required'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Setting::create($requestData);

			return redirect('dashboard/settings')->with('flash_message', __('setting.store_notif'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
		if(Auth::user()->can('read-settings')) {
			$ids = Hashids::decode($id);
			$setting = Setting::findOrFail($ids[0]);

			return view('backend.settings.show', compact('setting'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
		if(Auth::user()->can('update-settings')) {
			$ids = Hashids::decode($id);
			$setting = Setting::findOrFail($ids[0]);

			return view('backend.settings.edit', compact('setting'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
		if(Auth::user()->can('update-settings')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'groups' => 'required',
				'options' => 'required|string|unique:settings,options,' . $ids[0],
				'value' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$setting = Setting::findOrFail($ids[0]);
			$setting->update($requestData);

			return redirect('dashboard/settings')->with('flash_message', __('setting.update_notif'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
		if(Auth::user()->can('delete-settings')) {
			$ids = Hashids::decode($id);
			Setting::destroy($ids[0]);

			return redirect('dashboard/settings')->with('flash_message', __('setting.destroy_notif'));
		} else {
			return redirect('forbidden');
		}
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function deleteAll(Request $request)
    {
		if(Auth::user()->can('delete-settings')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Setting::destroy($idd[0]);
				}
				return redirect('dashboard/settings')->with('flash_message', __('setting.destroy_notif'));
			} else {
				return redirect('dashboard/settings')->with('flash_message', __('setting.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	public function sitemap(Request $request)
    {
		if(Auth::user()->can('read-settings')) {
			$path = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('sitemap.xml')));
			
			SitemapGenerator::create(url('/'))->hasCrawled(function (Url $url) {
				if(getSetting('sitemap_frequency') == 'daily') {
					$frequency = Url::CHANGE_FREQUENCY_DAILY;
				} elseif(getSetting('sitemap_frequency') == 'monthly') {
					$frequency = Url::CHANGE_FREQUENCY_MONTHLY;
				} else {
					$frequency = Url::CHANGE_FREQUENCY_YEARLY;
				}
				
				$url->setPriority(getSetting('sitemap_priority'));
				$url->setChangeFrequency($frequency);
				
				return $url;
			})->writeToFile($path);
			
			return redirect('dashboard/settings')->with('flash_message', __('setting.sitemap_generate'));
		} else {
			return redirect('forbidden');
		}
	}
	
	public function backup(Request $request)
    {
		if(Auth::user()->can('read-settings')) {
			Artisan::call('backup:run', ['--only-db' => true]);
			
			return redirect('dashboard/settings')->with('flash_message', __('setting.backup_generate'));
		} else {
			return redirect('forbidden');
		}
	}
}
