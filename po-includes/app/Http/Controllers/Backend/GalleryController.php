<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Gallery;
use App\Album;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-gallerys')) {
			return view('backend.gallery.datatable');
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
			return view('backend.gallery.datatable');
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
		$gallerys = Gallery::leftJoin('albums', 'albums.id', '=', 'gallerys.album_id')
			->leftJoin('users', 'users.id', '=', 'gallerys.created_by')
			->select('gallerys.*', 'albums.id as aid', 'albums.title as atitle', 'users.id as uid', 'users.name as uname');
		return Datatables::of($gallerys)
			->addColumn('check', function ($gallery) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($gallery->id).'" disabled />
				</div>';
				return $check;
			})
            ->addColumn('action', function ($gallery) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/gallerys/'.Hashids::encode($gallery->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/gallerys/'.Hashids::encode($gallery->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/gallerys/'.Hashids::encode($gallery->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($gallery) {
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
			$albums = Album::where('active', '=', 'Y')->limit(10)->get();
			
			return view('backend.gallery.create', compact('albums'));
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
				'album_id' => 'required',
				'title' => 'required',
				'picture' => 'required'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Gallery::create($requestData);
			
			return redirect('dashboard/gallerys')->with('flash_message', __('gallery.store_notif'));
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
			$gallery = Gallery::findOrFail($ids[0]);

			return view('backend.gallery.show', compact('gallery'));
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
			$gallery = Gallery::findOrFail($ids[0]);
			$albums = Album::where('active', '=', 'Y')->limit(10)->get();

			return view('backend.gallery.edit', compact('gallery', 'albums'));
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
				'album_id' => 'required',
				'title' => 'required',
				'picture' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$gallery = Gallery::findOrFail($ids[0]);
			$gallery->update($requestData);

			return redirect('dashboard/gallerys')->with('flash_message', __('gallery.update_notif'));
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
			Gallery::destroy($ids[0]);

			return redirect('dashboard/gallerys')->with('flash_message', __('gallery.destroy_notif'));
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
					Gallery::destroy($idd[0]);
				}
				return redirect('dashboard/gallerys')->with('flash_message', __('gallery.destroy_notif'));
			} else {
				return redirect('dashboard/gallerys')->with('flash_message', __('gallery.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
}
