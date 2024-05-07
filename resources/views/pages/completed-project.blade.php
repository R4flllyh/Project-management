@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Project Pages'])
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <h5 class="mb-0">🏆 Completed Project</h5>
                                <p class="mb-0 ps-2 pt-1">Showing <span class="text-primary">{{ $completedProjectsCount }}</span> projects</p>
                            </div>
                            <div class="col-4 d-flex justify-content-end align-items-center gap-2">
                                <form action="{{ route('completed-projects') }}" method="GET">
                                    <select class="form-control" name="month" onchange="this.form.submit()">
                                        <option value="">Select Month</option>
                                        @foreach(range(1, 12) as $month)
                                            <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 10)) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <a href="#" class="btn bg-gradient-dark px-3 mb-0">
                                    <i class="fi fi-rr-bars-filter text-xl me-2 align-middle mb-0"></i><span>Filter</span>
                                </a>
                                {{-- <h6 class="mb-0 me-3 align-middle py-2"><i class="fi fi-rr-calendar-lines text-xl me-2 align-middle mb-0"></i> {{ $formattedDateTime }}</h6> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-4 mb-lg-0 mb-4">
                <div class="row">
                    @forelse ($completedProjects as $project)
                    <div class="col-4">
                        <div class="card mb-3">
                            @if ($project -> project_image)
                                <img src="{{ asset('storage/' . $project -> project_image) }}" class="card-img-top">
                            @endif
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <h6 class="text-center px-3 rounded priority-low">{{$project -> priority}}</h6>
                                    <h6 class="text-center px-3 rounded priority-medium">{{$project -> project_type}}</h6>
                                    <h6 class="text-center px-3 rounded priority-important">{{$project -> status}}</h6>
                                </div>
                                <h5 class="card-title">{{\Illuminate\Support\str::limit($project -> project_name, $limit = 30, $end = '...')}}</h5>
                                <p class="card-text">{{\Illuminate\Support\str::limit($project -> project_description, $limit = 50, $end = '...')}}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center pt-2">
                                <small class="text-body-secondary"><i class="fi fi-rr-clock-five py-0 me-2"></i> Updated {{ $project -> updated_at -> diffForHumans() }}</small>
                                <div class="d-flex gap-2 align-items-center">
                                    <img src="{{ asset('storage/' . $project->assignee->user_image) }}" alt="..." class="avatar shadow rounded-circle avatar-sm">
                                    <a type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" href="{{route('project-detail', $project -> id)}}" data-bs-target="#staticBackdrop{{$loop->iteration}}">
                                            Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="staticBackdrop{{$loop->iteration}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content px-3">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="d-flex col-8 mb-3 gap-2 px-2">
                                        <h6 class="text-center px-3 mt-4 rounded priority-important">{{$project -> project_type}}</h6>
                                        <h6 class="text-center px-3 mt-4 rounded priority-low">{{$project -> status}}</h6>
                                        <h6 class="text-center px-3 mt-4 rounded priority-medium">Created on {{$project -> created_at -> format('d M Y')}}</h6>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-end">
                                        <div class="dropdown d-flex mt-4">
                                            <button class="btn d-flex align-items-center p-0 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="material-symbols-outlined text-primary opacity-10">
                                                    more_vert
                                                </i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form action="{{Route('project-destroy', $project -> id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item" href="#">
                                                            <i class="fi fi-rr-trash me-2"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="fs-3 px-2">{{$project -> project_name}}</h2>
                                <p class="px-2">{{$project -> project_description}}</p>
                                @if ($project -> project_image)
                                    <img src="{{ asset('storage/' . $project -> project_image) }}" class="card-img px-2">
                                @endif
                                <div class="col px-2">
                                    <hr>
                                    <div class="row">
                                        <h4 class="fw-3">Details</h4>
                                        <div class="card my-2">
                                            <div class="table-responsive">
                                              <table class="table align-items-center mb-0">
                                                <tbody>
                                                  <tr>
                                                    <td>
                                                      <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <i class="fi fi-rr-calendar-clock text-info text-lg opacity-10 me-3 mt-3"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                          <h6 class="mb-0">Due Date</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-end pe-1">
                                                            <p class="font-weight-bold text-sm text-center py-2 rounded priority-medium mb-0" style="width: 40%; color: #f18d4b;">{{\Carbon\Carbon::parse($project->timeline)->format('d M Y') }}</p>
                                                        </div>
                                                    </td>
                                                  </tr>

                                                  <tr>
                                                    <td>
                                                      <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <i class="fi fi-rr-briefcase text-danger text-lg opacity-10 me-3"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                          <h6 class="mb-0">Priority</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end pe-1">
                                                            <p class="font-weight-bold text-sm text-center py-2 rounded priority-low mb-0" style="width: 40%; color: rgb(40, 139, 252);">{{$project -> priority}}</p>
                                                        </div>
                                                    </td>
                                                  </tr>

                                                  <tr>
                                                    <td>
                                                      <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <i class="ni ni-world-2 text-success text-lg opacity-10 me-3 mt-2"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                          <h6 class="mb-0">Links</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end pe-1">
                                                            <a href="{{$project -> link}}" class="btn-link font-weight-bold text-sm text-center py-2 rounded priority-important mb-0" style="width: 40%;">
                                                                Open Links
                                                            </a>
                                                        </div>
                                                    </td>
                                                  </tr>

                                                  <tr>
                                                    <td>
                                                      <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <i class="fi fi-rr-building text-primary text-lg opacity-10 me-3 mt-1"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                          <h6 class="mb-0">Assets</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end pe-1">
                                                            <a href="{{$project -> assets}}" class="text-primary font-weight-bold text-sm text-center py-2 rounded priority-warning mb-0" style="width: 40%;">
                                                                Open Assets
                                                            </a>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>
                                                      <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <i class="fi fi-rr-user-pen text-warning text-lg opacity-10 me-3 mt-1"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                          <h6 class="mb-0">Assignee</h6>
                                                        </div>
                                                      </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-end pe-1">
                                                            <div class="font-weight-bold text-sm text-center py-2 rounded priority-warning mb-0" style="width: 40%; color: rgb(5, 87, 180);">
                                                                <img src="{{ asset('storage/' . $project->assignee->user_image) }}" alt="..." class="avatar avatar-xs shadow rounded-circle me-2">
                                                                <span>{{$project->assignee->username}}</span>
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
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary mb-0" data-bs-dismiss="modal"><i class="fi fi-rr-delete me-2 align-middle"></i>Close</button>
                            </div>
                          </div>
                        </div>
                    </div>

                      @empty
                      <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <div class="col-12">
                                <div class="card text-center">
                                    <div class="card-header">
                                        <img src="/img/no-found-illustration.png" width="30%">
                                    </div>
                                    <div class="card-body">
                                    <h5 class="card-title">No Current Completed Project Found 😔</h5>
                                    <p class="card-text">You haven't completed any of the projects</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
