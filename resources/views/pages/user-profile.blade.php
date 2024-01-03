@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Your Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl">
                        @if(auth()->user()->user_image)
                            <img src="{{ asset('storage/' . auth()->user()->user_image) }}" alt="profile_image" class="border-radius-lg shadow-sm">
                        @else
                        <!-- Default profile image if user has no image -->
                            <img src="{{ asset('img/Graggle – 07.png') }}" alt="profile_image" class="border-radius-lg shadow-sm">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 text-capitalize fs-4">
                            {{ auth() -> user() -> username }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ auth() -> user() -> about}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active"
                                    data-bs-toggle="tab" id="tab1-tab" href="#tab1" role="tab" aria-controls="preview" aria-selected="true">
                                    <i class="fi fi-rr-settings"></i>
                                    <span class="ms-2">User Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center tablinks"
                                    data-bs-toggle="tab" id="tab2-tab" role="tab" href="#tab2" aria-controls="code" aria-selected="false">
                                    <i class="fi fi-rr-box-open"></i>
                                    <span class="ms-2">Project</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card tab-content">
                    <div id="tab1" class="tab-pane fade show active">
                        <form role="form" method="POST" action={{ route('profile.update') }} enctype="multipart/form-data">
                            @csrf
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0"><i class="fi fi-rr-user-pen me-2 align-middle"></i> Edit Profile</p>
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto mb-0">Save</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">User Information</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Username</label>
                                            <input class="form-control" type="text" name="username" value="{{ old('username', auth()->user()->username) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email address</label>
                                            <input class="form-control" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">First name</label>
                                            <input class="form-control" type="text" name="firstname"  value="{{ old('firstname', auth()->user()->firstname) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Last name</label>
                                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname', auth()->user()->lastname) }}">
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Contact Information</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Address</label>
                                            <input class="form-control" type="text" name="address"
                                                value="{{ old('address', auth()->user()->address) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">City</label>
                                            <input class="form-control" type="text" name="city" value="{{ old('city', auth()->user()->city) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Country</label>
                                            <input class="form-control" type="text" name="country" value="{{ old('country', auth()->user()->country) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Postal code</label>
                                            <input class="form-control" type="text" name="postal" value="{{ old('postal', auth()->user()->postal) }}">
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">About me</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">About me</label>
                                            <input class="form-control" type="text" name="about"
                                                value="{{ old('about', auth()->user()->about) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">User Image</label>
                                            <input class="form-control" type="file" name="user_image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0"><i class="fi fi-rr-boxes me-2 align-middle"></i> Your Project</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table align-items-center justify-content-center mb-0 px-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Timeline</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Priority</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Assignee</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->projects as $project)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2">
                                                    {{-- <i class="fi fi-rr-diploma text-lg text-primary me-3 ms-2"></i> --}}
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">{{$project -> project_name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{\Carbon\Carbon::parse($project->timeline)->format('d M Y') }}</p>
                                        </td>
                                        <td>
                                            <span class="text-sm font-weight-bold">{{$project -> status}}</span>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$project -> priority}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$project->assignee->username}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="#" class="btn btn-primary">Details</a>
                                            {{-- <button class="btn btn-link text-secondary mb-0">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var myTabs = new bootstrap.Tab(document.getElementById('tab1-tab'));
                myTabs.show(); // Show the first tab by default
            });
        </script>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
