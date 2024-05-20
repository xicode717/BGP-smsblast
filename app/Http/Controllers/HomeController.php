<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MMasterClient;
use App\Models\MSMSBlast;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'total_kirim'   => MSMSBlast::count(),
            'total_user'    => MMasterClient::count(),
        ];
        return view('admin.home.index', $data);
    }
}
