<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Category;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-categories')) {
			return view('backend.category.datatable');
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
		if(Auth::user()->can('read-categories')) {
			return view('backend.category.datatable');
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
		$categorys = Category::leftJoin('users', 'users.id', '=', 'categories.created_by')
			->select('categories.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($categorys)
			->addColumn('check', function ($category) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($category->id).'" disabled />
				</div>';
				return $check;
			})
			->addColumn('parent', function ($category) {
				return $category->parent == 0 ? __('category.no_parent') : $category->mainParent->title;
			})
			->addColumn('title', function ($category) {
				return $category->title.'<br /><a href="'.url('/category/'.$category->seotitle).'" target="_blank">'.url('/category/'.$category->seotitle).'</a>';
			})
			->addColumn('active', function ($category) {
				return $category->active == 'Y' ? __('category.active') : __('category.deactive');
			})
            ->addColumn('action', function ($category) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/categories/'.Hashids::encode($category->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/categories/'.Hashids::encode($category->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/categories/'.Hashids::encode($category->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($category) {
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
		if(Auth::user()->can('create-categories')) {
			$tree = new Category;
			$parents = $tree->tree()->toArray();
			
			return view('backend.category.create', compact('parents'));
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
		if(Auth::user()->can('create-categories')) {
			$this->validate($request,[
				'parent' => 'required',
				'title' => 'required',
				'seotitle' => 'required|string|unique:categories'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Category::create($requestData);
			
			return redirect('dashboard/categories')->with('flash_message', __('category.store_notif'));
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
		if(Auth::user()->can('read-categories')) {
			$ids = Hashids::decode($id);
			$category = Category::findOrFail($ids[0]);

			return view('backend.category.show', compact('category'));
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
		if(Auth::user()->can('update-categories')) {
			$ids = Hashids::decode($id);
			$category = Category::findOrFail($ids[0]);
			$tree = new Category;
			$parents = $tree->tree()->toArray();

			return view('backend.category.edit', compact('category', 'parents'));
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
		if(Auth::user()->can('update-categories')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'parent' => 'required',
				'title' => 'required',
				'seotitle' => 'required|string|unique:categories,seotitle,' . $ids[0],
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$category = Category::findOrFail($ids[0]);
			$category->update($requestData);

			return redirect('dashboard/categories')->with('flash_message', __('category.update_notif'));
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
		if(Auth::user()->can('delete-categories')) {
			$ids = Hashids::decode($id);
			Category::destroy($ids[0]);

			return redirect('dashboard/categories')->with('flash_message', __('category.destroy_notif'));
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
		if(Auth::user()->can('delete-categories')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Category::destroy($idd[0]);
				}
				return redirect('dashboard/categories')->with('flash_message', __('category.destroy_notif'));
			} else {
				return redirect('dashboard/categories')->with('flash_message', __('category.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
}
