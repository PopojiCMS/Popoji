<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

use App\Theme;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-themes')) {
			$themes = Theme::leftJoin('users', 'users.id', '=', 'themes.created_by')
				->select('themes.*', 'users.id as uid', 'users.name as uname')
				->get();
			
			return view('backend.theme.datatable', compact('themes'));
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
		if(Auth::user()->can('read-themes')) {
			$themes = Theme::leftJoin('users', 'users.id', '=', 'themes.created_by')
				->select('themes.*', 'users.id as uid', 'users.name as uname')
				->get();
			
			return view('backend.theme.datatable', compact('themes'));
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
		$themes = Theme::leftJoin('users', 'users.id', '=', 'themes.created_by')
			->select('themes.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($themes)
			->addColumn('check', function ($theme) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($theme->id).'" disabled />
				</div>';
				return $check;
			})
            ->addColumn('action', function ($theme) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/themes/'.Hashids::encode($theme->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/themes/'.Hashids::encode($theme->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/themes/'.Hashids::encode($theme->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($theme) {
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
		if(Auth::user()->can('create-themes')) {
			return view('backend.theme.create');
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
		if(Auth::user()->can('create-themes')) {
			$this->validate($request,[
				'title' => 'required',
				'author' => 'required',
				'folder' => 'required'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Theme::create($requestData);
			
			return redirect('dashboard/themes')->with('flash_message', __('theme.store_notif'));
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
		if(Auth::user()->can('read-themes')) {
			$ids = Hashids::decode($id);
			$theme = Theme::findOrFail($ids[0]);

			return view('backend.theme.show', compact('theme'));
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
		if(Auth::user()->can('update-themes')) {
			$ids = Hashids::decode($id);
			$theme = Theme::findOrFail($ids[0]);

			return view('backend.theme.edit', compact('theme'));
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
		if(Auth::user()->can('update-themes')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'title' => 'required',
				'author' => 'required',
				'folder' => 'required',
				'active' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$theme = Theme::findOrFail($ids[0]);
			$theme->update($requestData);

			return redirect('dashboard/themes')->with('flash_message', __('theme.update_notif'));
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
		if(Auth::user()->can('delete-themes')) {
			$ids = Hashids::decode($id);
			Theme::destroy($ids[0]);

			return redirect('dashboard/themes')->with('flash_message', __('theme.destroy_notif'));
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
		if(Auth::user()->can('delete-themes')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Theme::destroy($idd[0]);
				}
				return redirect('dashboard/themes')->with('flash_message', __('theme.destroy_notif'));
			} else {
				return redirect('dashboard/themes')->with('flash_message', __('theme.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
    public function active($id)
    {
		if(Auth::user()->can('update-themes')) {
			$ids = Hashids::decode($id);
			$theme = Theme::findOrFail($ids[0]);
			
			Theme::where('active', '=', 'Y')->update([
				'active' => 'N',
				'updated_by' => Auth::User()->id
			]);
			
			$theme->update([
				'active' => 'Y',
				'updated_by' => Auth::User()->id
			]);

			return redirect('dashboard/themes')->with('flash_message', __('theme.active_notif'));
		} else {
			return redirect('forbidden');
		}
    }
	
	public function install(Request $request)
    {
		if(Auth::user()->can('read-themes')) {
			return view('backend.theme.install');
		} else {
			return redirect('forbidden');
		}
    }
	
	public function processInstall(Request $request)
    {
		if(Auth::user()->can('create-themes')) {
			$this->validate($request, [
				'files' => 'required|mimetypes:application/zip,application/octet-stream'
			]);
			
			if ($request->file('files')->isValid()) {
				$filename = rand(111,999).date('YmdHis');
				$extention = $request->file('files')->getClientOriginalExtension();
				$filenamewithext = $filename.'.'.$extention;
				
				if(!File::isDirectory(str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/themes/'.$filename))))){
					File::makeDirectory(str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/themes/'.$filename))), 0777, true, true);
					$upload = $request->file('files')->move('po-content/installer/themes/'.$filename, $filenamewithext);
					
					if($upload) {
						$zip = new \ZipArchive;
						$res = $zip->open('po-content/installer/themes/'.$filename.'/'.$filenamewithext);
						
						if($res===TRUE) {
							$zip->extractTo('po-content/installer/themes/'.$filename);
							$zip->close();
							
							$info = json_decode(file_get_contents('po-content/installer/themes/'.$filename.'/info.json'), true);
							if($info) {
								$checktheme = Theme::where('folder', '=', $info['folder'])->count();
								if ($checktheme > 0) {
									return back()->with('flash_message', __('theme.install_error_notif'));
								} else {
									Theme::create([
										'title' => $info['title'],
										'author' => $info['author'],
										'folder' => $info['folder'],
										'active' => 'N',
										'created_by' => Auth::User()->id,
										'updated_by' => Auth::User()->id
									]);
									
									$this->importAssets($filename);
									$this->importViews($filename);
									
									File::deleteDirectory(str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/themes/'.$filename))));
									
									return redirect('dashboard/themes')->with('flash_message', __('theme.store_notif'));
								}
							} else {
								return back()->with('flash_message', __('theme.install_error_notif'));
							}
						} else {
							return back()->with('flash_message', __('theme.install_error_notif'));
						}
					} else {
						return back()->with('flash_message', __('theme.install_error_notif'));
					}
				}
			} else {
				return back()->with('flash_message', __('theme.install_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	protected function importAssets($filename)
    {
		$directory = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/themes/'.$filename.'/Asset')));
		$files = File::directories($directory);
		foreach($files as $file){
			$pathinfo = pathinfo($file);
			$oldpath = $pathinfo['dirname'].'/'.$pathinfo['basename'];
			$newpath = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/frontend/'.$pathinfo['basename'])));
			if(!File::isDirectory($newpath)){
				File::moveDirectory($oldpath, $newpath);
			}
		}
	}
	
	protected function importViews($filename)
    {
		$directory = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/themes/'.$filename.'/View')));
		$files = File::directories($directory);
		foreach($files as $file){
			$pathinfo = pathinfo($file);
			$oldpath = $pathinfo['dirname'].'/'.$pathinfo['basename'];
			$newpath = base_path('resources/views/frontend/'.$pathinfo['basename']);
			if(!File::isDirectory($newpath)){
				File::moveDirectory($oldpath, $newpath);
			}
		}
	}
}
