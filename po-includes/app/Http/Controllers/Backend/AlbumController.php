<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Album;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-gallerys')) {
			return view('backend.album.datatable');
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
		if(Auth::user()->can('read-gallerys')) {
			return view('backend.album.datatable');
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
		$albums = Album::leftJoin('users', 'users.id', '=', 'albums.created_by')
			->select('albums.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($albums)
			->addColumn('check', function ($album) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($album->id).'" disabled />
				</div>';
				return $check;
			})
			->addColumn('title', function ($album) {
				return $album->title.'<br /><a href="'.url('/album/'.$album->seotitle).'" target="_blank">'.url('/album/'.$album->seotitle).'</a>';
			})
			->addColumn('active', function ($album) {
				return $album->active == 'Y' ? __('album.active') : __('album.deactive');
			})
            ->addColumn('action', function ($album) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/albums/'.Hashids::encode($album->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/albums/'.Hashids::encode($album->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/albums/'.Hashids::encode($album->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($album) {
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
		if(Auth::user()->can('create-gallerys')) {
			return view('backend.album.create');
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
		if(Auth::user()->can('create-gallerys')) {
			$this->validate($request,[
				'title' => 'required',
				'seotitle' => 'required|string|unique:albums'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Album::create($requestData);
			
			return redirect('dashboard/albums')->with('flash_message', __('album.store_notif'));
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
		if(Auth::user()->can('read-gallerys')) {
			$ids = Hashids::decode($id);
			$album = Album::findOrFail($ids[0]);

			return view('backend.album.show', compact('album'));
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
		if(Auth::user()->can('update-gallerys')) {
			$ids = Hashids::decode($id);
			$album = Album::findOrFail($ids[0]);

			return view('backend.album.edit', compact('album'));
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
		if(Auth::user()->can('update-gallerys')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'title' => 'required',
				'seotitle' => 'required|string|unique:albums,seotitle,' . $ids[0],
				'active' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$album = Album::findOrFail($ids[0]);
			$album->update($requestData);

			return redirect('dashboard/albums')->with('flash_message', __('album.update_notif'));
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
		if(Auth::user()->can('delete-gallerys')) {
			$ids = Hashids::decode($id);
			Album::destroy($ids[0]);

			return redirect('dashboard/albums')->with('flash_message', __('album.destroy_notif'));
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
		if(Auth::user()->can('delete-gallerys')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Album::destroy($idd[0]);
				}
				return redirect('dashboard/albums')->with('flash_message', __('album.destroy_notif'));
			} else {
				return redirect('dashboard/albums')->with('flash_message', __('album.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	public function getAlbum(Request $request)
	{
		if(Auth::user()->can('read-gallerys')) {
			$term = trim($request->q);

			if (empty($term)) {
				$albums = Album::select('id', 'title')->where('active', '=', 'Y')->limit(10)->get();
			} else {
				$albums = Album::select('id', 'title')->where([['title', 'LIKE', '%'.$term.'%'],['active', '=', 'Y']])->get();
			}

			$falbums = [];

			foreach ($albums as $album) {
				$falbums[] = ['id' => $album->id, 'text' => $album->title];
			}

			return \Response::json($falbums);
		} else {
			return redirect('forbidden');
		}
	}
}
