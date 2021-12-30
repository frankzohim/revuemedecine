<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Manuscripts;
use App\Assignments;

class AssignController extends Controller
{
    public function index($type)
    {
       
        $manuscripts = DB::table('manuscripts')->where('status', '=', 'En cours de traitement')->simplePaginate(15); 
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
        
        return view('assign.index', compact('manuscripts','cards','type'));
    }
    
    public function selectItems($manuscriptId, $type)
    {
        if($type =="reviewer")
            $reviewers = DB::table('users')->where('role_id', '=', 4)->simplePaginate(15);
        else
            $reviewers = DB::table('users')->where('role_id', '=', 5)->simplePaginate(15);
        
        //dd($reviewers);
       
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
        return view('assign.selectItems', compact('reviewers','cards','manuscriptId','type'));
    }
    
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'reviewers' => ['required', 'array', 'min:2','max:4'],
         ]);
       
        foreach($request->reviewers as $selectValue){
		
                //dd($selectValue);
                $assignment = new \App\Assignments;
                $assignment->manuscript_id = $request->manuscriptId;
                $assignment->user_id = $selectValue;
                $assignment->save();
	    }
        
        //Loading manuscript to update status
        $manuscript = Manuscripts::find($request->manuscriptId);
        $manuscript->status= "En Relecture";
        $manuscript->save();
       
         return redirect()->route('assign', ['type' => 'reviewer'])->with('message', 'Assignation effectuée avec succès, statut du manuscrit passé en mode Relecture');
    }
    
    public function saveEditor(Request $request)
    {
        
        $validatedData = $request->validate([
            'editorselect' => ['required', 'integer'],
         ]);
       
		
        $assignment = new \App\Assignments;
        $assignment->manuscript_id = $request->manuscriptId;
        $assignment->user_id = $request->editorselect;
        $assignment->save();
       
        return redirect()->route('assign', ['type' => 'editor'])->with('message', 'Assignation effectuée avec succès');
    }
    
}
