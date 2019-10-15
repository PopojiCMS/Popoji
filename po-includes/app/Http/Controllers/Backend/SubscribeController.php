<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Subscribe;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-subscribes')) {
			return view('backend.subscribe.datatable');
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
		if(Auth::user()->can('read-subscribes')) {
			return view('backend.subscribe.datatable');
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
		$subscribes = Subscribe::leftJoin('users', 'users.id', '=', 'subscribes.created_by')
			->select('subscribes.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($subscribes)
			->addColumn('check', function ($subscribe) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($subscribe->id).'" disabled />
				</div>';
				return $check;
			})
			->addColumn('follow', function ($subscribe) {
				return $subscribe->follow == 'Y' ? __('subscribe.follow') : __('subscribe.unfollow');
			})
			->addColumn('created_at', function ($subscribe) {
				return date('d M y H:i', strtotime($subscribe->created_at));
			})
            ->addColumn('action', function ($subscribe) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/subscribes/'.Hashids::encode($subscribe->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/subscribes/'.Hashids::encode($subscribe->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/subscribes/'.Hashids::encode($subscribe->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($subscribe) {
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
		if(Auth::user()->can('create-subscribes')) {
			return view('backend.subscribe.create');
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
		if(Auth::user()->can('create-subscribes')) {
			$this->validate($request,[
				'name' => 'required',
				'email' => 'required|string|max:255|email'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Subscribe::create($requestData);
			
			return redirect('dashboard/subscribes')->with('flash_message', __('subscribe.store_notif'));
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
		if(Auth::user()->can('read-subscribes')) {
			$ids = Hashids::decode($id);
			$subscribe = Subscribe::findOrFail($ids[0]);

			return view('backend.subscribe.show', compact('subscribe'));
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
		if(Auth::user()->can('update-subscribes')) {
			$ids = Hashids::decode($id);
			$subscribe = Subscribe::findOrFail($ids[0]);

			return view('backend.subscribe.edit', compact('subscribe'));
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
		if(Auth::user()->can('update-subscribes')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'name' => 'required',
				'email' => 'required|string|unique:subscribes,email,' . $ids[0],
				'follow' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$subscribe = Subscribe::findOrFail($ids[0]);
			$subscribe->update($requestData);

			return redirect('dashboard/subscribes')->with('flash_message', __('subscribe.update_notif'));
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
		if(Auth::user()->can('delete-subscribes')) {
			$ids = Hashids::decode($id);
			Subscribe::destroy($ids[0]);

			return redirect('dashboard/subscribes')->with('flash_message', __('subscribe.destroy_notif'));
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
		if(Auth::user()->can('delete-subscribes')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Subscribe::destroy($idd[0]);
				}
				return redirect('dashboard/subscribes')->with('flash_message', __('subscribe.destroy_notif'));
			} else {
				return redirect('dashboard/subscribes')->with('flash_message', __('subscribe.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
}
