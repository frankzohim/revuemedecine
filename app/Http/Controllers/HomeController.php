<?php

namespace App\Http\Controllers;
use DB;
use App\Manuscripts;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware(['auth','verified']);
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()->role_id==1 || auth()->user()->role_id==3 )
            $manuscripts = DB::table('manuscripts')->simplePaginate(15);
        else
            $manuscripts = DB::table('manuscripts')->where('user_id', '=', auth()->user()->id)->simplePaginate(5);
        
        $manuscriptsAccepted = DB::table('manuscripts')->where('status', '=', 1)->count();
        $manuscriptsRejected = DB::table('manuscripts')->where('status', '=', 2)->count();
        $manuscriptsNumbers = DB::table('manuscripts')->count();
        $authorsNumbers = DB::table('users')->count();
        
        $cards = array(
            "manuscriptsAccepted" => $manuscriptsAccepted,
            "manuscriptsRejected" => $manuscriptsRejected,
            "manuscriptsNumbers" => $manuscriptsNumbers,
            "authorsNumbers" => $authorsNumbers
        );
        
        return view('dashboard', compact('manuscripts','cards'));
        //return view('setlayout');
    }
	
	
    public function dashboard()
    {
        
        if(auth()->user()->role_id==1 || auth()->user()->role_id==3 )
            $manuscripts = DB::table('manuscripts')->paginate(10);
        else
            $manuscripts = DB::table('manuscripts')->where('user_id', '=', auth()->user()->id)->paginate(10);
        
        $manuscriptsAccepted = DB::table('manuscripts')->where('status', '=', 1)->count();
        $manuscriptsRejected = DB::table('manuscripts')->where('status', '=', 2)->count();
        $manuscriptsNumbers = DB::table('manuscripts')->count();
        $authorsNumbers = DB::table('users')->count();
        
        $cards = array(
            "manuscriptsAccepted" => $manuscriptsAccepted,
            "manuscriptsRejected" => $manuscriptsRejected,
            "manuscriptsNumbers" => $manuscriptsNumbers,
            "authorsNumbers" => $authorsNumbers
        );
        
        return view('dashboard', compact('manuscripts','cards'));
    }
}
