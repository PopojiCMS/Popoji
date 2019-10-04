<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\User;

class BackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
		return view('backend.dashboard');
    }
	
	/**
     * Display forbidden pages.
     *
     * @return void
     */
    public function forbidden()
    {
		return view('backend.forbiden');
	}
}
