@extends('layouts.app', ['title' => __("Edition d'un article")])
@section('title',  __('Edit an article')  )
@section('content')
    @include('manuscript.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __("Welcome to the edit page of your manuscript. This form consists of 4 steps Start with the Details section then click on continue to complete the other sections. You can come back at any time to complete your manuscript!"),
        'class' => 'col-lg-7'
    ])   
    <script>
        function myFunction(sel) {
           var opts = [],
               opt;
          // get reference to select element
          var specialities = document.getElementById('speciality-selected');
          var len = sel.options.length;
          for (var i = 0; i < len; i++) {
            opt = sel.options[i];

            if (opt.selected) {
              opts.push(opt);
              
              // create new option element
              var elt = document.createElement('option');

              // create text node to add to option element (elt)
              elt.appendChild( document.createTextNode(opt.text) );

             // set value property of opt
             elt.value = opt.value; 

             // add opt to end of select box (specialities)
             specialities.appendChild(elt); 
              //document.getElementById("domain-selected").value = document.getElementById("domain-selected").value + "\n" +opt.value;
              //alert(opt.value);
            }
          }
            
          return opts;
        }
   </script>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h1 class="col-12 mb-0">{{ __("Submission of an article") }} ({{("$manuscript->achievement")}}%)</h1>
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
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-book-bookmark mr-2"></i>{{ __("Details") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-single-copy-04 mr-2"></i>{{ __("Cover letter") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-single-02 mr-2"></i>
                                        {{ __("Authors") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false"><i class="ni ni-image mr-2"></i>Figures</a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-7-tab" data-toggle="tab" href="#tabs-icons-text-7" role="tab" aria-controls="tabs-icons-text-7" aria-selected="false"><i class="ni ni-image mr-2"></i>{{ __("Images") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-8-tab" data-toggle="tab" href="#tabs-icons-text-8" role="tab" aria-controls="tabs-icons-text-8" aria-selected="false"><i class="ni ni-map-big mr-2"></i>{{ __("Arrays") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>  {{ __("File") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>{{ __("Summary") }}</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                
                                <div class="tab-content" id="myTabContent">
                                    
                                     {{-- Begining Tab for Details --}}
                                    
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <h3>{{ __("Enter your manuscript's data") }}</h3>
                                        <p class="description">{{ __("The form below is used to collect basic information about the manuscript you are about to submit. Please check the information provided very carefully. You can go back and update this information later by logging into the site.") }}<br>
                                        {{ __("All fields are mandatory.") }}</p>
                                        <form method="post" action="{{ route('manuscript.update') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="pl-lg-4">
                                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript type') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='type'>
                                                            <option value="Brève" @if ($manuscript->type ==="Brève") selected @endif>{{ __('Brief') }}</option>
                                                            <option value="Etude de cas" @if ($manuscript->type ==="Etude de cas") selected @endif>{{ __('Case study') }}</option>
                                                         </select>

                                                    @if ($errors->has('type'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('type') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript language') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='language'>
                                                            <option value="Français" 
                                                                    @if ($manuscript->language ==="Français") selected @endif  >{{ __('French') }}</option>
                                                            <option value="Anglais" @if ($manuscript->language ==="Anglais") selected @endif >{{ __('English') }}</option>
                                                         </select>

                                                    @if ($errors->has('language'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('language') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Manuscript's country of origin") }}</label>

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
                                                
                                               
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group{{ $errors->has('speciality') ? ' has-danger' : '' }}">
                                                            <label class="form-control-label" for="input-type">{{ __('Domain of the manuscript') }}</label>


                                                                 <select class="form-control"  title="Simple select"  name='speciality[]' id='specialityDomain' onchange="myFunction(this)"  size="5">
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
                                                    </div>
                                                    <div class="col-md-6">
                                                          <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                            <label class="form-control-label" for="input-type">{{ __('Selected domains (4 maximum)') }}</label>
                                                            
                                                            <select class="form-control"  title="Simple select"  name='specialityselected[]' id='speciality-selected'   multiple size="5">
                                                                    
                                                                 </select>
                                                            @if ($errors->has('title'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('title') }}</strong>
                                                                </span>
                                                            @endif
                                                          </div>
														  <button onclick="myFunctionDelete()">{{ __('Delete') }}</button>
                                                          <button onclick="mySelectAll()">{{ __('Select All') }}</button>
                                                    </div>
                                                </div>
                                                
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript Title') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ $manuscript->title }}">{{ $manuscript->title }}</textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                  <div class="form-group{{ $errors->has('abstract') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript Abstract (250 Words Max)' )}}</label>

                                                    <textarea name="abstract" class="form-control" id="exampleFormControlTextarea1" rows="5" value="{{ $manuscript->abstract }}">{{ $manuscript->abstract }}</textarea>

                                                    @if ($errors->has('abstract'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('abstract') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('keywords') ? ' has-danger' : '' }}">
                                                    
                                                    <label class="form-control-label" for="input-type">{{ __('Keywords - Enter 4 to 6 keywords for your manuscript (keywords must be separated by commas)') }}</label>
                                                        <input class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}" type="text" name="keywords" value="{{ $manuscript->keywords }}" required>
                                                    
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('keywords') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                 <div class="form-group{{ $errors->has('numbers_of_authors') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Number of authors") }}</label>

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
                                                    <label class="form-control-label" for="input-type">{{ __("Number of figures") }}</label>

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
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Cancel') }}</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    {{-- Ending Tab for Details --}}
                            
                                    {{-- Begining Tab for Cover Letter --}}
                                    
                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        <h3>{{ __("Paste the manuscript cover letter in the space below") }}</h3>
                                        <p class="description">{{ __("Paste or type your cover letter explaining why we should publish your manuscript. Tell us how this manuscript is relevant to the advancement of the area of interest and will help improve the health of the people in Africa.") }}<br>
                                        {{ __("Don't worry about the loss of formatting.") }}</p>
                                        
                                        <form method="post" action="{{ route('manuscript.letter') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="form-group{{ $errors->has('cover_letter') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Paste your cover letter here') }}</label>

                                                    <textarea name="cover_letter" id="cover_letter" class="form-control" id="exampleFormControlTextarea1" rows="5" >{{ $manuscript->cover_letter }}</textarea>

                                                    @if ($errors->has('cover_letter'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('cover_letter') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                            <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Cancel') }}</button>
                                                </div>
                                         </form>
                                    </div>
                            
                                     {{-- Ending Tab for Cover Letter --}}
                            
                                     {{-- Begining Tab for Authors --}}
                            
                                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <h3>{{ __("Enter author details") }}</h3>
                                       <p class="description">{{ __("Please read: Use this form to enter information on contributing authors, one at a time. All information is mandatory. E-mail addresses will be used to inform authors of the subscription to the manuscript and its outcome, so the e-mail must be correct. Incorrect information will invalidate the submission. It is essential that the e-mails are correct. Incorrect e-mails (intentional or genuine errors) will be rejected by our system and will result in the rejection of your manuscript. The current list of authors reflects only the order in which the authors were entered into the system, not the author's position or contribution to the manuscript. To remove an author, check the corresponding box and press the 'Delete' button. Details of the author of the submission must also be added.") }}</p>
                                         
                                        <form method="post" action="{{ route('manuscript.authors') }}" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="form-group{{ $errors->has('author_name') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Author's first & last name") }}</label>
                                                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" required >

                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                             
                                             <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Email of the author") }}</label>
                                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                            
                                            
                                            <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Country") }}</label>

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
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">

                                                        <select class="form-control"  title="Simple select"  name='placeofwork_select1'>
                                                          <option value="Département">{{ __("Department") }}</option>
                                                          <option value="Service">Service</option>
                                                         </select>
                                                         
                                                 
                                                    @if ($errors->has('placeofwork_select1'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('placeofwork_select1') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                   <input class="form-control{{ $errors->has('place_of_work') ? ' is-invalid' : '' }}" type="text" name="place_of_work" value="{{ old('place_of_work') }}" required>
                                                    
                                                     @if ($errors->has('place_of_work'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('place_of_work') }}</strong>
                                                            </span>
                                                        @endif
                                                  </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">

                                                        <select class="form-control"  title="Simple select"  name='placeofwork_select2'>
                                                          <option value="Faculté">{{ __("Faculty") }}</option>
                                                          <option value="Laboratoire">{{ __("Laboratory") }}</option>
                                                         </select>
                                                         
                                                 
                                                    @if ($errors->has('placeofwork_select2'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('placeofwork_select2') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                   <input class="form-control{{ $errors->has('place_of_work2') ? ' is-invalid' : '' }}" type="text" name="place_of_work2" value="{{ old('place_of_work2') }}" required>
                                                      
                                                     @if ($errors->has('place_of_work2'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('place_of_work2') }}</strong>
                                                            </span>
                                                        @endif
                                                  </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                   <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">

                                                        <select class="form-control"  title="Simple select"  name='placeofwork_select3'>
                                                          <option value="Hôpital">{{ __("Hospital") }}</option>
                                                          <option value="Université">{{ __("University") }}</option>
                                                         </select>
                                                         
                                                 
                                                    @if ($errors->has('placeofwork_select3'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('placeofwork_select3') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                   <input class="form-control{{ $errors->has('place_of_work3') ? ' is-invalid' : '' }}" type="text" name="place_of_work3" value="{{ old('place_of_work3') }}" required>
                                                      
                                                     @if ($errors->has('place_of_work3'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('place_of_work3') }}</strong>
                                                            </span>
                                                        @endif
                                                  </div>
                                                </div>
                                            </div>
                                            
                                             
                                             <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Cancel') }}</button>
                                             </div>
                                         </form>
                                        @include('manuscript.partials.authors') 
                                        <div class="nav-item">
                                            <a class="nav-link active" href="#auteur-correspondant" data-toggle="collapse" role="button"  aria-expanded="false" aria-controls="auteur-correspondant">
                                                <h2 class="text-uppercase mb-0">{{ __('Corresponding Author') }}</h2>
                                            </a>

                                            <div class="collapse" id="auteur-correspondant">
                                             <form method="post" action="{{ route('manuscript.corresponding_author') }}" autocomplete="off">
                                                @csrf
                                                <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                                <div class="form-group{{ $errors->has('author_name') ? ' has-danger' : '' }}">

                                                            <label class="form-control-label" for="input-type">{{ __("Author's first & last name") }}</label>
                                                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" required >

                                                            @if ($errors->has('name'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                 </div>

                                                 <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">

                                                            <label class="form-control-label" for="input-type">{{ __("Email of the author") }}</label>
                                                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required>

                                                            @if ($errors->has('email'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                 </div>
                                                  
                                                 <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">

                                                            <label class="form-control-label" for="input-type">{{ __("Author's phone") }}</label>
                                                                <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" type="tel" name="phone" value="{{ old('phone') }}" required>

                                                            @if ($errors->has('phone'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                                </span>
                                                            @endif
                                                 </div>

                                                  <div class="form-group{{ $errors->has('postal_address') ? ' has-danger' : '' }}">

                                                            <label class="form-control-label" for="input-type">{{ __("Postal Address") }}</label>
                                                                <input class="form-control{{ $errors->has('postal_address') ? ' is-invalid' : '' }}" type="text" name="postal_address" value="{{ old('postal_address') }}" required>

                                                            @if ($errors->has('postal_address'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('postal_address') }}</strong>
                                                                </span>
                                                            @endif
                                                 </div>


                                                <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                        <label class="form-control-label" for="input-type">{{ __("Country") }}</label>

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

                                                <div class="row">
                                                    <div class="col-md-6">
                                                       <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">

                                                            <select class="form-control"  title="Simple select"  name='placeofwork_select1'>
                                                              <option value="Département">{{ __("Department") }}</option>
                                                              <option value="Service">Service</option>
                                                             </select>


                                                        @if ($errors->has('placeofwork_select1'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('placeofwork_select1') }}</strong>
                                                            </span>
                                                        @endif
                                                     </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                       <input class="form-control{{ $errors->has('place_of_work') ? ' is-invalid' : '' }}" type="text" name="place_of_work" value="{{ old('place_of_work') }}" required>

                                                         @if ($errors->has('place_of_work'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('place_of_work') }}</strong>
                                                                </span>
                                                            @endif
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                       <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">

                                                            <select class="form-control"  title="Simple select"  name='placeofwork_select2'>
                                                              <option value="Faculté">{{ __("Faculty") }}</option>
                                                              <option value="Laboratoire">{{ __("Laboratory") }}</option>
                                                             </select>


                                                        @if ($errors->has('placeofwork_select2'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('placeofwork_select2') }}</strong>
                                                            </span>
                                                        @endif
                                                     </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                       <input class="form-control{{ $errors->has('place_of_work2') ? ' is-invalid' : '' }}" type="text" name="place_of_work2" value="{{ old('place_of_work2') }}" required>

                                                         @if ($errors->has('place_of_work2'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('place_of_work2') }}</strong>
                                                                </span>
                                                            @endif
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                       <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">

                                                            <select class="form-control"  title="Simple select"  name='placeofwork_select3'>
                                                              <option value="Hôpital">{{ __("Hospital") }}</option>
                                                              <option value="Université">{{ __("University") }}</option>
                                                             </select>


                                                        @if ($errors->has('placeofwork_select3'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('placeofwork_select3') }}</strong>
                                                            </span>
                                                        @endif
                                                     </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                       <input class="form-control{{ $errors->has('place_of_work3') ? ' is-invalid' : '' }}" type="text" name="place_of_work3" value="{{ old('place_of_work3') }}" required>

                                                         @if ($errors->has('place_of_work3'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('place_of_work3') }}</strong>
                                                                </span>
                                                            @endif
                                                      </div>
                                                    </div>
                                                </div>


                                                 <div class="text-center">
                                                        <button type="submit" class="btn btn-success mt-4">{{ __('Save & Continue') }}</button>
                                                        <button class="btn btn-warning mt-4">{{ __('Cancel') }}</button>
                                                 </div>
                                         </form>
                                        @include('manuscript.partials.corresponding-author')
                                            </div>
                                        </div>
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
                                        
                                        
                                        
                                        <h3>{{ __('Upload your manuscript file') }}</h3>
                                        <form method="post" action="{{ route('manuscript.storeFile') }}" enctype="multipart/form-data">
                                            @csrf
                                        <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                        <div class="form-group{{ $errors->has('manuscriptfile') ? ' has-danger' : '' }}">
                                            <input type="file" class="form-control-file" name="manuscriptfile" id="manuscriptfile" aria-describedby="fileHelp">
                                            <small id="fileHelp" class="form-text text-muted">{{ __('Please upload a file in .doc, docx, pdf format.') }}</small>
                                           
                                             @if ($errors->has('manuscriptfile'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('manuscriptfile') }}</strong>
                                                        </span>
                                                    @endif
                                        </div>
                                        <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Cancel') }}</button>
                                                </div>
                                    
                                        </form>
                                        
                                    </div>
                            
                                    {{-- Ending Tab for Upload --}}
                            
                                    {{-- Begining Tab for Figures --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                                       <h3>{{ __('Download your figures here') }}</h3>
                                         <small id="fileHelp" class="form-text text-muted">{{ __('Please upload your figures in .jpg,png,gif format. The file size should not exceed 2 MB.') }}</small><br>
                                        <form method="post" action="{{ route('manuscript.figures') }}" enctype="multipart/form-data">
                                            @csrf
                                    
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="form-group{{ $errors->has('figure_name') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Name or description") }}</label>
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
                                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4">{{ __('Cancel') }}</button>
                                                </div>
                                    
                                        </form>
                                         @include('manuscript.partials.figures') 
                                    </div>
                                     
                                    {{-- Ending Tab for Figures --}}
                            
                                    <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                                        <p class="description">{{ __('A summary of your manuscript will be posted here when you have provided all the information.') }}</p>
                                        <form method="post" action="" autocomplete="off">
                                            @csrf
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                            <div class="pl-lg-4">
                                                
                                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript Title') }} : <br>
                                                     {{ $manuscript->title }}</label>
                                                 </div>
                                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript type') }} : 
                                                        {{ $manuscript->type }}</label>
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('language') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript language') }} : 
                                                        {{ $manuscript->language }} </label>
                                                 </div>
                                                 
                                                 <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Manuscript's country of origin") }}: @foreach ($countries as $key => $country)
                                                                @if ($manuscript->country_id == $country) 
                                                                    {{$key}}
                                                                @endif
                                                    @endforeach
                                                 </div>
                                                
                                               
                                                    <label class="form-control-label" for="input-type">{{ __('Domain of the manuscript') }} : 
                                                        @foreach ($subSpecialities as $key => $speciality) 
                                                                     @foreach ($speciality as $key => $value)
                                                                     {{$value}} 
                                                                    @endforeach
                                                                         
                                                            @endforeach
                                                    </label>
        
                                                
                                                  <div class="form-group{{ $errors->has('abstract') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript Abstract') }} : <br>
                                                        {{ $manuscript->abstract }}</label>
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('keywords') ? ' has-danger' : '' }}">
                                                    
                                                    <label class="form-control-label" for="input-type">{{ __('Keywords') }} : {{ $manuscript->keywords }}</label>
                                                </div>
                                                
                                                 <div class="form-group{{ $errors->has('numbers_of_authors') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Number of authors") }} : 
                                                        {{ $manuscript->numbers_of_authors }}</label>
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('numbers_of_figures') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Number of figures") }}: 
                                                        {{ $manuscript->numbers_of_figures }}</label>
                                                </div>
                                                <div class="form-group{{ $errors->has('cover_letter') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Cover letter') }} <br> {{ $manuscript->cover_letter }}</label>
                                                 </div>
                                                 @if($manuscript->file != "")
                                           
                                                    <a href="{{ route('manuscript.download', ['manuscriptId' => $manuscript->id]) }}">
                                                        <button class="btn btn-icon btn-primary" type="button">
                                                            <span class="btn-inner--icon"><i class="ni ni-cloud-download-95"></i></span>
                                                            <span class="btn-inner--text">{{ __('Download file') }}</span>
                                                        </button>
                                                     </a>
                                                @endif
                                            </div>
                                        </form>
                                        <div class="progress-wrapper">
                                              <div class="progress-info">
                                                <div class="progress-label">
                                                  <span>{{ __('Progression') }}</span>
                                                </div>
                                                <div class="progress-percentage">
                                                  <span>{{ $manuscript->achievement}}%</span>
                                                </div>
                                              </div>
                                              <div class="progress">
                                                @switch($manuscript->achievement)
                                                        @case($manuscript->achievement <= 25)
                                                             <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{ $manuscript->achievement }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $manuscript->achievement }}%;"></div>
                                                        @break

                                                        @case($manuscript->achievement <= 50)
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="manuscript->achievement" aria-valuemin="0" aria-valuemax="100" style="width:{{ $manuscript->achievement }}%;"></div>
                                                            @break
                                                        @case($manuscript->achievement <= 75)
                                                           <div class="progress-bar bg-info" role="progressbar" aria-valuenow="manuscript->achievement" aria-valuemin="0" aria-valuemax="100" style="width:{{ $manuscript->achievement }}%;"></div>
                                                            @break
                                                        @case($manuscript->achievement <= 99)
                                                           <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="manuscript->achievement" aria-valuemin="0" aria-valuemax="100" style="width:{{ $manuscript->achievement }}%;"></div>
                                                            @break
                                                        @case($manuscript->achievement <= 100)
                                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="manuscript->achievement" aria-valuemin="0" aria-valuemax="100" style="width:{{ $manuscript->achievement }}%;"></div>
                                                            @break
                                                    @endswitch
                                               
                                              </div>
                                        </div>
                                        
                                      <form method="post" action="{{ route('manuscript.submission') }}" autocomplete="off">
                                            @csrf
                                        <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}">
                                                 
                                                 
                                                 <div class="text-center">
                                                    <button type="submit" @if ($manuscript->achievement < 99) disabled @endif  class="btn btn-success mt-4">{{ __("Validate and submit the document") }}</button>
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