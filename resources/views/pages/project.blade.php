@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Project Pages'])
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0">🔥 Current Project</h5>
                                <p class="mb-0 ps-2 pt-1">Showing <span class="text-primary">{{ $projectCount }}</span> projects</p>
                            </div>
                            <div class="col-6 text-end d-flex align-items-center gap-2 justify-content-end">
                                <form action="{{ route('projects.filter') }}" method="post" class="gap-2 d-flex">
                                    @csrf
                                    <div class="btn-group mb-0">
                                        <button type="button" class="btn btn-primary dropdown-toggle mb-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fi fi-rr-world align-middle me-2"></i> Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" type="submit" name="status" value="Pending">Pending</button></li>
                                            <li><button class="dropdown-item" type="submit" name="status" value="Progress">In Progress</button></li>
                                            <li><button class="dropdown-item" type="submit" name="status" value="Revision">Revision</button></li>
                                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                        </ul>
                                    </div>

                                    <div class="btn-group mb-0">
                                        <button type="button" class="btn btn-primary dropdown-toggle mb-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fi fi-rr-paper-plane align-middle me-2"></i>Priority
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button class="dropdown-item" type="submit" name="priority" value="Low">Low</button></li>
                                            <li><button class="dropdown-item" type="submit" name="priority" value="Medium">Medium</button></li>
                                            <li><button class="dropdown-item" type="submit" name="priority" value="High">High</button></li>
                                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                        </ul>
                                    </div>
                                    <a href="{{ route('project-index') }}" class="btn btn-primary mb-0"><i class="fi fi-rr-eye align-middle me-2"></i>Show All</a>
                                </form>
                                <span class="text-muted">|</span>
                                <a href="{{route('project-create')}}" class="btn bg-gradient-dark px-3 mb-0">
                                    <i class="fi fi-rr-plus text-md me-2 py-0 align-middle"></i> <span>Add Project</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success text-white mt-4">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row mt-4">
                    @forelse ($ProjectList as $project)
                    <div class="col-4">
                        <div class="card mb-3">
                            @if ($project -> project_image)
                                <img src="{{ asset('storage/' . $project -> project_image) }}" class="card-img-top">
                            @endif
                            <div class="card-body">
                                <div class="dropdown d-flex position-absolute top-4 end-2">
                                    <button class="btn d-flex align-items-center text-lg p-0 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-symbols-outlined text-primary opacity-10">
                                            more_vert
                                        </i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{Route('project-edit', $project -> id)}}">
                                            <i class="fi fi-rr-file-edit text-dark me-2"></i> Edit</a></li>
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
                                <div class="d-flex gap-2">
                                    <h6 class="text-center px-3 rounded priority-low">{{$project -> priority}}</h6>
                                    <h6 class="text-center px-3 rounded priority-medium">{{$project -> project_type}}</h6>
                                    <h6 class="text-center px-3 rounded priority-important">{{$project -> status}}</h6>
                                </div>
                                <h5 class="card-title">{{\Illuminate\Support\str::limit($project -> project_name, $limit = 30, $end = '...')}}</h5>
                                <p class="card-text">{{\Illuminate\Support\str::limit($project -> project_description, $limit = 50, $end = '...')}}</p>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center pt-2">
                                <small class="text-body-secondary align-middle"><i class="fi fi-rr-clock-five align-middle me-2"></i> Created on {{ $project -> created_at -> format('d M Y') }}</small>
                                <div class="d-flex gap-2 align-items-center">
                                    @if ($project->assignee->user_image)
                                    <img src="{{ asset('storage/' . $project->assignee->user_image) }}" alt="..." class="avatar shadow rounded-circle avatar-sm">
                                    @else
                                    <img src="{{ asset('img/Graggle – 07.png') }}" alt="..." class="avatar shadow rounded-circle avatar-sm">
                                    @endif
                                    <a type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" href="{{route('project-detail', $project -> id)}}" data-bs-target="#staticBackdrop{{$loop->iteration}}">
                                            <p class="mb-0">Details</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="staticBackdrop{{$loop->iteration}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                          <div class="modal-content px-3">
                            <div class="modal-body">
                                <div class="d-flex col-8 mb-3 gap-2 px-2">
                                    <h6 class="text-center px-3 mt-4 rounded priority-important">{{$project -> project_type}}</h6>
                                    <h6 class="text-center px-3 mt-4 rounded priority-low">{{$project -> status}}</h6>
                                    <h6 class="text-center px-3 mt-4 rounded priority-medium">Created on {{$project -> created_at -> format('d M Y')}}</h6>
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
                                                            <a href="{{$project -> link}}" class="btn-primary font-weight-bold text-sm text-center py-2 rounded  mb-0" style="width: 40%;">
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
                                                            <a href="{{$project -> assets}}" class="btn-link font-weight-bold text-sm text-center py-2 rounded priority-important mb-0" style="width: 40%;">
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
                                                                @if ($project->assignee->user_image)
                                                                <img src="{{ asset('storage/' . $project->assignee->user_image) }}" alt="..." class="avatar avatar-xs shadow rounded-circle me-2">
                                                                @else
                                                                <img src="{{ asset('img/Graggle – 07.png') }}" alt="..." class="avatar avatar-xs shadow rounded-circle me-2">
                                                                @endif
                                                                {{$project->assignee->username}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <h4 class="fw-3">Subtask</h4>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <a href="#" class="addSubtaskBtn">
                                                        <i class="fi fi-rr-plus text-md me-2 py-0 align-middle"></i>
                                                    </a>
                                                </span>
                                                <input type="text" class="form-control subtaskInput" placeholder="Add subtask" aria-label="Add subtask" aria-describedby="basic-addon1">
                                            </div>
                                            <div id="subtaskContainer">
                                                <!-- Subtasks will be dynamically added here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mt-0 mb-0" data-bs-dismiss="modal"><i class="fi fi-rr-delete me-2 align-middle"></i>Close</button>
                                <form action="{{route('status-complete', $project -> id)}}" method="post">
                                    @csrf
                                    @method('post')
                                    <button type="submit" class="btn btn-primary mb-0"><i class="fi fi-rr-check-circle me-2 align-middle"></i>Mark as Done</button>
                                </form>
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
                                    <h5 class="card-title">No Current Project Found 😔</h5>
                                    <p class="card-text">Let's start adding your first project</p>
                                    <a href="{{route('project-create')}}" class="btn btn-primary">Start adding your project</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    @endforelse
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            // Add a script to hide the success message after a few seconds using jQuery
            $(document).ready(function(){
                setTimeout(function(){
                    $('#successMessage').fadeOut();
                }, 5000); // Adjust the time in milliseconds (5000 = 5 seconds)
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
