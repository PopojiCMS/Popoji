<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-permissions')) {
			return view('backend.permissions.datatable');
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
		if(Auth::user()->can('read-permissions')) {
			return view('backend.permissions.datatable');
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
		$permissions = Permission::select('permissions.*');
		return Datatables::of($permissions)
			->addColumn('check', function ($permission) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($permission->id).'" disabled />
				</div>';
				return $check;
			})
            ->addColumn('action', function ($permission) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/permissions/'.Hashids::encode($permission->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><span class="fa fa-eye"></i></a> ';
				$btn .= '<a href="'.url('dashboard/permissions/'.Hashids::encode($permission->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><span class="fa fa-edit"></i></a> ';
				$btn .= '<a href="'.url('dashboard/permissions/'.Hashids::encode($permission->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><span class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($permission) {
				$check = '<div style="text-align:center;"><a href="javascript:void(0);" class="btn btn-secondary btn-xs btn-icon"><span class="fa fa-plus"></i></a></div>';
				return $check;
			})
			->escapeColumns([])
			->make(true);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
		if(Auth::user()->can('create-permissions')) {
			return view('backend.permissions.create');
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
		if(Auth::user()->can('create-permissions')) {
			$this->validate($request, ['name' => 'required|string|unique:permissions']);
			$create = Permission::firstOrCreate(['name' => 'create-'.$request->name]);
			$read = Permission::firstOrCreate(['name' => 'read-'.$request->name]);
			$update = Permission::firstOrCreate(['name' => 'update-'.$request->name]);
			$delete = Permission::firstOrCreate(['name' => 'delete-'.$request->name]);

			return redirect('dashboard/permissions')->with('flash_message', __('permission.store_notif'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
		if(Auth::user()->can('read-permissions')) {
			$ids = Hashids::decode($id);
			$permission = Permission::findOrFail($ids[0]);

			return view('backend.permissions.show', compact('permission'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
		if(Auth::user()->can('update-permissions')) {
			$ids = Hashids::decode($id);
			$permission = Permission::findOrFail($ids[0]);

			return view('backend.permissions.edit', compact('permission'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
		if(Auth::user()->can('update-permissions')) {
			$this->validate($request, ['name' => 'required']);

			$ids = Hashids::decode($id);
			$permission = Permission::findOrFail($ids[0]);
			$permission->update($request->all());

			return redirect('dashboard/permissions')->with('flash_message', __('permission.update_notif'));
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
    public function destroy($id)
    {
		if(Auth::user()->can('delete-permissions')) {
			$ids = Hashids::decode($id);
			Permission::destroy($ids[0]);

			return redirect('dashboard/permissions')->with('flash_message', __('permission.destroy_notif'));
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
		if(Auth::user()->can('delete-permissions')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Permission::destroy($idd[0]);
				}
				return redirect('dashboard/permissions')->with('flash_message', __('permission.destroy_notif'));
			} else {
				return redirect('dashboard/permissions')->with('flash_message', __('permission.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
}
