@extends('layouts.app')
@section('title', __('Dashboard') )
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
                                <h2 class="text-uppercase mb-0">{{ __("My Active Manuscripts") }}</h2>
                            </div>
                            <div class="col">
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="">
                            <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="budget">№</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __("Title") }}</th>
                                        <th scope="col" class="sort" data-sort="status">Status</th>
                                        <th scope="col" class="sort" data-sort="completion">{{ __("Submission") }}</th>
                                        <th scope="col">{{ __("Actions") }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                  
                                 @php
                                    $i=0;
                                  @endphp
                                    
                                  @foreach ($manuscripts as $manuscript)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        
                                        <td>
                                             {{ $i }}
                                        </td>
                                        <td class="budget">
                                           
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $manuscript->title }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-target="#modal-status-{{ $manuscript->id }}" href="{{ route('manuscript.delete', ['manuscriptId' => $manuscript->id]) }}">
                                            <span class="badge badge-dot mr-4">
                                              <i class="bg-warning"></i>
                                              <span class="status">  
                                                  {{ $manuscript->status }} </span></span> </a>
                                            
                                        </td>
                                        <td>
                                            @switch($manuscript->achievement)
                                              @case($manuscript->achievement <= 25) 
                                                    <div class="d-flex align-items-center">
                                                        <span class="completion mr-2"> {{ $manuscript->achievement }} %</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{ $manuscript->achievement }}" aria-valuemin="0" aria-valuemax="100" style="width:  {{ $manuscript->achievement }}%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @break
                                                
                                                @case($manuscript->achievement <= 50) 
                                                    <div class="d-flex align-items-center">
                                                        <span class="completion mr-2"> {{ $manuscript->achievement }} %</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{ $manuscript->achievement }}" aria-valuemin="0" aria-valuemax="100" style="width:  {{ $manuscript->achievement }}%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @break
                                                
                                                @case($manuscript->achievement <= 75) 
                                                    <div class="d-flex align-items-center">
                                                        <span class="completion mr-2"> {{ $manuscript->achievement }} %</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{ $manuscript->achievement }}" aria-valuemin="0" aria-valuemax="100" style="width:  {{ $manuscript->achievement }}%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @break
                                    
                                                @case($manuscript->achievement <= 99) 
                                                    <div class="d-flex align-items-center">
                                                        <span class="completion mr-2"> {{ $manuscript->achievement }} %</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ $manuscript->achievement }}" aria-valuemin="0" aria-valuemax="100" style="width:  {{ $manuscript->achievement }}%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @break
                                        
                                                @case($manuscript->achievement <= 100) 
                                                    <div class="d-flex align-items-center">
                                                        <span class="completion mr-2"> {{ $manuscript->achievement }} %</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $manuscript->achievement }}" aria-valuemin="0" aria-valuemax="100" style="width:  {{ $manuscript->achievement }}%;"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @break
                                            
                                            @endswitch
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                   
                                                    @if($manuscript->status=="Soumission")
                                                    <a class="dropdown-item" href="{{ route('manuscript.edit', ['manuscriptId' => $manuscript->id]) }}">Modifier</a>
                                                    @else
                                                     <a class="dropdown-item" href="{{ route('visualize', ['manuscriptId' => $manuscript->id]) }}">Visualiser</a>
                                                     @endif
        <a class="dropdown-item" data-toggle="modal" data-target="#modal-default-{{ $manuscript->id }}" href="{{ route('manuscript.delete', ['manuscriptId' => $manuscript->id]) }}">Supprimer</a>
                                                                                             </div>
                                            </div>
                                        </td>
                                            
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                         </div>
                        </div>
                        
                    </div>
                    
                </div>
                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {!! $manuscripts->links() !!}
                </div>
            </div>
           
        </div>
         @if(auth()->user()->role_id==1 || auth()->user()->role_id==3 )
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ __('Statistics Domains') }}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">{{ __('View All') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Domains') }}</th>
                                    <th scope="col">{{ __('Submitted') }}</th>
                                    <th scope="col">{{ __('ACCEPTED') }}</th>
                                    <th scope="col">{{ __('Publication rate') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                    {{ __('Biostatistics') }}
                                    </th>
                                    <td>
                                        4,569
                                    </td>
                                    <td>
                                        2,126
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Obstetric gynecology') }} 
                                    </th>
                                    <td>
                                        3,985
                                    </td>
                                    <td>
                                        1,815
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Diagnosis & Radiology') }} 
                                    </th>
                                    <td>
                                        3,513
                                    </td>
                                    <td>
                                        1,282
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Medicine') }} 
                                    </th>
                                    <td>
                                        2,050
                                    </td>
                                    <td>
                                        1,043
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Plastic surgery') }} 
                                    </th>
                                    <td>
                                        1,795
                                    </td>
                                    <td>
                                        835
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0"> {{ __('Domains') }}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary"> {{ __('View All') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"> {{ __('Domains') }}</th>
                                    <th scope="col"> {{ __('Articles') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                    {{ __('Epidemiology') }}
                                    </th>
                                    <td>
                                        1,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Medicine') }}
                                    </th>
                                    <td>
                                        5,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">70%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Pediatrics') }}
                                    </th>
                                    <td>
                                        4,807
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Neurology') }}
                                    </th>
                                    <td>
                                        3,678
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">75%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                    {{ __('Surgery') }}
                                    </th>
                                    <td>
                                        2,645
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">30%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @include('layouts.footers.auth')
    </div>
@foreach ($manuscripts as $manuscript)
    <div class="modal fade" id="modal-default-{{ $manuscript->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
        	
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Confirmez la suppression</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
            	
                <p>Voulez vous vraiment supprimer ce manuscrit?</p>
                
            </div>
            
            <div class="modal-footer">
                <a href="{{ route('manuscript.delete', ['manuscriptId' => $manuscript->id]) }}">
                    <button type="button" class="btn btn-primary">Oui</button>
                </a>
                
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Fermer</button>
            </div>
            
        </div>
    </div>
</div>
 @endforeach
@foreach ($manuscripts as $manuscript)
<div class="modal fade" id="modal-status-{{ $manuscript->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
        	
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Changement de status</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
             <form method="post" action="{{ route('manuscript.statusUpdate') }}" autocomplete="off">
            <div class="modal-body">
           
                @csrf
                 <input type="hidden" id="manuscriptId" name="manuscriptId" value="{{ $manuscript->id }}">
                 <select class="form-control"  title="Choisir un status"  name='status'>
                        <option value="Sousmission" selected>{{ __('Soumission') }}</option>
                        <option value="En cours de traitement">{{ __('En cours de traitement') }}</option>
                     <option value="En Relecture">{{ __('En Relecture') }}</option>
                     <option value="En attente de l'auteur">{{ __("En attente de l'auteur") }}</option>
                     <option value="En deuxième relecture">{{ __('En deuxième relecture') }}</option>
                     <option value="Accepté">{{ __('Accepté') }}</option>
                     <option value="Rejeté">{{ __('Rejeté') }}</option>
                     <option value="En cours de publication">{{ __('En cours de publication') }}</option>
                     <option value="Publiée">{{ __('Publiée') }}</option>
                </select>
                <div class="text-center">
                                                    
                                                    
                                                </div>
                 
            </div>
           
            <div class="modal-footer">
                <a href="#">
                    <button type="submit" class="btn btn-primary">Changer</button>
                </a>
                
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Annuler</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush