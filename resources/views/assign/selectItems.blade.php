@extends('layouts.app')

@section('content')
     @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card  shadow">
                    <div class="card-header bg-transparent">
                        @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Succès! </strong> <strong>{{ session('message') }} </strong></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                         @endif
                        <div class="row align-items-center">
                            <div class="col">
                                
                                 @if($type =="reviewer")
                                  <h2 class="text-uppercase mb-0">Sélectionner les relecteurs</h2>
                                @else
                                <h2 class="text-uppercase mb-0">Sélectionner un éditeur</h2>
                                @endif
                    
                            </div>
                            <div class="col">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="">
                          @if($type =="reviewer")
                            <form role="form" method="POST" action="{{ route('assign.save') }}">
                                    @csrf
                                   <div class="form-group{{ $errors->has('reviewers') ? ' has-danger' : '' }}">
                                         <select name="reviewers[]"  multiple size="10">
                                    @foreach ($reviewers as $reviewer)

                                      <option value="{{ $reviewer->id }}">{{ $reviewer->title }} {{ $reviewer->name }}</option>

                                    @endforeach
                                    </select>

                                    @if ($errors->has('reviewers'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('reviewers') }}</strong>
                                        </span>
                                    @endif

                                    <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscriptId ?? "-1" }}">
                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Assigner') }}</button>
                                    </div>

                                 </div>
                            </form>
                         @else
                            <form role="form" method="POST" action="{{ route('assign.editosave') }}">
                                    @csrf
                                   <div class="form-group{{ $errors->has('editorselect') ? ' has-danger' : '' }}">
                                         <select name="editorselect"  >
                                            @foreach ($reviewers as $reviewer)

                                              <option value="{{ $reviewer->id }}">{{ $reviewer->title }} {{ $reviewer->name }}</option>

                                            @endforeach
                                        </select>

                                    @if ($errors->has('editorselect'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('editorselect') }}</strong>
                                        </span>
                                    @endif

                                    <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscriptId ?? "-1" }}">
                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Assigner') }}</button>
                                    </div>

                                 </div>
                            </form>
                         @endif
                         
                        </div>
                        
                    </div>
                    
                </div>
                {{ $reviewers->links() }}
            </div>
           
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush