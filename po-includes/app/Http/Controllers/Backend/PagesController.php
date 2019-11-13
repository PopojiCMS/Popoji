<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Pages;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-pages')) {
			return view('backend.pages.datatable');
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
		if(Auth::user()->can('read-pages')) {
			return view('backend.pages.datatable');
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
		$pages = Pages::leftJoin('users', 'users.id', '=', 'pages.created_by')
			->select('pages.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($pages)
			->addColumn('check', function ($page) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($page->id).'" disabled />
				</div>';
				return $check;
			})
			->addColumn('title', function ($page) {
				return $page->title.'<br /><a href="'.url('/pages/'.$page->seotitle).'" target="_blank">'.url('/pages/'.$page->seotitle).'</a>';
			})
			->addColumn('active', function ($page) {
				return $page->active == 'Y' ? __('pages.active') : __('pages.deactive');
			})
            ->addColumn('action', function ($page) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/pages/'.Hashids::encode($page->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/pages/'.Hashids::encode($page->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/pages/'.Hashids::encode($page->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($page) {
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
		if(Auth::user()->can('create-pages')) {
			return view('backend.pages.create');
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
		if(Auth::user()->can('create-pages')) {
			$this->validate($request,[
				'title' => 'required',
				'seotitle' => 'required|string|unique:pages'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Pages::create($requestData);
			
			return redirect('dashboard/pages')->with('flash_message', __('pages.store_notif'));
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
		if(Auth::user()->can('read-pages')) {
			$ids = Hashids::decode($id);
			$pages = Pages::findOrFail($ids[0]);

			return view('backend.pages.show', compact('pages'));
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
		if(Auth::user()->can('update-pages')) {
			$ids = Hashids::decode($id);
			$pages = Pages::findOrFail($ids[0]);

			return view('backend.pages.edit', compact('pages'));
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
		if(Auth::user()->can('update-pages')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'title' => 'required',
				'seotitle' => 'required|string|unique:pages,seotitle,' . $ids[0],
				'active' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$pages = Pages::findOrFail($ids[0]);
			$pages->update($requestData);

			return redirect('dashboard/pages')->with('flash_message', __('pages.update_notif'));
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
		if(Auth::user()->can('delete-pages')) {
			$ids = Hashids::decode($id);
			Pages::destroy($ids[0]);

			return redirect('dashboard/pages')->with('flash_message', __('pages.destroy_notif'));
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
		if(Auth::user()->can('delete-pages')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Pages::destroy($idd[0]);
				}
				return redirect('dashboard/pages')->with('flash_message', __('pages.destroy_notif'));
			} else {
				return redirect('dashboard/pages')->with('flash_message', __('pages.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
}
