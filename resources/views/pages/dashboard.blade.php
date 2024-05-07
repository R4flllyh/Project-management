@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <!-- CSS -->
    <style>
        .dropdown-scrollable {
            max-height: 100px; /* Set the maximum height for the dropdown menu */
            overflow-y: auto; /* Enable vertical scrolling */
        }
    </style>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">On progress</p>
                                    <h5 class="font-weight-bolder">
                                        <span class="text-primary">{{ $onProgressProjectsCount }}</span> Projects
                                    </h5>
                                    <p class="mb-0">
                                        @php
                                            $progressProject = $ProjectList -> firstWhere('status', 'Progress');
                                        @endphp
                                        @if ($progressProject)
                                            {{ $progressProject->updated_at->diffForHumans() }}
                                        @else
                                            None
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-info shadow-danger text-center rounded-circle">
                                    <i class="fi fi-rr-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending</p>
                                    <h5 class="font-weight-bolder">
                                        <span class="text-danger">{{ $PendingProjectsCount }}</span> Projects
                                    </h5>
                                    <p class="mb-0">
                                        @php
                                            $pendingProject = $ProjectList -> firstWhere('status', 'Pending');
                                        @endphp
                                        @if ($pendingProject)
                                            {{ $pendingProject->updated_at->diffForHumans() }}
                                        @else
                                            None
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-warning text-center rounded-circle">
                                    <i class="fi fi-rr-calendar-clock text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Revision</p>
                                    <h5 class="font-weight-bolder">
                                        <span class="text-warning">{{ $RevisionProjectsCount }}</span> Project
                                    </h5>

                                    <p class="mb-0">
                                        @php
                                            $revisionProject = $ProjectList -> firstWhere('status', 'Revision')
                                        @endphp
                                        @if ($revisionProject)
                                            {{ $revisionProject->updated_at->diffForHumans() }}
                                        @else
                                            None
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle">
                                    <i class="fi fi-rr-calendar-lines-pen text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Completed</p>
                                    <h5 class="font-weight-bolder">
                                        <span class="text-success   ">{{ $CompletedProjectsCount }}</span> Project
                                    </h5>
                                    <p class="mb-0">
                                        @php
                                            $completedProject = $ProjectList -> firstWhere('status', 'Done');
                                        @endphp
                                        @if ($completedProject)
                                            {{ $completedProject->updated_at->diffForHumans() }}
                                        @else
                                            None
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="fi fi-rr-trophy text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-capitalize">📦 Project overview</h6>
                                <p class="text-sm mb-0 ps-2">
                                    <span>Showing projects</span> on <span id="currentYear" class="font-weight-bold">{{ $formattedDateTime }}</span>
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <button type="button" class="btn btn-primary"><i class="fi fi-rr-document align-middle me-1"></i> Export</button>
                                <div class="btn-group dropup">
                                    <button type="button" class="btn bg-gradient-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Change year
                                    </button>
                                    <ul class="dropdown-menu dropdown-scrollable px-2 py-3" aria-labelledby="dropdownMenuButton" id="yearFilterDropdown">
                                        <!-- Dropdown options will be dynamically generated here -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active" style="background-image: url('./img/carousel-1.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="fi fi-rr-camera text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Get started with us</h5>
                                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-2.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="fi fi-rr-bulb text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Faster way to manage your project</h5>
                                    <p>Efficiently plan, track with our project management platform.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-3.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="fi fi-rr-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                        <h6>Projects List</h6>
                        <a href="#" class="btn bg-gradient-dark px-3 mb-0">
                            <i class="fi fi-rr-bars-filter text-xl me-2 align-middle mb-0"></i> <span>Filter by</span>
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Project</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Due dates</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Priority</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ProjectList as $projects)
                                    <tr>
                                        <td>
                                            <div class="d-flex ps-3">
                                                {{-- <div>
                                                    <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2">
                                                </div> --}}
                                                <div>
                                                    @if($projects -> assignee -> user_image)
                                                    <img src="{{ asset('storage/' . $projects -> assignee -> user_image) }}" class="avatar avatar-sm me-3" alt="user2">
                                                    @else
                                                    <img src="{{ asset('img/Graggle – 07.png') }}" class="avatar avatar-sm me-3" alt="user2">
                                                    @endif
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm">{{$projects -> project_name}}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{\Carbon\Carbon::parse($projects->timeline)->format('d M Y') }}</p>
                                        </td>
                                        <td>
                                            <span class="text-sm font-weight-bold">{{$projects -> status}}</span>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$projects -> priority}}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a type="button" class="btn btn-primary m-0" data-bs-toggle="modal" href="#" data-bs-target="#staticBackdrop{{$loop->iteration}}">
                                                <p class="mb-0">Details</p>
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
    </div>
@endsection

@push('js')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Function to generate the years for the dropdown
        function generateYearOptions() {
            var currentYear = (new Date()).getFullYear();
            var dropdown = document.getElementById('yearFilterDropdown');
            dropdown.innerHTML = ''; // Clear existing options

            // Add options for current year and two years before it
            for (var i = currentYear; i >= 2021; i--) {
                var option = document.createElement('li');
                option.innerHTML = '<a class="dropdown-item border-radius-md" href="javascript:;" onclick="filterChartByYear(' + i + ')">' + i + '</a>';
                dropdown.appendChild(option);
            }
        }

        // Call the function to generate options when the page loads
        window.onload = function() {
            generateYearOptions();
        };

        // Function to handle the year filter
        function filterChartByYear(year) {
            // Send an AJAX request to the backend to filter data
            $.ajax({
                type: "GET",
                url: "{{ route('filter_chart_by_year') }}",
                data: { year: year },
                success: function(response) {
                    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                    var formattedMonths = response.months.map(month => monthNames[month - 1]);
                    // Update chart data based on the response
                    chart.data.labels = formattedMonths;
                    chart.data.datasets[0].data = response.projectCounts;
                    chart.update();

                    // Update the year on text
                    $('#currentYear').text(year);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

    <!-- Your existing script for initializing Chart.js and defining data -->
    <script>
        var months = [];
        var projectCounts = [];

        @foreach($monthlyProjects as $monthlyProject)
            // Use Carbon to parse the month name
            var monthName = '{{ \Carbon\Carbon::create()->month($monthlyProject->month)->format("M") }}';
            months.push(monthName); // Push the month name to the array
            projectCounts.push('{{ $monthlyProject->project_count }}');
        @endforeach
    </script>

    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(34, 110, 242, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(34, 110, 242, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        var chart = new Chart(ctx1, {
            type: "line",
            data: {
                labels: months,
                datasets: [{
                    label: "Project",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#226ef2",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: projectCounts,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#226ef2',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#226ef2',
                            padding: 20,
                            font: {
                                size: 12,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush

