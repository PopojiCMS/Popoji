<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;
use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-roles')) {
			return view('backend.roles.datatable');
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
		if(Auth::user()->can('read-roles')) {
			return view('backend.roles.datatable');
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
		$roles = Role::select('roles.*');
		return Datatables::of($roles)
			->addColumn('check', function ($role) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($role->id).'" disabled />
				</div>';
				return $check;
			})
            ->addColumn('action', function ($role) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/roles/'.Hashids::encode($role->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a> ';
				$btn .= '<a href="'.url('dashboard/roles/'.Hashids::encode($role->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a> ';
				$btn .= '<a href="'.url('dashboard/roles/'.Hashids::encode($role->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($role) {
				$check = '<div style="text-align:center;"><a href="javascript:void(0);" class="btn btn-secondary btn-xs btn-icon"><i class="fa fa-plus"></i></a></div>';
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
		if(Auth::user()->can('create-roles')) {
			return view('backend.roles.create');
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
		if(Auth::user()->can('create-roles')) {
			$this->validate($request, ['name' => 'required|string|max:50']);
			$role = Role::firstOrCreate(['name' => $request->name]);

			return redirect('dashboard/roles')->with('flash_message', __('role.store_notif'));
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
		if(Auth::user()->can('read-roles')) {
			$ids = Hashids::decode($id);
			$role = Role::findOrFail($ids[0]);

			return view('backend.roles.show', compact('role'));
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
		if(Auth::user()->can('update-roles')) {
			$ids = Hashids::decode($id);
			$role = Role::findOrFail($ids[0]);
    
			$permissions = null;
			$hasPermission = null;
			
			$roles = Role::all()->pluck('name');
			
			$getRole = Role::findByName($role->name);
			
			$hasPermission = DB::table('role_has_permissions')
				->select('permissions.name')
				->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
				->where('role_id', $getRole->id)->get()->pluck('name')->all();
			
			$permissions = Permission::all()->pluck('name');

			return view('backend.roles.edit', compact('role', 'permissions', 'hasPermission'));
		} else {
			return redirect('forbidden');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
		if(Auth::user()->can('update-roles')) {
			$this->validate($request, ['name' => 'required']);

			$ids = Hashids::decode($id);
			$role = Role::findOrFail($ids[0]);
			$role->update(['name' => $request->name]);

			if ($request->has('permission')) {
				$role->syncPermissions($request->permission);
			}

			return redirect('dashboard/roles')->with('flash_message', __('role.update_notif'));
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
		if(Auth::user()->can('delete-roles')) {
			$ids = Hashids::decode($id);
			Role::destroy($ids[0]);

			return redirect('dashboard/roles')->with('flash_message', __('role.destroy_notif'));
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
		if(Auth::user()->can('delete-roles')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Role::destroy($idd[0]);
				}
				return redirect('dashboard/roles')->with('flash_message', __('role.destroy_notif'));
			} else {
				return redirect('dashboard/roles')->with('flash_message', __('role.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
}
