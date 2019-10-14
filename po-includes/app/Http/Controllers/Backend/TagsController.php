<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Tag;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-tags')) {
			return view('backend.tags.datatable');
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
		if(Auth::user()->can('read-tags')) {
			return view('backend.tags.datatable');
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
		$tags = Tag::leftJoin('users', 'users.id', '=', 'tags.created_by')
			->select('tags.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($tags)
			->addColumn('check', function ($tag) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($tag->id).'" disabled />
				</div>';
				return $check;
			})
            ->addColumn('action', function ($tag) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/tags/'.Hashids::encode($tag->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				// $btn .= '<a href="'.url('dashboard/tags/'.Hashids::encode($tag->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/tags/'.Hashids::encode($tag->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($tag) {
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
		if(Auth::user()->can('create-tags')) {
			return view('backend.tags.create');
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
		if(Auth::user()->can('create-tags')) {
			$this->validate($request,[
				'title' => 'required'
			]);
			
			$expl = explode(',', $request->title);
			$total = count($expl);
			for($i=0; $i<$total; $i++){
				$checkTag = Tag::where('seotitle', '=', Str::slug($expl[$i], '-'))->count();
				if ($checkTag == 0) {
					Tag::create([
						'title' => $expl[$i],
						'seotitle' => Str::slug($expl[$i], '-'),
						'created_by' => Auth::User()->id,
						'updated_by' => Auth::User()->id
					]);
				}
			}
			
			return redirect('dashboard/tags')->with('flash_message', __('tag.store_notif'));
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
		if(Auth::user()->can('read-tags')) {
			$ids = Hashids::decode($id);
			$tag = Tag::findOrFail($ids[0]);

			return view('backend.tags.show', compact('tag'));
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
		if(Auth::user()->can('update-tags')) {
			$ids = Hashids::decode($id);
			$tag = Tag::findOrFail($ids[0]);

			return view('backend.tags.edit', compact('tag'));
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
		if(Auth::user()->can('update-tags')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'title' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$tag = Tag::findOrFail($ids[0]);
			$tag->update($requestData);

			return redirect('dashboard/tags')->with('flash_message', __('tag.update_notif'));
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
		if(Auth::user()->can('delete-tags')) {
			$ids = Hashids::decode($id);
			Tag::destroy($ids[0]);

			return redirect('dashboard/tags')->with('flash_message', __('tag.destroy_notif'));
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
		if(Auth::user()->can('delete-tags')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Tag::destroy($idd[0]);
				}
				return redirect('dashboard/tags')->with('flash_message', __('tag.destroy_notif'));
			} else {
				return redirect('dashboard/tags')->with('flash_message', __('tag.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	public function getTag(Request $request)
    {
		if(Auth::user()->can('read-tags')) {
			$tags = Tag::select('id', 'title', 'seotitle')->where('title', 'LIKE', '%'.$request->term.'%')->get();

			$result = array(
				'code' => '2000',
				'message' => 'Success',
				'data' => $tags
			);
			
			return \Response::json($result);
		} else {
			$result = array(
				'code' => '4004',
				'message' => 'Error',
				'data' => []
			);
			
			return \Response::json($result);
		}
    }
}
