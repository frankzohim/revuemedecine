@extends('layouts.app', ['title' => __("Edition d'un article")])

@section('content')
    @include('manuscript.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __("Votre manuscrit est en cours de traitement, nous vous notifierons dès qu'il ya un changement de status! Merci"),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h1 class="col-12 mb-0">{{ __("Status") }} : {{("$manuscript->status")}}</h1>
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
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-single-copy-04 mr-2"></i>Lettre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-single-02 mr-2"></i>Auteurs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false"><i class="ni ni-image mr-2"></i>Figures</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>  Télécharger le fichier</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Résumé</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                
                                <div class="tab-content" id="myTabContent">
                                    
                                     {{-- Begining Tab for Details --}}
                                    
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <h3>{{ __("Entrez los données de votre manuscrit") }}</h3>
                                        <p class="description">Le formulaire ci-dessous est utilisé pour collecter des informations de base sur le manuscrit que vous êtes sur le point de soumettre. Veuillez vérifier très attentivement les informations fournies. Vous pourrez revenir en arrière et mettre à jour ces informations plus tard en vous connectant au site.<br>
                                        Tous les champs sont obligatoires.</p>
                                        <form method="post" action="{{ route('manuscript.update') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="pl-lg-4">
                                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Type du manuscrit') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='type'>
                                                            <option value="Brève" @if ($manuscript->type ==="Brève") selected @endif>Brève</option>
                                                            <option value="Etude de cas" @if ($manuscript->type ==="Etude de cas") selected @endif>Etude de cas</option>
                                                         </select>

                                                    @if ($errors->has('type'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('type') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Langue du manuscrit') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language'>
                                                            <option value="Français" 
                                                                    @if ($manuscript->language ==="Français") selected @endif  >Français</option>
                                                            <option value="Anglais" @if ($manuscript->language ==="Anglais") selected @endif >Anglais</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Pays d'origine du manuscrit") }}</label>

                                                        <select class="form-control"  title="Simple select"  name='country'>
                                                           @foreach ($countries as $key => $country)
                                                                <option value="{{$country}}" @if ($manuscript->country_id == $country) selected @endif> {{$key}}</option>
                                                            @endforeach
                                                         </select>
                                                            
                                                    @if ($errors->has('country'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('country') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                <div class="form-group{{ $errors->has('speciality') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Domaine du manuscrit') }}</label>

                                                       
                                                         <select class="form-control"  title="Simple select"  name='speciality' id='speciality'>
                                                            @foreach ($collection as $speciality => $subspeciality)
                                                                 <optgroup label="{{$speciality}}">
                                                                 
                                                                    @foreach ($subspeciality as $key => $value)
                                                                     <option value="{{$value}}"> {{$key}}</option>
                                                                    @endforeach
                                                                         
                                                                 </optgroup>
                                                            @endforeach
                                                         </select>

                                                    @if ($errors->has('speciality'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('speciality') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Titre du manuscrit') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ $manuscript->title }}">{{ $manuscript->title }}</textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                  <div class="form-group{{ $errors->has('abstract') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Abstract du manuscrit(500 Mots Max)') }}</label>

                                                    <textarea name="abstract" class="form-control" id="exampleFormControlTextarea1" rows="5" value="{{ $manuscript->abstract }}">{{ $manuscript->abstract }}</textarea>

                                                    @if ($errors->has('abstract'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('abstract') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('keywords') ? ' has-danger' : '' }}">
                                                    
                                                    <label class="form-control-label" for="input-type">{{ __('Mots clés - Saisissez au moins 3 mots clés pour votre manuscrit.(les mots clés doivent être séparés par des virgules)') }}</label>
                                                        <input class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}" type="text" name="keywords" value="{{ $manuscript->keywords }}" required>
                                                    
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('keywords') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                 <div class="form-group{{ $errors->has('numbers_of_authors') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Nombre d'auteurs") }}</label>

                                                        <select class="form-control"  title="Simple select"  name='numbers_of_authors'>
                                                                @for ($i = 1; $i <= 20; $i++)
                                                                    <option value="{{ $i }}" @if ($manuscript->numbers_of_authors == $i) selected @endif>{{ $i }}</option>
                                                                @endfor
                                                            
                                                         </select>

                                                    @if ($errors->has('numbers_of_authors'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('numbers_of_authors') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('numbers_of_figures') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Nombre de figures") }}</label>

                                                        <select class="form-control"  title="Simple select"  name='numbers_of_figures'>
                                                                @for ($i = 0; $i <= 7; $i++)
                                                                    <option value="{{ $i }}" @if ($manuscript->numbers_of_figures == $i) selected @endif>{{ $i }}</option>
                                                                @endfor
                                                            
                                                         </select>

                                                    @if ($errors->has('numbers_of_figures'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('numbers_of_figures') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    {{-- Ending Tab for Details --}}
                            
                                    {{-- Begining Tab for Cover Letter --}}
                                    
                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        <h3>{{ __("Collez la lettre de couverture du manuscrit dans l'espace ci-dessous") }}</h3>
                                        <p class="description">Collez ou tapez votre lettre de motivation expliquant pourquoi nous devrions publier votre manuscrit. Dites-nous en quoi ce manuscrit est pertinent pour l'avancement du domaine d'intérêt et contribuera à améliorer la santé de la population en Afrique.<br>Ne vous inquiétez pas de la perte de formatage.</p>
                                        
                                        <form method="post" action="{{ route('manuscript.letter') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="form-group{{ $errors->has('cover_letter') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Collez votre lettre de couverture ici)') }}</label>

                                                    <textarea name="cover_letter" id="cover_letter" class="form-control" id="exampleFormControlTextarea1" rows="5" >{{ $manuscript->cover_letter }}</textarea>

                                                    @if ($errors->has('cover_letter'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('cover_letter') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                            <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                         </form>
                                    </div>
                            
                                     {{-- Ending Tab for Cover Letter --}}
                            
                                     {{-- Begining Tab for Authors --}}
                            
                                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <h3>{{ __("Entrez les détails des auteurs") }}</h3>
                                        <p class="description">Veuillez lire: Utilisez ce formulaire pour saisir les informations sur les auteurs contributeurs, une à la fois. Toutes les informations sont obligatoires. Les adresses électroniques seront utilisées pour informer les auteurs de l'abonnement au manuscrit et de son résultat; l'e-mail doit donc être correct. Des informations incorrectes invalideront la soumission. Il est primordial que les e-mails soient corrects. Les courriels incorrects (erreurs intentionnelles ou authentiques) seront rejetés par notre système et entraîneront le rejet de votre manuscrit.

                                        La liste actuelle des auteurs reflète uniquement l'ordre dans lequel les auteurs ont été entrés dans le système, et non la position d'auteur ou la contribution au manuscrit.
                                        Pour supprimer un auteur, cochez la case correspondante et appuyez sur le bouton "Supprimer".

                                        Les détails de l'auteur de la soumission doivent également être ajoutés.</p>
                                         
                                        <form method="post" action="{{ route('manuscript.authors') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="form-group{{ $errors->has('author_name') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Nom & Prénom de l'auteur") }}</label>
                                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" required >

                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                             
                                             <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Email  de l'auteur") }}</label>
                                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                            
                                             <div class="form-group{{ $errors->has('place_of_work') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Lieu   de travail") }}</label>
                                                            <input class="form-control{{ $errors->has('place_of_work') ? ' is-invalid' : '' }}" type="text" name="place_of_work" value="{{ old('place_of_work') }}" required>

                                                        @if ($errors->has('place_of_work'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('place_of_work') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                            
                                             <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Pays") }}</label>

                                                        <select class="form-control"  title="Simple select"  name='country'>
                                                           @foreach ($countries as $key => $country)
                                                                <option value="{{$key}}"> {{$key}}</option>
                                                            @endforeach
                                                         </select>
                                                            
                                                    @if ($errors->has('country'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('country') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                             
                                             <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                         </form>
                                        @include('manuscript.partials.authors')  
                                    </div>
                                    
                                    {{-- Ending Tab for Authors --}}
                            
                                    {{-- Begining Tab for Upload --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                        @if($manuscript->file != "")
                                            <h3>Un fichier est déjà charger pour ce manuscrit.</h3>
                                        <h5>Nom du fichier : {{ $manuscript->file }} </h5>
                                            <a href="{{ route('manuscript.download', ['manuscriptId' => $manuscript->id]) }}">
                                                <button class="btn btn-icon btn-primary" type="button">
                                                    <span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                                                    <span class="btn-inner--text">Voir le fichier</span>
                                                </button>
                                             </a>
                                        <br>
                                        <br>
                                        <h5>Si vous chargez un autre fichier, l'ancien sera supprimé.</h5>
                                        @endif
                                        
                                        
                                        
                                        <h3>Téléchargez votre fichier manuscrit</h3>
                                        <form method="post" action="{{ route('manuscript.storeFile') }}" enctype="multipart/form-data">
                                            @csrf
                                        <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                        <div class="form-group{{ $errors->has('manuscriptfile') ? ' has-danger' : '' }}">
                                            <input type="file" class="form-control-file" name="manuscriptfile" id="manuscriptfile" aria-describedby="fileHelp">
                                            <small id="fileHelp" class="form-text text-muted">Veuillez télécharger un fichier au format .doc,docx,pdf. La taille du fichier ne doit pas dépasser 5 Mo.</small>
                                           
                                             @if ($errors->has('manuscriptfile'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('manuscriptfile') }}</strong>
                                                        </span>
                                                    @endif
                                        </div>
                                        <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                    
                                        </form>
                                        
                                    </div>
                            
                                    {{-- Ending Tab for Upload --}}
                            
                                    {{-- Begining Tab for Figures --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                                       <h3>Téléchargez vos figures ici</h3>
                                         <small id="fileHelp" class="form-text text-muted">Veuillez télécharger vos figures au format .jpg,png,gif. La taille du fichier ne doit pas dépasser 2Mo.</small><br>
                                        <form method="post" action="{{ route('manuscript.figures') }}" enctype="multipart/form-data">
                                            @csrf
                                    
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="form-group{{ $errors->has('figure_name') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Nom ou description") }}</label>
                                                            <input class="form-control{{ $errors->has('figure_name') ? ' is-invalid' : '' }}" type="text" name="figure_name" value="{{ old('figure_name') }}" required >

                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('figure_name') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                        
                                       
                                        <div class="form-group{{ $errors->has('manuscriptfile') ? ' has-danger' : '' }}">
                                            <input type="file" class="form-control-file" name="figurefile" id="figurefile" aria-describedby="fileHelp">
                                           
                                           
                                             @if ($errors->has('figurefile'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('figurefile') }}</strong>
                                                        </span>
                                                    @endif
                                        </div>
                                        <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Continuer') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Annuler') }}</button>
                                                </div>
                                    
                                        </form>
                                         @include('manuscript.partials.figures') 
                                    </div>
                                     
                                    {{-- Ending Tab for Figures --}}
                            
                                    <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                                        <p class="description">Un résumé de votre manuscrit sera affiché ici lorsque vous aurez fourni toutes les informations.</p>
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
                                                
                                               
                                                    <label class="form-control-label" for="input-type">{{ __('Domaine du manuscrit') }} : 
                                                        @foreach ($subSpecialities as $key => $speciality) 
                                                                     @foreach ($speciality as $key => $value)
                                                                     {{$value}} 
                                                                    @endforeach
                                                                         
                                                            @endforeach
                                                    </label>
        
                                                
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