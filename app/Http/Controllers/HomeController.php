<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Project
        $currentDateTime = Carbon::now()->setTimezone('Asia/Singapore');
        $formattedDateTime = $currentDateTime->format('Y');
        $ProjectList = Project::all();
        $monthlyProjects = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as project_count')->whereYear('created_at', '=', date('Y'))->groupBy(DB::raw('MONTH(created_at)'))->get();

        // Count Projects
        $onProgressProjectsCount = Project::where('status', 'progress')->count();
        $RevisionProjectsCount = Project::where('status', 'Revision')->count();
        $PendingProjectsCount = Project::where('status', 'Pending')->count();
        $CompletedProjectsCount = Project::where('status', 'Done')->count();

        // list projects
        $onProgressProjects = Project::where('status', 'progress');
        $RevisionProjects = Project::where('status', 'Revision');
        $PendingProjects = Project::where('status', 'Pending');
        $CompletedProjects = Project::where('status', 'Done');

        // return
        return view('pages.dashboard')->with(['RevisionProjectsCount' => $RevisionProjectsCount, 'onProgressProjectsCount' => $onProgressProjectsCount, 'PendingProjectsCount' => $PendingProjectsCount, 'CompletedProjectsCount' => $CompletedProjectsCount, 'ProjectList' => $ProjectList, 'monthlyProjects' => $monthlyProjects, 'formattedDateTime' => $formattedDateTime, 'onProgressProjects' => $onProgressProjects, 'RevisionProjects' => $RevisionProjects, 'PendingProjects' => $PendingProjects, 'CompletedProjects' => $CompletedProjects]);
    }

    // New method to handle the year filtering
    public function filterChartByYear(Request $request)
    {
        $year = $request->input('year');

        // Fetch chart data based on the selected year
        $monthlyProjects = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as project_count')
            ->whereYear('created_at', '=', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Prepare and return the filtered data as JSON response
        return response()->json([
            'months' => $monthlyProjects->pluck('month'),
            'projectCounts' => $monthlyProjects->pluck('project_count')
        ]);
    }
}
