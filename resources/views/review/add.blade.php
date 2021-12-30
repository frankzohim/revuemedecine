@extends('layouts.app', ['title' => __("Edition d'un article")])

@section('content')
    @include('manuscript.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __("Bienvenu(e) à la page d'examen d'un manuscript."),
        'class' => 'col-lg-12'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h1 class="col-12 mb-0">{{ __("Soumission d'un Review") }}</h1>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('update_success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Succès! </strong> <strong>{{ session('update_success') }} </strong></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                         @endif
                         @if (session('update_failure'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                                    <span class="alert-text"><strong>Danger!</strong> <strong> {{ session('update_failure') }} </strong> </span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                         @endif
                         
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-book-bookmark mr-2"></i>Détails</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-single-copy-04 mr-2"></i>Figures & Tableaux</a>
                                </li>
                               <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-image mr-2"></i>Partie 1 </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>  Partie 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Partie 3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-7" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Partie 4</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                
                                <div class="tab-content" id="myTabContent">
                                    
                                     {{-- Begining Tab for Details --}}
                                    
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                      
                                       
                                        <form method="post" action="" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="pl-lg-4">
                                                
                                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Titre du manuscrit') }} : <br>
                                                     {{ $manuscript->title }}</label>
                                                 </div>
                                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Type du manuscrit') }} : 
                                                        {{ $manuscript->type }}</label>
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Langue du manuscrit') }} : 
                                                        {{ $manuscript->language }} </label>
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Pays d'origine du manuscrit") }}: @foreach ($countries as $key => $country)
                                                                @if ($manuscript->country_id == $country) 
                                                                    {{$key}}
                                                                @endif
                                                    @endforeach
                                                 </div>
                                                
                                                <div class="form-group{{ $errors->has('speciality') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Domaine du manuscrit') }} : 
                                                        @foreach ($specialities as $key => $speciality)
                                                                 @if ($manuscript->speciality_id == $speciality) 
                                                                     {{$key}}
                                                                 @endif 
                                                            @endforeach
                                                    </label>
                                                 </div>
                                                
                                                  <div class="form-group{{ $errors->has('abstract') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Abstract du manuscrit') }} : <br>
                                                        {{ $manuscript->abstract }}</label>
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('keywords') ? ' has-danger' : '' }}">
                                                    
                                                    <label class="form-control-label" for="input-type">{{ __('Mots clés') }} : {{ $manuscript->keywords }}</label>
                                                </div>
                                                
                                                 <div class="form-group{{ $errors->has('numbers_of_authors') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Nombre d'auteurs") }} : 
                                                        {{ $manuscript->numbers_of_authors }}</label>
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('numbers_of_figures') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Nombre de figures") }}: 
                                                        {{ $manuscript->numbers_of_figures }}</label>
                                                </div>
                                                <div class="form-group{{ $errors->has('cover_letter') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Lettre de couverture') }} <br> {{ $manuscript->cover_letter }}</label>
                                                 </div>
                                                 @if($manuscript->file != "")
                                           
                                                    <a href="{{ route('manuscript.download', ['manuscriptId' => $manuscript->id]) }}">
                                                        <button class="btn btn-icon btn-primary" type="button">
                                                            <span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                                                            <span class="btn-inner--text">Télécharger le fichier</span>
                                                        </button>
                                                     </a>
                                                @endif
                                            </div>
                                        </form>

                                    </div>
                                    {{-- Ending Tab for Details --}}
                            
                                    {{-- Begining Tab for Figures & Tables --}}
                                    
                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        
                                        
                                    </div>
                            
                                     {{-- Ending Tab for Figures & Tables --}}
                            
                                    {{-- Begining Tab for Part 1 --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form method="post" action="{{ route('review.save') }}" autocomplete="off">
                                            @csrf
                                            <div class="pl-lg-4">
                                                
                                                <div class="form-group{{ $errors->has('abstract') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('RESUME/ ABSTRACT') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='abstract'>
                                                            <option value="Bon" selected>Bon</option>
                                                            <option value="À modifier">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('abstract'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('abstract') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('abstract_comments') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="abstract_comments" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('abstract_comments') }}"></textarea>

                                                    @if ($errors->has('abstract_comments'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('abstract_comments') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('introduction') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('INTRODUCTION') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='introduction'>
                                                            <option value="Bonne" selected>Bonne</option>
                                                            <option value="À modifier">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('introduction'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('introduction') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('introduction_comments') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="introduction_comments" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('introduction_comments') }}"></textarea>

                                                    @if ($errors->has('introduction_comments'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('introduction_comments') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('clinic_case') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('CAS CLINIQUE SI ECHEANT') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='clinic_case'>
                                                            <option value="Pas un cas clinique" selected>Pas un cas clinique</option>
                                                            <option value="Bon" >Bon</option>
                                                            <option value="À modifier">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('clinic_case'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('clinic_case') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('clinic_case_comments') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="clinic_case_comments" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('clinic_case_comments') }}"></textarea>

                                                    @if ($errors->has('clinic_case_comments'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('clinic_case_comments') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Enregistrer & Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            
                                    {{-- Ending Tab for Part 1 --}}
                                    
                                    {{-- Begining Tab for Part 2 --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                        <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('METHODOLOGIE') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>Bonne</option>
                                                            <option value="Anglais">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels ') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}" disabled></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('DISCUSSION') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>Bonne</option>
                                                            <option value="Anglais">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}" disabled></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('CONCLUSION') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>Bonne</option>
                                                            <option value="Anglais">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}" disabled></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4" disabled>{{ __('Enregistrer & Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                    </div>
                                    {{-- Ending Tab for Part 2 --}}
                                        
                                    {{-- Begining Tab for Part 3 --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                                       <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('TABLEAUX si Echéant') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>Bons</option>
                                                            <option value="Anglais">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}" disabled></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('FIGURES si échéant') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>Bonnes</option>
                                                            <option value="Anglais">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}" disabled></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('IMAGES si échéant:') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>Bonnes</option>
                                                            <option value="Anglais">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}" disabled></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4" disabled>{{ __('Enregistrer & Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                    </div>
                                    {{-- Ending Tab for Part 3 --}}
                                        
                                    {{-- Begining Tab for Part 4 --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                                        <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('RÉFÉRENCES') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>Bonnes</option>
                                                            <option value="Anglais">À modifier</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Commentaires éventuels') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}" disabled></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('AVIS FINAL') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language' disabled>
                                                            <option value="Français" selected>ACCEPTER</option>
                                                            <option value="Anglais">ACCEPTER AVEC MODIFICATION ?</option>
                                                            <option value="Anglais">REJETER ?</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4" disabled>{{ __('Enregistrer & Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                    </div>
                                    {{-- Ending Tab for Part 4 --}}
                                </div>
                            </div>
                        </div>


                        
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection