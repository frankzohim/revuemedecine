<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Manuscripts;
use App\SpecialitySub;
use App\ManuscriptsAuthors;
use App\ManuscriptsFigures;
use App\ManuscriptsSpecialities;
use App\Mail\Manuscript;
use App\Mail\GeneralMail;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;


class ManuscriptController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    |  Manuscript Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new manuscript as well as their
    | validation and creation. 
	* @Author :  Frank Zohim
    |
    */
    
    /**
     * List manuscript of a given status.
     * @parameter status 
     * @return view
     */
    public function list($status)
    {
       $manuscriptsAccepted = DB::table('manuscripts')->where('status', '=', 'Rejeté')->count();
       $manuscriptsRejected = DB::table('manuscripts')->where('status', '=', 'Accepté')->count();
       $manuscriptsNumbers = DB::table('manuscripts')->count();
       $authorsNumbers = DB::table('users')->count();
       $cards = array(
                    "manuscriptsAccepted" => $manuscriptsAccepted,
                    "manuscriptsRejected" => $manuscriptsRejected,
                    "manuscriptsNumbers" => $manuscriptsNumbers,
                    "authorsNumbers" => $authorsNumbers
                );
        
       //Checking if status has been set
       if(isset($status)){
           $allstatus = array("Soumission", "En cours de traitement", "En Relecture");
           
           //checking if status has a normal value
           if(in_array($status, $allstatus)){
               
                $manuscripts = DB::table('manuscripts')->where('status', '=', $status)
                                                       ->paginate(10);
                return view('manuscript.index', compact('manuscripts','cards','status'));
           }
           else{
               $status ="All";
               $manuscripts = DB::table('manuscripts')->paginate(10);
               return view('manuscript.index', compact('manuscripts','cards','status'));
           }
            
           
       }
       else{
            $status ="All";
            $manuscripts = DB::table('manuscripts')->paginate(10);
            return view('manuscript.index', compact('manuscripts','cards','status'));
       }
           
    }
    
    
    public function create()
    {
        $lang = Session::get('locale');
        //dd($lang);
        if($lang=="en"){
            //Load countries in english
            $countries = FacadesDB::table("country")->orderBy('mane_en', 'ASC')->pluck("id", "mane_en");
            //Load specailities and sub specialities in english
            $specialities = FacadesDB::table("specialities")->orderBy('mane_en', 'ASC')->pluck("id", "mane_en");
            $specialitySub = FacadesDB::table("speciality_subs")->pluck("id", "mane_en");
        }
           
        else{
            //Load countries in french
            $countries = FacadesDB::table("country")->orderBy('name', 'ASC')->pluck("id", "name");
            //Load specailities and sub specialities in english
            $specialities = FacadesDB::table("specialities")->orderBy('name', 'ASC')->pluck("id", "name");
            $specialitySub = FacadesDB::table("speciality_subs")->pluck("id", "name");
        }
   
        //$countries = FacadesDB::table("country")->orderBy('name', 'ASC')->get();
        //dd($countries);
      
        
        // Creating a new collection to associate specialities to sub specialities
        $collection = collect([]);
        foreach($specialities as $key => $speciality){
            if($lang=="en")
                $specialitySub = FacadesDB::table("speciality_subs")->where('speciality_id', '=', $speciality)->pluck("id", "mane_en");
            else
                $specialitySub = FacadesDB::table("speciality_subs")->where('speciality_id', '=', $speciality)->pluck("id", "name");
            $collection->put($key, $specialitySub);
            //$collection->push($specialitySub);
        }
        
        //dd($collection->toArray());
        //Sending data to view
        return view('manuscript.create', compact('countries', 'collection'));
    }
 
    public function save(Request $request)
    {
        //dd($request->specialityselected);
        $validatedData = $request->validate([
            'type' => ['required', 'string'],
            'language' => ['required', 'string'],
            'country' => ['required', 'integer'],
            'specialityselected' => ['required', 'array', 'min:2','max:4'],
            'title' => ['required', 'unique:App\Manuscripts,title','string'],
            'abstract' => ['required', 'string'],
            'keywords' => ['required', 'string'],
            'numbers_of_authors' => ['required', 'integer'],
            'numbers_of_figures' => ['required', 'integer'],
         ]);
        
        $manuscript = new \App\Manuscripts;
        $manuscript->title = $request->title;
        $manuscript->type = $request->type;
        $manuscript->language = $request->language;
        $manuscript->abstract = $request->abstract;
        $manuscript->status = "Soumission";
        $manuscript->keywords = $request->keywords;
        $manuscript->numbers_of_authors = $request->numbers_of_authors;
        $manuscript->numbers_of_figures = $request->numbers_of_figures;
        $manuscript->user_id = auth()->user()->id;
        $manuscript->country_id = $request->country;
        $manuscript->achievement = 25;
        
        
        if($manuscript->save())
            {
                /*Mail::to('delanofofe@gmail.com')
                    ->send(new Manuscript($request->except('_token')));
                Mail::to('jutchaivaneinstein@yahoo.fr')
                    ->send(new Manuscript($request->except('_token')));
                Mail::to('willyngatchou@yahoo.fr')
                    ->send(new Manuscript($request->except('_token')));*/
            
                //dd($request->speciality);
                foreach($request->specialityselected as $key => $speciality){
                    
                    $manuscriptsSpecialities = new \App\ManuscriptsSpecialities;
                    $manuscriptsSpecialities->manuscript_id  = $manuscript->id;
                    $manuscriptsSpecialities->speciality_id = $speciality;
                    $manuscriptsSpecialities->save();
                }   
               
            }
       
        return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_success', "Manuscrit mis à jour avec succès.");
    }
    
    
    public function edit($manuscriptId)
    {
        //Loading countries
        $countries = FacadesDB::table("country")->orderBy('name', 'ASC')->pluck("id", "name");
        
        //Loading top specialities
        $specialities = FacadesDB::table("specialities")->orderBy('name', 'ASC')->pluck("id", "name");
        
        //Loading manuscript to edit
        $manuscript = Manuscripts::find($manuscriptId);
        
        // Creating a new collection to associate specialities to sub specialities
        $collection = collect([]);
        foreach($specialities as $key => $speciality){
            $specialitySub = FacadesDB::table("speciality_subs")->where('speciality_id', '=', $speciality)->pluck("id", "name");
            $collection->put($key, $specialitySub);
            //$collection->push($specialitySub);
        }
        //dd($collection);
        
        //Loading all authors for a manuscript
        $manuscriptsAuthors = DB::table('manuscripts_authors')->where('manuscript_id', '=', $manuscriptId)->paginate(10);
        
         //Loading all figures for a manuscript
        $manuscriptsFigures = DB::table('manuscripts_figures')->where('manuscript_id', '=', $manuscriptId)->paginate(10);
        
        //Loading all sub specialities for a manuscript
        $manuscriptsSpecialities = FacadesDB::table("manuscripts_specialities")->where('manuscript_id', '=', $manuscriptId)->pluck("speciality_id");
        
        // Creating a new collection to associate sub-specialities'id to their names
        $subSpecialities = collect([]);
        foreach($manuscriptsSpecialities as $key => $speciality){
            $specialitySub = FacadesDB::table("speciality_subs")->where('id', '=', $speciality)->pluck("name");
             //dd($specialitySub);
            $subSpecialities->put($key, $specialitySub);
        }
        
        //dd($subSpecialities);
        return view('manuscript.edit', compact('manuscript','countries', 'collection','specialities','manuscriptsAuthors','manuscriptsFigures','subSpecialities'));
    }
    
    
    public function update(Request $request)
    {
        dd($request->specialityselected);
        
        $manuscript = Manuscripts::find($request->manuscriptId);

        $manuscript->title = $request->title;
        $manuscript->type = $request->type;
        $manuscript->language = $request->language;
        $manuscript->abstract = $request->abstract;
        $manuscript->keywords = $request->keywords;
        $manuscript->numbers_of_authors = $request->numbers_of_authors;
        $manuscript->numbers_of_figures = $request->numbers_of_figures;
        $manuscript->user_id = auth()->user()->id;
        $manuscript->country_id = $request->country;

        if($manuscript->save())
        
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_success', 'Manuscrit mis à jour avec succès');
        else
             return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_failure', "Une erreur est survenue lors de la mise jour, veuillez réessayer.");
    }
    
    public function letter(Request $request)
    {
        $validatedData = $request->validate([
            'cover_letter' => ['required', 'string', 'max:2000'],
         ]);
        
        $manuscript = Manuscripts::find($request->manuscriptId);
        $manuscript->cover_letter = $request->cover_letter;
        
        if($manuscript->save())
        
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_success', 'Lettre de coverture mise à jour avec succès');
        else
             return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_failure', "Une erreur est survenue lors de la mise jour de la lettre, veuillez réessayer.");
    }
    
    public function authors(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'place_of_work' => ['required', 'string'],
            'place_of_work2' => ['required', 'string'],
            'place_of_work3' => ['required', 'string'],
            'country' => ['required', 'string'],
         ]);
            
        
        $manuscript = Manuscripts::find($request->manuscriptId);
        $manuscriptsAuthorsNumbers = DB::table('manuscripts_authors')->where('manuscript_id', '=', $manuscript->id)->count();
        
        if($manuscriptsAuthorsNumbers < $manuscript->numbers_of_authors){
            $manuscriptAuthors = new \App\ManuscriptsAuthors;
            $manuscriptAuthors->manuscript_id = $manuscript->id;
            $manuscriptAuthors->user_id = auth()->user()->id;
            $manuscriptAuthors->name = $request->name;
            $manuscriptAuthors->email  = $request->email;
            $manuscriptAuthors->place_of_work  = $request->placeofwork_select1.":".$request->place_of_work;
            $manuscriptAuthors->place_of_work2  = $request->placeofwork_select2.":".$request->place_of_work2;
            $manuscriptAuthors->place_of_work3  = $request->placeofwork_select3.":".$request->place_of_work3;
            $manuscriptAuthors->country = $request->country;
            $manuscriptAuthors->corresponding_author = 0;
            $manuscriptAuthors->save();
            
            $manuscript->achievement = $manuscript->achievement + 25/$manuscript->numbers_of_authors;
            $manuscript->save();
            
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_success', 'Auteur ajouté avec succès');
        }
        else{
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_failure', "Vous avez atteint le nombre limite d'auteurs");
        }
    }
    
    
    public function corresponding_author(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'postal_address' => ['required', 'string', 'max:255'],
            'place_of_work' => ['required', 'string'],
            'place_of_work2' => ['required', 'string'],
            'place_of_work3' => ['required', 'string'],
            'country' => ['required', 'string'],
         ]);
            
        //Loadinf the manuscript
        $manuscript = Manuscripts::find($request->manuscriptId);
        
        
        //checking if corresponding author has already been added
       
        $corresponding_author = DB::table('manuscripts_authors')->where([['manuscript_id', '=', $manuscript->id],
                                                                        ['corresponding_author', '=', 1]
                                                                        ])->count();
        
        if($corresponding_author == 0){
            $manuscriptAuthors = new \App\ManuscriptsAuthors;
            $manuscriptAuthors->manuscript_id = $manuscript->id;
            $manuscriptAuthors->user_id = auth()->user()->id;
            $manuscriptAuthors->name = $request->name;
            $manuscriptAuthors->phone = $request->phone;
            $manuscriptAuthors->postal_address = $request->postal_address;
            $manuscriptAuthors->email  = $request->email;
            $manuscriptAuthors->place_of_work  = $request->placeofwork_select1.":".$request->place_of_work;
            $manuscriptAuthors->place_of_work2  = $request->placeofwork_select2.":".$request->place_of_work2;
            $manuscriptAuthors->place_of_work3  = $request->placeofwork_select3.":".$request->place_of_work3;
            $manuscriptAuthors->country = $request->country;
            $manuscriptAuthors->corresponding_author = 1;
            $manuscriptAuthors->save();
            
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_success', 'Auteur correspondant ajouté avec succès');
        }
        else{
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_failure', "Un auteur correspondant a déjà été ajouté sur ce manuscrit");
        }
    }
    
    public function figures(Request $request)
    {
      //Validating data from form
      $validatedData = $request->validate([
            'figure_name' => ['required', 'string', 'max:200'],
            'figurefile'  => 'file|required|mimes:doc,docx|max:2048',
         ]);
            
        //Loading manuscript object and numbers of figures already save for that manuscript
        $manuscript = Manuscripts::find($request->manuscriptId);
        $manuscriptsFiguresNumbers = DB::table('manuscripts_figures')->where('manuscript_id', '=', $manuscript->id)->count();
        
        /*Verified if the number of figures is not yet reach before saving
        *If reach, no save made, else save and update manuscript achievement field
        */
        if($manuscriptsFiguresNumbers < $manuscript->numbers_of_figures){
            $manuscriptFigures = new \App\ManuscriptsFigures;
            $manuscriptFigures->manuscript_id = $manuscript->id;
            $manuscriptFigures->name = $request->figure_name;
            
            //File name to save
            $fileName = $request->manuscriptId.'_'.time().'_'.$request->figurefile->getClientOriginalName().'.'.$request->figurefile->extension(); 
            
             //Storing file in disk
            $request->figurefile->storeAs('figures-files', $fileName);
            
            $manuscriptFigures->file = $fileName;
            $manuscriptFigures->save();
            
           
            
            //Updating manuscript 
            $manuscript->achievement = $manuscript->achievement + 25/$manuscript->numbers_of_figures;
            $manuscript->save();
            
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_success', 'Figure ajouté avec succès');
        }
        else{
            return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_failure', "Vous avez atteint le nombre limite de figures");
        }
    }
    
    
    public function storeFile(Request $request)
    {
      request()->validate([
         'manuscriptfile'  => 'file|required|mimes:doc,docx,pdf',
       ]);
        
        $fileName = $request->manuscriptId.'_'.time().'_'.$request->manuscriptfile->getClientOriginalName().'.'.$request->manuscriptfile->extension(); 
        
        $manuscript = Manuscripts::find($request->manuscriptId);
        
        //Storing file in disk
        $request->manuscriptfile->storeAs('manuscript-files', $fileName);
        
        if($manuscript->file == NULL)
            $manuscript->achievement = $manuscript->achievement + 25;
        
        //Updating file in manuscript table
        
        $oldfile = $manuscript->file; // Retrieving the old file name
        $manuscript->file = $fileName;
        $manuscript->save();
        
        //Deleting the old file from the disk
        Storage::delete('manuscript-files/' . $oldfile);
    
        return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript->id])->with('update_success', 'Fichier télécharger avec succès');
    }
    
    public function download($manuscriptId)
    {
       $manuscript = Manuscripts::find($manuscriptId);
       return response()->download(storage_path('app/manuscript-files/' . $manuscript->file));
        
    }
    
    public function delete($manuscriptId)
    {
       $manuscript = Manuscripts::find($manuscriptId);
       $manuscript->delete();
       return redirect()->back()->with('message', 'Manuscrit supprimé avec succès');
    }
    
    public function publish($manuscriptId)
    {
       $manuscript = Manuscripts::find($manuscriptId);
       $manuscript->status = 1;
       $manuscript->save();
       return redirect()->back()->with('message', 'Manuscrit publié avec succès');
    }
    
    public function statusUpdate(Request $request)
    {
    //dd($request->manuscriptId);
       $manuscript = Manuscripts::find($request->manuscriptId);
       $manuscript->status = $request->status;
       $manuscript->save();
       return redirect()->back()->with('message', 'Status mis avec succès');
    }
    
    public function supprimer($id)
    {
       $manuscriptAuthors = ManuscriptsAuthors::find($id);
       $manuscript = Manuscripts::find($manuscriptAuthors->manuscript_id);
       $manuscriptAuthors->delete();
       $manuscript->achievement = $manuscript->achievement - 25/$manuscript->numbers_of_authors;
            $manuscript->save();
       return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript])->with('update_success', "Auteur supprimé avec succès");
    }
    
     

    public function visualize($manuscriptId)
    {
        //dd("hi");
      //Loading countries
        $countries = FacadesDB::table("country")->orderBy('name', 'ASC')->pluck("id", "name");
        
        //Loading top specialities
        $specialities = FacadesDB::table("specialities")->orderBy('name', 'ASC')->pluck("id", "name");
        
        //Loading manuscript to edit
        $manuscript = Manuscripts::find($manuscriptId);
        
        // Creating a new collection to associate specialities to sub specialities
        $collection = collect([]);
        foreach($specialities as $key => $speciality){
            $specialitySub = FacadesDB::table("speciality_subs")->where('speciality_id', '=', $speciality)->pluck("id", "name");
            $collection->put($key, $specialitySub);
            //$collection->push($specialitySub);
        }
        //dd($collection);
        
        //Loading all authors for a manuscript
        $manuscriptsAuthors = DB::table('manuscripts_authors')->where('manuscript_id', '=', $manuscriptId)->paginate(10);
        
         //Loading all figures for a manuscript
        $manuscriptsFigures = DB::table('manuscripts_figures')->where('manuscript_id', '=', $manuscriptId)->paginate(10);
        
        //Loading all sub specialities for a manuscript
        $manuscriptsSpecialities = FacadesDB::table("manuscripts_specialities")->where('manuscript_id', '=', $manuscriptId)->pluck("speciality_id");
        
        // Creating a new collection to associate sub-specialities'id to their names
        $subSpecialities = collect([]);
        foreach($manuscriptsSpecialities as $key => $speciality){
            $specialitySub = FacadesDB::table("speciality_subs")->where('id', '=', $speciality)->pluck("name");
             //dd($specialitySub);
            $subSpecialities->put($key, $specialitySub);
        }
        
        //dd($subSpecialities);
        return view('manuscript.processing', compact('manuscript','countries', 'collection','specialities','manuscriptsAuthors','manuscriptsFigures','subSpecialities'));
          
    }
    
    /**
     * Submitting a manuscript.
     * @parameter request 
     * @return route
     */
    public function submission(Request $request)
    {
      $manuscript = Manuscripts::find($request->manuscriptId);
        
      //Only submit if achievement is greater than 99%
      if($manuscript->achievement > 99){
           $manuscript->status = "En cours de traitement";
           $manuscript->save();
          $mailItem['subject'] = "Un manuscrit a été bien soumis";
          $mailItem['message'] = 'Le manuscrit "'.$manuscript->title.'" vient d\'être validé et soumis sous la plateforme.';
          Mail::to('delanofofe@gmail.com')
                    ->send(new GeneralMail($mailItem));
          
          Mail::to('jutchaivaneinstein@yahoo.fr')
                    ->send(new GeneralMail($mailItem));
          
          Mail::to('willyngatchou@yahoo.fr')
                    ->send(new GeneralMail($mailItem));
          
           Mail::to(auth()->user()->email)
                    ->send(new GeneralMail($mailItem));
          
           return redirect()->route('manuscript.processing', ['manuscriptId' => $manuscript])->with('update_success', "Manuscrit soumis avec succès");
      }
      else
          return redirect()->route('manuscript.edit', ['manuscriptId' => $manuscript])->with('update_failure', "Votre manuscrit n'est pas prêt à être soumis");
          
    }
    
    /**
     * Submitting a manuscript.
     * @parameter request 
     * @return route
     */
    public function notifyAuthors($manuscriptId)
    {
          
          $manuscript = Manuscripts::find($manuscriptId);
         

          //$manuscriptsAuthors = DB::table('manuscripts_authors')->where('manuscript_id', '=', $manuscriptId);
          $manuscriptsAuthors = FacadesDB::table("manuscripts_authors")->where('manuscript_id', '=', $manuscriptId)
                                                                       ->orderBy('name', 'ASC')
                                                                       ->pluck("name","email");
          //dd($manuscriptsAuthors);
          foreach($manuscriptsAuthors as $email => $name){
              
              $mailItem['subject'] = "Confirmez que vous êtes co-auteur";
               $mailItem['message'] = "Hello Mr/Mme $name,<br/> 
                                 Un manuscrit a été soumis sur la plateforme de la revue de médecine de douala en vous désignant comme co-auteur.<br/>
                                 Titre du manuscrit : $manuscript->title <br/> 
                                 Abastract du manuscrit : $manuscript->abstract <br/> 
                                 Validez vous ces informations? Veuillez répondre à cet email pour donner votre réponse.";
              Mail::to($email)
                        ->send(new GeneralMail($mailItem));
          }

          return redirect()->back()->with('message', 'Mail envoyé avec succès');

        }
}
