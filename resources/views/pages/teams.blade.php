@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Teams'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Teams</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Author</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Project</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employed</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Role</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($user -> user_image)
                                                    <img src="{{ asset('storage/' . $user -> user_image) }}" class="avatar avatar-sm me-3" alt="user2">
                                                    @else
                                                    <img src="{{ asset('img/Graggle – 07.png') }}" class="avatar avatar-sm me-3" alt="user2">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user -> username}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$user -> email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user -> projects -> count() }}</p>
                                            <p class="text-xs text-secondary mb-0">Projects</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm {{ $user -> is_online ? 'bg-gradient-success' : 'bg-gradient-danger'}}">{{$user -> is_online ? 'Online' : 'Offline'}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$user -> created_at}}</span>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-xs">{{ $user -> about}}</h6>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Delete
                                            </a>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Task Activity</h6>
                    </div>
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned to</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deadline</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Project name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            <th class="text-secondary opacity-7"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($ProjectActivity as $Project)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if($Project ->assignee->user_image)
                                                    <img src="{{ asset('storage/' . $Project->assignee->user_image) }}" class="avatar avatar-sm me-3" alt="user2">
                                                    @else
                                                    <img src="{{ asset('img/Graggle – 07.png') }}" class="avatar avatar-sm me-3" alt="user2">
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$Project->assignee->username}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$Project ->assignee->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{\Carbon\Carbon::parse($Project->timeline)->format('d M Y') }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$Project -> project_name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$Project -> status}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                See Details
                                            </a>
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

    @include('layouts.footers.auth.footer')
@endsection
