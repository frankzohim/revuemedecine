<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Manuscripts;

class ReviewerController extends Controller
{
    public function create()
    {
        return view('reviewer.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'title' => ['required', 'string', 'min:2'],
         ]);
        
        $user = new \App\User();
        $user->title = $request->title;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->email_verified_at = now();
        $user->role_id = 4;
        
        
        if($user->save())
            
            return redirect()->route('reviewer.create')->with('update_success', 'Relecteur crée avec succès');
        
        else
             return redirect()->route('reviewer.create')->with('update_failure', "Une erreur est survenue lors de la création, veuillez réessayer.");
            
    }
    
    public function list()
    {
        $reviewers = DB::table('users')->where('role_id', '=', 4)->simplePaginate(15);
       
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
        
      return view('reviewer.list', compact('reviewers','cards'));
    }
}
