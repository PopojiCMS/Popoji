<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Post;
use App\PostGallery;
use App\Category;
use App\Tag;
use App\Subscribe;

use App\Mail\SubscribeMail;

use DB;

use Yajra\Datatables\Datatables;
use Vinkla\Hashids\Facades\Hashids;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
		if(Auth::user()->can('read-posts')) {
			return view('backend.post.datatable');
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
		if(Auth::user()->can('read-posts')) {
			return view('backend.post.datatable');
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
		if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')) {
			$posts = Post::leftJoin('categories', 'categories.id', '=', 'posts.category_id')
				->leftJoin('users', 'users.id', '=', 'posts.created_by')
				->select('posts.*', 'categories.id as cid', 'categories.title as ctitle', 'users.id as uid', 'users.name as uname');
		} else {
			$posts = Post::leftJoin('categories', 'categories.id', '=', 'posts.category_id')
				->leftJoin('users', 'users.id', '=', 'posts.created_by')
				->where('posts.created_by', '=', Auth::user()->id)
				->select('posts.*', 'categories.id as cid', 'categories.title as ctitle', 'users.id as uid', 'users.name as uname');
		}
		return Datatables::of($posts)
			->addColumn('check', function ($post) {
				$check = '<div style="text-align:center;">
					<input type="checkbox" id="titleCheckdel" />
					<input type="hidden" class="deldata" name="id[]" value="'.Hashids::encode($post->id).'" disabled />
				</div>';
				return $check;
			})
			->addColumn('title', function ($post) {
				return $post->title.' ('.$post->hits.' '.__('post.seen').')<br /><a href="'.url('/detailpost/'.$post->seotitle).'" target="_blank">'.url('/detailpost/'.$post->seotitle).'</a>';
			})
			->addColumn('type', function ($post) {
				return ucfirst($post->type);
			})
			->addColumn('active', function ($post) {
				return $post->active == 'Y' ? __('post.active') : __('post.deactive');
			})
			->addColumn('headline', function ($post) {
				return $post->headline == 'Y' ? __('general.yes') : __('general.no');
			})
            ->addColumn('action', function ($post) {
				$btn = '<div style="text-align:center;"><div class="btn-group">';
				$btn .= '<a href="'.url('dashboard/posts/'.Hashids::encode($post->id).'').'" class="btn btn-secondary btn-xs btn-icon" title="'.__('general.view').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-eye"></i></a>';
				$btn .= '<a href="'.url('dashboard/posts/subscribes/'.Hashids::encode($post->id).'').'" class="btn btn-success btn-xs btn-icon" title="'.__('general.send_subscribes').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-envelope"></i></a>';
				$btn .= '<a href="'.url('dashboard/posts/'.Hashids::encode($post->id).'/edit').'" class="btn btn-primary btn-xs btn-icon" title="'.__('general.edit').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-edit"></i></a>';
				$btn .= '<a href="'.url('dashboard/posts/'.Hashids::encode($post->id).'').'" class="btn btn-danger btn-xs btn-icon" data-delete="" title="'.__('general.delete').'" data-toggle="tooltip" data-placement="left"><i class="fa fa-trash"></i></a>';
				$btn .= '</div></div>';
				return $btn;
            })
			->addColumn('control', function ($post) {
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
		if(Auth::user()->can('create-posts')) {
			$categorys = Category::where('active', '=', 'Y')->get()->toArray();
			
			return view('backend.post.create', compact('categorys'));
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
		if(Auth::user()->can('create-posts')) {
			$this->validate($request,[
				'category_id' => 'required',
				'title' => 'required',
				'seotitle' => 'required|string|unique:posts',
				'type' => 'required',
				'active' => 'required',
				'headline' => 'required',
				'comment' => 'required'
			]);

			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			Post::create($requestData);
			
			$breaktags = explode(',', $request->tag);
			$totaltags = count($breaktags);
			if ($totaltags > 0) {
				for($i=0; $i<$totaltags; $i++){
					$checktag = Tag::where('seotitle', '=', Str::slug($breaktags[$i], '-'))->count();
					if($checktag > 0) {
						Tag::where('seotitle', '=', Str::slug($breaktags[$i], '-'))->update([
							'count' => DB::raw('count+1'),
							'updated_by' => Auth::User()->id
						]);
					} else {
						Tag::create([
							'title' => $breaktags[$i],
							'seotitle' => Str::slug($breaktags[$i], '-'),
							'created_by' => Auth::User()->id,
							'updated_by' => Auth::User()->id
						]);
					}
				}
			}
			
			return redirect('dashboard/posts')->with('flash_message', __('post.store_notif'));
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
		if(Auth::user()->can('read-posts')) {
			$ids = Hashids::decode($id);
			$post = Post::findOrFail($ids[0]);
			$post_gallerys = PostGallery::where('post_id', '=', $post->id)->get();

			return view('backend.post.show', compact('post', 'post_gallerys'));
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
		if(Auth::user()->can('update-posts')) {
			$ids = Hashids::decode($id);
			$post = Post::findOrFail($ids[0]);
			$post_gallerys = PostGallery::where('post_id', '=', $post->id)->get();
			$categorys = Category::where('active', '=', 'Y')->get()->toArray();
			
			if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')) {
				return view('backend.post.edit', compact('post', 'post_gallerys' ,'categorys'));
			} else {
				if ($post->created_by == Auth::user()->id) {
					return view('backend.post.edit', compact('post', 'post_gallerys' ,'categorys'));
				} else {
					return redirect('forbidden');
				}
			}
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
		if(Auth::user()->can('update-posts')) {
			$ids = Hashids::decode($id);
			$this->validate($request,[
				'category_id' => 'required',
				'title' => 'required',
				'seotitle' => 'required|string|unique:posts,seotitle,' . $ids[0],
				'type' => 'required',
				'active' => 'required',
				'headline' => 'required',
				'comment' => 'required'
			]);
			$request->request->add([
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();

			$post = Post::findOrFail($ids[0]);
			$post->update($requestData);
			
			$breaktags = explode(',', $request->tag);
			$totaltags = count($breaktags);
			if ($totaltags > 0) {
				for($i=0; $i<$totaltags; $i++){
					$checktag = Tag::where('seotitle', '=', Str::slug($breaktags[$i], '-'))->count();
					if($checktag > 0) {
						Tag::where('seotitle', '=', Str::slug($breaktags[$i], '-'))->update([
							'count' => DB::raw('count+1'),
							'updated_by' => Auth::User()->id
						]);
					} else {
						Tag::create([
							'title' => $breaktags[$i],
							'seotitle' => Str::slug($breaktags[$i], '-'),
							'created_by' => Auth::User()->id,
							'updated_by' => Auth::User()->id
						]);
					}
				}
			}

			return redirect('dashboard/posts')->with('flash_message', __('post.update_notif'));
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
		if(Auth::user()->can('delete-posts')) {
			$ids = Hashids::decode($id);
			if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')) {
				Post::destroy($ids[0]);
			} else {
				$post = Post::findOrFail($ids[0]);
				
				if ($post->created_by == Auth::user()->id) {
					Post::destroy($ids[0]);
				} else {
					return redirect('forbidden');
				}
			}

			return redirect('dashboard/posts')->with('flash_message', __('post.destroy_notif'));
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
		if(Auth::user()->can('delete-posts')) {
			if ($request->has('id')) {
				$ids = $request->id;
				foreach($ids as $id){
					$idd = Hashids::decode($id);
					if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')) {
						Post::destroy($idd[0]);
					} else {
						$post = Post::findOrFail($idd[0]);
						
						if ($post->created_by == Auth::user()->id) {
							Post::destroy($idd[0]);
						} else {
							return redirect('forbidden');
						}
					}
				}
				return redirect('dashboard/posts')->with('flash_message', __('post.destroy_notif'));
			} else {
				return redirect('dashboard/posts')->with('flash_message', __('post.destroy_error_notif'));
			}
		} else {
			return redirect('forbidden');
		}
    }
	
	public function createGallery(Request $request)
    {
		if(Auth::user()->can('create-posts')) {
			$this->validate($request, [
				'post_id' => 'required',
				'title' => 'required',
				'picture' => 'required'
			]);
			$request->request->add([
				'created_by' => Auth::User()->id,
				'updated_by' => Auth::User()->id
			]);
			$requestData = $request->all();
			
			$postgallery = PostGallery::create($requestData);
			
			$result = array(
				'code' => '2000',
				'message' => 'Success',
				'data' => array(
					'id' => Hashids::encode($postgallery->id),
					'title' => $postgallery->title,
					'picture' => asset('po-content/uploads/medium/medium_' . $postgallery->picture)
				)
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
	
	public function deleteGallery(Request $request)
    {
		if(Auth::user()->can('delete-posts')) {
			$ids = Hashids::decode($request->id);
			PostGallery::destroy($ids[0]);
			
			$result = array(
				'code' => '2000',
				'message' => 'Success',
				'data' => []
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
	
	public function subscribes($id)
    {
		$ids = Hashids::decode($id);
		$subscribes = Subscribe::where('follow', '=', 'Y')->get();
		$post = Post::findOrFail($ids[0]);
		
		foreach($subscribes as $subscribe) {
			Mail::to($subscribe->email, $subscribe->name)
				->queue(new SubscribeMail([
					'person' => $subscribe,
					'post' => $post
				]));
		}
		
		return redirect('dashboard/posts')->with('flash_message', __('post.subscribe_notif'));
	}
}
