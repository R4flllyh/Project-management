<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex justify-content-center align-items-center gap-0 mt-2" href="{{ route('home') }}"
            target="_blank">
            <img src="/img/Logo Vector.png" class="navbar-brand-img h-100 ms-2" alt="main_logo">
            <h5 class="font-weight-bold mb-0 mt-1" style="margin-left: -8px;">ebcare.idn</h5>
        </a>
    </div>
    <hr class="horizontal dark mt-auto">
    <div class="w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fi fi-rr-home text-primary text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'project-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'project-management']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fi fi-rr-briefcase text-info text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Project</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'project-progress') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'project-progress']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fi fi-rr-envelope-dot text-danger text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Notification</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'project-completed') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'project-completed']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fi fi-rr-envelope-open-text text-success text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">History</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'teams') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'teams']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fi fi-rr-users text-warning text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Teams</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'tables') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'tables']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'billing') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'billing']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-success text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'rtl' ? 'active' : '' }}" href="{{ route('rtl') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-danger text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">RTL</span>
                </a>
            </li> --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fi fi-rr-user text-dark text-lg opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav position-absolute bottom-1 w-100">
            <li class="nav-item">
                <div class="nav-link active" href="#">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        @if (auth()->user()->user_image)
                        <img src="{{ asset('storage/' . auth()->user()->user_image) }}" alt="..." class="avatar shadow rounded-circle avatar-sm">
                        @else
                        <img src="{{ asset('img/Graggle – 07.png') }}" alt="..." class="avatar shadow rounded-circle avatar-sm">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <span class="nav-link-text ms-1 mb-0">{{ auth()->user()->username }}</span>
                        <span class="nav-link-text text-muted text-xs ms-1">{{ auth()->user()->about }}</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</aside>
