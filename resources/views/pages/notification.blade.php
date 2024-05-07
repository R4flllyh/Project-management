@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Notification'])
<div class="container-fluid mx-0">
    <div class="row mt-4">
        <div class="col-6">
            <div class="card my-0">
                <div class="card-header mb-4 pb-0 d-flex align-items-center justify-content-between">
                    <h5 class="my-0">Notification</h5>
                    <a href="#" class="btn btn-sm bg-gradient-dark px-3 mb-0">
                        <i class="fi fi-br-check text-xs me-2 align-middle mb-0"></i> <span>Mark as read</span>
                    </a>
                </div>
                <div class="card-body px-0 pt-0">
                    <ul class="nav ps-3 gap-4 py-0 my-0">
                        <li class="d-flex">
                            <a class="nav-link d-flex justify-content-between align-items-center gap-2" href="#">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text text-primary text-sm ms-1">Unread</span>
                                </div>
                                <span class="badge rounded-pill bg-danger text-xxs">2</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center gap-2" href="#">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text text-secondary text-sm ms-1">All</span>
                                </div>
                                <span class="badge badge-sm rounded-pill bg-danger text-xxs">22</span>
                            </a>
                        </li>
                    </ul>
                    <hr class="mt-0">
                    <div class="d-flex flex-column gap-3">
                        <div>
                            <h6 class="ps-4 my-0 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">April 2024</h6>
                        </div>
                        <a href="#" class="btn btn-outline-light p-0 m-0">
                            <blockquote class="blockquote text-white mb-0 d-flex flex-column gap-1 py-2">
                                <div class="d-flex align-items-center justify-content-between gap-2 px-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-xs rounded-circle">
                                        <h6 class="my-0 text-sm">Rafly</h6>
                                        <h6 class="text-xs text-secondary align-middle m-0 fw-semibold">1 day ago</h6>
                                    </div>
                                    <span class="badge bg-gradient-info rounded-circle d-inline-block py-1 px-1 text-xxs"></span>
                                </div>
                                <div class="d-flex px-3 gap-3 align-items-center">
                                    <p class="text-dark my-0">Rafly has finished "Frontend Focus Issue" Project.</p>
                                </div>
                            </blockquote>
                        </a>
                        <a href="#" class="btn btn-outline-light p-0 m-0">
                            <blockquote class="blockquote text-white mb-0 d-flex flex-column gap-1 py-2">
                                <div class="d-flex align-items-center justify-content-between gap-2 px-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-xs rounded-circle">
                                        <h6 class="my-0 text-sm">Rafly</h6>
                                        <h6 class="text-xs text-secondary align-middle m-0 fw-semibold">1 day ago</h6>
                                    </div>
                                    <span class="badge bg-gradient-info rounded-circle d-inline-block py-1 px-1 text-xxs"></span>
                                </div>
                                <div class="d-flex px-3 gap-3 align-items-center">
                                    <p class="text-dark my-0">Rafly has finished "Frontend Focus Issue" Project.</p>
                                </div>
                            </blockquote>
                        </a>

                        <div>
                            <h6 class="ps-4 my-0 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">March 2024</h6>
                        </div>
                        <a href="#" class="btn btn-outline-light active p-0 m-0">
                            <blockquote class="blockquote text-white mb-0 d-flex flex-column gap-1 py-2">
                                <div class="d-flex align-items-center justify-content-between gap-2 px-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-xs rounded-circle">
                                        <h6 class="my-0 text-sm">Admin</h6>
                                        <h6 class="text-xs text-secondary align-middle m-0 fw-semibold">1 month ago</h6>
                                    </div>
                                    {{-- <span class="badge bg-gradient-info rounded-circle d-inline-block py-1 px-1 text-xxs"></span> --}}
                                </div>
                                <div class="d-flex px-3 gap-3 align-items-center">
                                    <p class="text-dark my-0">Admin created a project name "Frontend Focus Issue".</p>
                                </div>
                            </blockquote>
                        </a>
                        <a href="#" class="btn btn-outline-light p-0 m-0">
                            <blockquote class="blockquote text-white mb-0 d-flex flex-column gap-1 py-2">
                                <div class="d-flex align-items-center justify-content-between gap-2 px-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/team-2.jpg" class="avatar avatar-xs rounded-circle">
                                        <h6 class="my-0 text-sm">Admin</h6>
                                        <h6 class="text-xs text-secondary align-middle m-0 fw-semibold">1 month ago</h6>
                                    </div>
                                    {{-- <span class="badge bg-gradient-info rounded-circle d-inline-block py-1 px-1 text-xxs"></span> --}}
                                </div>
                                <div class="d-flex px-3 gap-3 align-items-center">
                                    <p class="text-dark my-0">Admin created a project name "Frontend Focus Issue".</p>
                                </div>
                            </blockquote>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
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
@endsection
