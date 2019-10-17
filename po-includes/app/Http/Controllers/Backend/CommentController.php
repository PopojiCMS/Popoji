<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Comment;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-comments')) {
			return view('backend.comment.datatable');
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
		if(Auth::user()->can('read-comments')) {
			return view('backend.comment.datatable');
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
		$comments = Comment::leftJoin('users', 'users.id', '=', 'comments.created_by')
			->select('comments.*', 'users.id as uid', 'users.name as uname');
		return Datatables::of($comments)
			->addColumn('check', function ($comment) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($comment->id).'" disabled />
				</div>';
				return $check;
			})
			->addColumn('name', function ($comment) {
				return $comment->name.' - '.$comment->email.'<br />'.__('comment.post').' : <a href="'.url('/detailpost/'.$comment->post->seotitle).'" target="_blank">'.$comment->post->title.'</a>';
			})
			->addColumn('active', function ($comment) {
				return $comment->active == 'Y' ? __('comment.publish') : __('comment.unpublish');
			})
			->addColumn('created_at', function ($comment) {
				return date('d M y H:i', strtotime($comment->created_at));
			})
            ->addColumn('action', function ($comment) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/comments/'.Hashids::encode($comment->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/comments/reply/'.Hashids::encode($comment->id)).'" class="btn btn-success btn-xs btn-icon" title="'.__('comment.reply').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-reply"></i></a>';
				$btn .= '<a href="'.url('dashboard/comments/'.Hashids::encode($comment->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/comments/'.Hashids::encode($comment->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($comment) {
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
		if(Auth::user()->can('create-comments')) {
			return view('backend.comment.create');
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
		if(Auth::user()->can('create-comments')) {
			$this->validate($request,[
				'parent' => 'required',
				'post_id' => 'required',
				'name' => 'required',
				'email' => 'required',
				'content' => 'required'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Comment::create($requestData);
			
			return redirect('dashboard/comments')->with('flash_message', __('comment.store_notif'));
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
		if(Auth::user()->can('read-comments')) {
			$ids = Hashids::decode($id);
			$comment = Comment::findOrFail($ids[0]);
			$comment->update([
				'status' => 'Y',
				'updated_by' => Auth::User()->id
			]);

			return view('backend.comment.show', compact('comment'));
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
		if(Auth::user()->can('update-comments')) {
			$ids = Hashids::decode($id);
			$comment = Comment::findOrFail($ids[0]);

			return view('backend.comment.edit', compact('comment'));
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
		if(Auth::user()->can('update-comments')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'parent' => 'required',
				'post_id' => 'required',
				'name' => 'required',
				'email' => 'required',
				'content' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$comment = Comment::findOrFail($ids[0]);
			$comment->update($requestData);

			return redirect('dashboard/comments')->with('flash_message', __('comment.update_notif'));
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
		if(Auth::user()->can('delete-comments')) {
			$ids = Hashids::decode($id);
			Comment::destroy($ids[0]);

			return redirect('dashboard/comments')->with('flash_message', __('comment.destroy_notif'));
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
		if(Auth::user()->can('delete-comments')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					Comment::destroy($idd[0]);
				}
				return redirect('dashboard/comments')->with('flash_message', __('comment.destroy_notif'));
			} else {
				return redirect('dashboard/comments')->with('flash_message', __('comment.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	public function reply($id)
    {
		if(Auth::user()->can('update-comments')) {
			$ids = Hashids::decode($id);
			$comment = Comment::findOrFail($ids[0]);

			return view('backend.comment.reply', compact('comment'));
		} else {
			return redirect('forbidden');
		}
    }
	
	public function postReply(Request $request)
    {
		if(Auth::user()->can('create-comments')) {
			$this->validate($request,[
				'parent' => 'required',
				'post_id' => 'required',
				'content' => 'required'
			]);

			$request->request->add([
				'name' => Auth::User()->name,
				'email' => Auth::User()->email,
				'active' => 'Y',
				'status' => 'Y',
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Comment::create($requestData);
			
			return redirect('dashboard/comments')->with('flash_message', __('comment.store_notif'));
		} else {
			return redirect('forbidden');
		}
    }
}
