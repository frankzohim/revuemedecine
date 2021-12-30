<?php

namespace App\Http\Controllers;
use DB;
use App\Review;
use App\Manuscripts;
use App\Mail\Manuscript;
use App\ManuscriptsSpecialities;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
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
        
        return view('review.index', compact('manuscripts','cards'));
    }
    
    
     public function add($manuscriptId)
    {
        $countries = FacadesDB::table("country")->orderBy('name', 'ASC')->pluck("id", "name");
        $specialities = FacadesDB::table("specialities")->orderBy('name', 'ASC')->pluck("id", "name");
        $manuscript = Manuscripts::find($manuscriptId);
         
        //Check if a review exist with this manuscript and connected user
        
        $reviews = DB::table('reviews')->where([
                                        ['manuscript_id', '=', $manuscriptId],
                                        ['user_id', '=', auth()->user()->id],
                                    ])->count();
         //dd($review);
        if($reviews == 1){
            //dd("zombie");
            $review1 = DB::table('reviews')->select('id')->where([
                                        ['manuscript_id', '=', $manuscriptId],
                                        ['user_id', '=', auth()->user()->id],
                                    ])->pluck('id');
            $id = $review1[0];
            return redirect()->route('review.edit', ['reviewId' => $id]);
        }
            
        else{
            
         return view('review.add', compact('manuscript','countries', 'specialities'));
        }
    }
    
    public function save(Request $request)
    {
       $validatedData = $request->validate([
            'abstract' => ['required', 'string'],
            'introduction' => ['required', 'string'],
            'clinic_case' => ['required', 'string'],
         ]);
        
        $review = new \App\Review;
        $review->manuscript_id = $request->manuscriptId;
        $review->user_id = auth()->user()->id;
        $review->abstract = $request->abstract;
        $review->abstract_comments = $request->abstract_comments;
        $review->introduction = $request->introduction;
        $review->introduction_comments = $request->introduction_comments;
        $review->clinic_case = $request->clinic_case;
        $review->clinic_case_comments = $request->clinic_case_comments;
        $review->achievement = 25;
       
        if($review->save())
        
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with('update_success', 'Données enregistrées avec succès');
        else
             return redirect()->route('review.add')->with('update_failure', "Une erreur est survenue lors de l'enregistrement, veuillez réessayer.");
    }
    
    public function edit($reviewId)
    {
        $countries = FacadesDB::table("country")->orderBy('name', 'ASC')->pluck("id", "name");
        $specialities = FacadesDB::table("specialities")->orderBy('name', 'ASC')->pluck("id", "name");
        $review = Review::find($reviewId);
        $manuscript = Manuscripts::find($review->manuscript_id);
        
        return view('review.edit', compact('review','manuscript','countries', 'specialities'));
    }
    
    public function part2(Request $request)
    {
       $validatedData = $request->validate([
            'methodology' => ['required', 'string'],
            'discussion' => ['required', 'string'],
            'conclusion' => ['required', 'string'],
         ]);
        
        $review = Review::find($request->reviewId);
        if($review->methodology == NULL)
            $review->achievement = $review->achievement + 25;
        $review->methodology = $request->methodology;
        $review->methodology_comments = $request->methodology_comments;
        $review->discussion = $request->discussion;
        $review->discussion_comments = $request->discussion_comments;
        $review->conclusion = $request->conclusion;
        $review->conclusion_comments = $request->conclusion_comments;
    
        if($review->save())
        
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with('update_success', 'Données enregistrées avec succès');
        else
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with("Une erreur est survenue lors de l'enregistrement, veuillez réessayer.");
             
    }
    
    public function part3(Request $request)
    {
       $validatedData = $request->validate([
            'tables' => ['required', 'string'],
            'figures' => ['required', 'string'],
            'images' => ['required', 'string'],
         ]);
        
       $review = Review::find($request->reviewId);
       $review = Review::find($request->reviewId);
        if($review->tables == NULL)
            $review->achievement = $review->achievement + 25;
        $review->tables = $request->tables;
        $review->tables_comments = $request->tables_comments;
        $review->figures = $request->figures;
        $review->figures_comments = $request->figures_comments;
        $review->images = $request->images;
        $review->images_comments = $request->images_comments;
       
        if($review->save())
        
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with('update_success', 'Données enregistrées avec succès');
        else
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with("Une erreur est survenue lors de l'enregistrement, veuillez réessayer.");
    }
    
     public function part4(Request $request)
    {
       $validatedData = $request->validate([
            'references' => ['required', 'string'],
            'final_decision' => ['required', 'string'],
         ]);
        
        $review = Review::find($request->reviewId);
        if($review->refers == NULL)
            $review->achievement = $review->achievement + 25;
        $review->refers = $request->references;
        $review->references_comments = $request->references_comments;
        $review->final_decision = $request->final_decision;
       
        if($review->save())
        
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with('update_success', 'Données enregistrées avec succès');
        else
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with("Une erreur est survenue lors de l'enregistrement, veuillez réessayer.");
    }
    
    
    public function update(Request $request)
    {
        
        $review = Review::find($request->reviewId);
        $review->abstract = $request->abstract;
        $review->abstract_comments = $request->abstract_comments;
        $review->introduction = $request->introduction;
        $review->introduction_comments = $request->introduction_comments;
        $review->clinic_case = $request->clinic_case;
        $review->clinic_case_comments = $request->clinic_case_comments;

        if($review->save())
        
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with('update_success', 'Données enregistrées avec succès');
        else
            return redirect()->route('review.edit', ['reviewId' => $review->id])->with("Une erreur est survenue lors de l'enregistrement, veuillez réessayer.");
    }
}
