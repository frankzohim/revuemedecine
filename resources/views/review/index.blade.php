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
                                <h2 class="text-uppercase mb-0">Manuscrits Pour Relecture</h2>
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
                                        <th scope="col" class="sort" data-sort="name">Titre</th>
                                        <th scope="col" class="sort" data-sort="status">Status</th>
                                        <th scope="col">Auteurs</th>
                                        <th scope="col" class="sort" data-sort="completion">Achèvement</th>
                                        <th scope="col">Actions</th>
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
                                            <span class="badge badge-dot mr-4">
                                              <i class="bg-warning"></i>
                                              <span class="status">pending review</span>
                                            </span>
                                        </td>
                                        <td>
                                             <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $manuscript->numbers_of_authors }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($i%2 == 1) 
                                                <div class="d-flex align-items-center">
                                                    <span class="completion mr-2">60%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                 <div class="d-flex align-items-center">
                                                    <span class="completion mr-2">90%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('review.add', ['manuscriptId' => $manuscript->id]) }}">Add/Update Review</a>
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
                {{ $manuscripts->links() }}
            </div>
           
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush