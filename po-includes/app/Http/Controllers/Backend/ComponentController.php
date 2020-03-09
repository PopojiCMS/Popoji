<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

use App\Component;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-components')) {
			return view('backend.component.datatable');
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
		if(Auth::user()->can('read-components')) {
			return view('backend.component.datatable');
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
		$components = Component::leftJoin('users', 'users.id', '=', 'components.created_by')
			->select('components.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($components)
			->addColumn('check', function ($component) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($component->id).'" disabled />
				</div>';
				return $check;
			})
            ->addColumn('action', function ($component) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/'.Str::kebab($component->title).($component->folder == 'gallery' || $component->folder == 'contact' ? 's' : '').'/table').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/components/'.Hashids::encode($component->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/components/'.Hashids::encode($component->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($component) {
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
		if(Auth::user()->can('create-components')) {
			return view('backend.component.create');
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
		if(Auth::user()->can('create-components')) {
			$this->validate($request,[
				'title' => 'required',
				'author' => 'required',
				'folder' => 'required',
				'type' => 'required'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Component::create($requestData);
			
			return redirect('dashboard/components')->with('flash_message', __('component.store_notif'));
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
		if(Auth::user()->can('read-components')) {
			$ids = Hashids::decode($id);
			$component = Component::findOrFail($ids[0]);

			return view('backend.component.show', compact('component'));
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
		if(Auth::user()->can('update-components')) {
			$ids = Hashids::decode($id);
			$component = Component::findOrFail($ids[0]);

			return view('backend.component.edit', compact('component'));
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
		if(Auth::user()->can('update-components')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'title' => 'required',
				'author' => 'required',
				'folder' => 'required',
				'type' => 'required',
				'active' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$component = Component::findOrFail($ids[0]);
			$component->update($requestData);

			return redirect('dashboard/components')->with('flash_message', __('component.update_notif'));
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
		if(Auth::user()->can('delete-components')) {
			$ids = Hashids::decode($id);
			Component::destroy($ids[0]);

			return redirect('dashboard/components')->with('flash_message', __('component.destroy_notif'));
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
		if(Auth::user()->can('delete-components')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Component::destroy($idd[0]);
				}
				return redirect('dashboard/components')->with('flash_message', __('component.destroy_notif'));
			} else {
				return redirect('dashboard/components')->with('flash_message', __('component.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	public function install(Request $request)
    {
		if(Auth::user()->can('read-components')) {
			return view('backend.component.install');
		} else {
			return redirect('forbidden');
		}
    }
	
	public function processInstall(Request $request)
    {
		if(Auth::user()->can('create-components')) {
			$this->validate($request, [
				'files' => 'required|mimetypes:application/zip,application/octet-stream'
			]);
			
			if ($request->file('files')->isValid()) {
				$filename = rand(111,999).date('YmdHis');
				$extention = $request->file('files')->getClientOriginalExtension();
				$filenamewithext = $filename.'.'.$extention;
				
				if(!File::isDirectory(str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/components/'.$filename))))){
					File::makeDirectory(str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/components/'.$filename))), 0777, true, true);
					$upload = $request->file('files')->move('po-content/installer/components/'.$filename, $filenamewithext);
					
					if($upload) {
						$zip = new \ZipArchive;
						$res = $zip->open('po-content/installer/components/'.$filename.'/'.$filenamewithext);
						
						if($res===TRUE) {
							$zip->extractTo('po-content/installer/components/'.$filename);
							$zip->close();
							
							$info = json_decode(file_get_contents('po-content/installer/components/'.$filename.'/info.json'), true);
							if($info) {
								$checkcomponent = Component::where('folder', '=', $info['folder'])->count();
								if ($checkcomponent > 0) {
									return back()->with('flash_message', __('component.install_error_notif'));
								} else {
									Component::create([
										'title' => $info['title'],
										'author' => $info['author'],
										'folder' => $info['folder'],
										'type' => $info['type'],
										'active' => 'Y',
										'created_by' => Auth::User()->id,
										'updated_by' => Auth::User()->id
									]);
									
									$kebabname = Str::kebab($info['title']);
									$camelname = ucfirst(Str::camel($info['title']));
									
									$this->importMigrations($filename);
									$this->importRoutes($kebabname, $camelname);
									$this->importModels($filename);
									$this->importControllers($filename);
									$this->importViews($filename);
									
									File::deleteDirectory(str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/components/'.$filename))));
									
									return redirect('dashboard/'.$kebabname.'/install');
								}
							} else {
								return back()->with('flash_message', __('component.install_error_notif'));
							}
						} else {
							return back()->with('flash_message', __('component.install_error_notif'));
						}
					} else {
						return back()->with('flash_message', __('component.install_error_notif'));
					}
				}
			} else {
				return back()->with('flash_message', __('component.install_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	protected function importMigrations($filename)
    {
		$directory = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/components/'.$filename.'/Migration')));
		$files = File::allFiles($directory);
		foreach($files as $file){
			$pathinfo = pathinfo($file);
			$oldpath = $pathinfo['dirname'].'/'.$pathinfo['basename'];
			$newpath = base_path('database/migrations/'.$pathinfo['basename']);
			if(!File::isFile($newpath)){
				File::move($oldpath, $newpath);
			}
		}
		
		Artisan::call('migrate', array('--path' => 'app/migrations', '--force' => true));
	}
	
	protected function importRoutes($kebabname, $camelname)
    {
		$routefile = base_path('routes/web.php');
		$oldcontent = file_get_contents($routefile);
		
		$search = '//-----replace-----//';
		$replace = "Route::get('dashboard/{$kebabname}/index','Backend\/{$camelname}Controller@index');\n";
		$replace .= "\tRoute::get('dashboard/{$kebabname}/table','Backend\/{$camelname}Controller@getIndex');\n";
		$replace .= "\tRoute::get('dashboard/{$kebabname}/data','Backend\/{$camelname}Controller@anyData');\n";
		$replace .= "\tRoute::get('dashboard/{$kebabname}/install','Backend\/{$camelname}Controller@install');\n";
		$replace .= "\tRoute::post('dashboard/{$kebabname}/deleteall', 'Backend\/{$camelname}Controller@deleteAll');\n";
		$replace .= "\tRoute::resource('dashboard/{$kebabname}', 'Backend\/{$camelname}Controller');\n\t\n";
		$replace .= "\t//-----replace-----//\n\t";
		
		$newcontent = str_replace($search, $replace, $oldcontent);
		file_put_contents($routefile, $newcontent);
    }
	
	protected function importModels($filename)
    {
		$directory = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/components/'.$filename.'/Model')));
		$files = File::allFiles($directory);
		foreach($files as $file){
			$pathinfo = pathinfo($file);
			$oldpath = $pathinfo['dirname'].'/'.$pathinfo['basename'];
			$newpath = base_path('app/'.$pathinfo['basename']);
			if(!File::isFile($newpath)){
				File::move($oldpath, $newpath);
			}
		}
	}
	
	protected function importControllers($filename)
    {
		$directory = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/components/'.$filename.'/Controller')));
		$files = File::allFiles($directory);
		foreach($files as $file){
			$pathinfo = pathinfo($file);
			$oldpath = $pathinfo['dirname'].'/'.$pathinfo['basename'];
			$newpath = base_path('app/Http/Controllers/Backend/'.$pathinfo['basename']);
			if(!File::isFile($newpath)){
				File::move($oldpath, $newpath);
			}
		}
	}
	
	protected function importViews($filename)
    {
		$directory = str_replace('\po-includes', '', str_replace('/po-includes', '', base_path('po-content/installer/components/'.$filename.'/View')));
		$files = File::directories($directory);
		foreach($files as $file){
			$pathinfo = pathinfo($file);
			$oldpath = $pathinfo['dirname'].'/'.$pathinfo['basename'];
			$newpath = base_path('resources/views/backend/'.$pathinfo['basename']);
			if(!File::isDirectory($newpath)){
				File::moveDirectory($oldpath, $newpath);
			}
		}
	}
}
