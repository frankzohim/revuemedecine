
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                 <h2 class="text-uppercase mb-0">{{ __("Figures Added") }}</h2>
                 <div class="">
                            <div class="table-responsive">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="budget">№</th>
                                        <th scope="col" class="sort" data-sort="name">{{ __("Name") }}</th>
                                        <th scope="col" class="sort" data-sort="status">{{ __("File") }}</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                  
                                 @php
                                    $i=0;
                                  @endphp
                                    
                                  @foreach ($manuscriptsFigures as $figures)
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
                                                    <span class="name mb-0 text-sm">{{ $figures->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="name mb-0 text-sm">{{ $figures->file }}</span>
                                                </div>
                                            </div>
                                        </td>
                                      
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                    <a class="dropdown-item" href="{{ route('manuscript.supprimer', ['id' => $figures->id]) }}">Supprimer</a>
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
    </div>