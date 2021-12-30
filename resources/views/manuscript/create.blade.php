@extends('layouts.app', ['title' => __('User Profile')])
@section('title',  __('Add an article')  )

@section('content')
    @include('manuscript.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __("Welcome to the creation page of your manuscript. This form consists of many steps. Start with the 'Details' section then click on 'save & continue' to complete the other sections. You can come back at any time to complete your manuscript!"),
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
             elt.selected = "true";

             // add opt to end of select box (specialities)
             specialities.appendChild(elt); 
              //document.getElementById("domain-selected").value = document.getElementById("domain-selected").value + "\n" +opt.value;
              //alert(opt.value);
            }
          }
            
          return opts;
        }
          
        function myFunctionDelete() {
          var x = document.getElementById("speciality-selected");
          x.remove(x.selectedIndex);
        }
        
        function mySelectAll() {
    
           var specialities = document.getElementById('speciality-selected');
           var len = specialities.options.length;
           for (var i = 0; i < len; i++) {
                opt = specialities.options[i];
                opt.selected = "true";
            }
        }
          
   </script>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h1 class="col-12 mb-0">{{ __("Submit an article") }} </h1>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-book-bookmark mr-2"></i>{{ __("Details") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-single-copy-04 mr-2"></i>{{ __("Cover letter") }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-single-02 mr-2"></i>{{ __("Authors") }}</a>
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
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>{{ __("File") }}</a>
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
                                        <p class="description">{{ __("The form below is used to collect basic information about the manuscript you are about to submit. Please check the information provided very carefully. You can go back and update this information later by logging into the site.") }} <br>
                                        {{ __("All fields are mandatory.") }}</p>
                                        <form method="post" action="{{ route('manuscript.save') }}" autocomplete="off">
                                            @csrf
                                            <div class="pl-lg-4">
                                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript type') }}</label>

                                                        <select class="form-control"  title="Simple select"  name='type'>
                                                            <option value="Brève">{{ __('Brief') }}</option>
                                                            <option value="Etude de cas">{{ __('Case study') }}</option>
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
                                                            <option value="Français" selected>{{ __('French') }}</option>
                                                            <option value="Anglais">{{ __('English') }}</option>
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
                                                                <option value="{{$country}}"> {{$key}}</option>
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
                                                          <div class="form-group{{ $errors->has('specialityselected') ? ' has-danger' : '' }}">
                                                            <label class="form-control-label" for="input-type">{{ __('Selected domains (4 maximum)') }}</label>
                                                            
                                                            <select class="form-control"  title="Simple select"  name='specialityselected[]' id='speciality-selected'   multiple size="5">
                                                                    
                                                                 </select>
                                                            @if ($errors->has('specialityselected'))
                                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                                    <strong>{{ $errors->first('specialityselected') }}</strong>
                                                                </span>
                                                            @endif
                                                          </div>
                                                          <button onclick="myFunctionDelete()">Delete</button>
                                                          <button onclick="mySelectAll()">Select All</button>
                                                    </div>
                                                </div>
                                                 <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript Title') }}</label>

                                                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('title') }}"></textarea>

                                                    @if ($errors->has('title'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                  <div class="form-group{{ $errors->has('abstract') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Manuscript Abstract (250 Words Max)' )}}</label>

                                                    <textarea name="abstract" class="form-control" id="exampleFormControlTextarea1" rows="5" value="{{ old('abstract') }}"></textarea>

                                                    @if ($errors->has('abstract'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('abstract') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                                
                                                 <div class="form-group{{ $errors->has('keywords') ? ' has-danger' : '' }}">
                                                    
                                                    <label class="form-control-label" for="input-type">{{ __('Keywords - Enter 4 to 6 keywords for your manuscript (keywords must be separated by commas)') }}</label>
                                                        <input class="form-control{{ $errors->has('keywords') ? ' is-invalid' : '' }}" type="text" name="keywords" value="{{ old('keywords') }}" required >
                                                    
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
                                                                    <option value="{{ $i }}">{{ $i }}</option>
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
                                                                    <option value="{{ $i }}">{{ $i }}</option>
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
                                        
                                        <form method="post" action="{{ route('manuscript.save') }}" autocomplete="off">
                                            @csrf
                                            
                                            <div class="form-group{{ $errors->has('abstract') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __('Paste your cover letter here') }}</label>

                                                    <textarea name="abstract" class="form-control" id="exampleFormControlTextarea1" rows="5" disabled></textarea>

                                                    @if ($errors->has('abstract'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('abstract') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                            <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4" disabled>{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4" disabled>{{ __('Cancel') }}</button>
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
                                            <div class="form-group{{ $errors->has('author_name') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Author's first & last name") }}</label>
                                                            <input class="form-control{{ $errors->has('author_name') ? ' is-invalid' : '' }}" type="text" name="author_name" value="{{ old('author_name') }}" required disabled>

                                                        @if ($errors->has('author_name'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('author_name') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                             
                                             <div class="form-group{{ $errors->has('author_email') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Email of the author") }}</label>
                                                            <input class="form-control{{ $errors->has('author_email') ? ' is-invalid' : '' }}" type="text" name="author_email" value="{{ old('author_email') }}" required disabled>

                                                        @if ($errors->has('author_email'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('author_email') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                            
                                             <div class="form-group{{ $errors->has('author_place_of_work') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Workplace") }}</label>
                                                            <input class="form-control{{ $errors->has('author_place_of_work') ? ' is-invalid' : '' }}" type="text" name="author_email" value="{{ old('author_place_of_work') }}" required disabled>

                                                        @if ($errors->has('author_place_of_work'))
                                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('author_place_of_work') }}</strong>
                                                            </span>
                                                        @endif
                                             </div>
                                            
                                             <div class="form-group{{ $errors->has('author_country') ? ' has-danger' : '' }}">
                                                    <label class="form-control-label" for="input-type">{{ __("Country") }}</label>

                                                        <select class="form-control"  title="Simple select"  name='author_country'>
                                                           @foreach ($countries as $key => $country)
                                                                <option value="{{$country}}"> {{$key}}</option>
                                                            @endforeach
                                                         </select>
                                                            
                                                    @if ($errors->has('author_country'))
                                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                            <strong>{{ $errors->first('author_country') }}</strong>
                                                        </span>
                                                    @endif
                                                 </div>
                                             
                                             <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4" disabled>{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4" disabled>{{ __('Cancel') }}</button>
                                                </div>
                                         </form>
                                    </div>
                                    
                                    {{-- Ending Tab for Authors --}}
                            
                                    {{-- Begining Tab for Upload --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                                        <h3>{{ __('Download your manuscript file') }}</h3>
                                        <form method="post" action="{{ route('manuscript.save') }}" autocomplete="off">
                                            @csrf
                                        </form>
                                        <p class="description"></p>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFileLang" lang="fr" disabled>
                                            <label class="custom-file-label" for="customFileLang">{{ __('Choose a file') }}</label>
                                        </div>
                                        <div class="text-center">
                                                    <button type="submit" class="btn btn-success mt-4" disabled>{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4" disabled>{{ __('Cancel') }}</button>
                                                </div>
                                    </div>
                            
                                    {{-- Ending Tab for Upload --}}
                                    
                                     {{-- Begining Tab for Figures --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                                        <h3>{{ __('Download your figures here') }}</h3>
                                         <small id="fileHelp" class="form-text text-muted">
										 {{ __('Please upload your figures in .jpg,png,gif format. The file size should not exceed 2 MB.') }}</small><br>
                                        <form method="post" action="{{ route('manuscript.figures') }}" enctype="multipart/form-data">
                                            @csrf
                                    
                                            <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id ?? "-1" }}" disabled>
                                            <div class="form-group{{ $errors->has('figure_name') ? ' has-danger' : '' }}">

                                                        <label class="form-control-label" for="input-type">{{ __("Name or description") }}</label>
                                                            <input class="form-control{{ $errors->has('figure_name') ? ' is-invalid' : '' }}" type="text" name="figure_name" value="{{ old('figure_name') }}" required disabled >

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
                                                    <button type="submit" class="btn btn-success mt-4" disabled>{{ __('Save & Continue') }}</button>
                                                    <button class="btn btn-warning mt-4" disabled>{{ __('Cancel') }}</button>
                                                </div>
                                    
                                        </form>
                                         
                                    </div>
                                    {{-- Ending Tab for Figures --}}
                            
                                     {{-- Begining Tab for Images --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-7" role="tabpanel" aria-labelledby="tabs-icons-text-7-tab">
                                        <p class="description"></p>
                                    </div>
                                    {{-- Ending Tab for Images --}}
                            
                                     {{-- Begining Tab for Arrays --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-8" role="tabpanel" aria-labelledby="tabs-icons-text-8-tab">
                                        <p class="description"></p>
                                    </div>
                                    {{-- Ending Tab for Arrays --}}
                            
                                    {{-- Begining Tab for Summary --}}
                                    <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                                        <p class="description">{{ __("A summary of your manuscript will be posted here when you have provided all the information.") }}</p>
                                    </div>
                                    {{-- Ending Tab for Summary --}}
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