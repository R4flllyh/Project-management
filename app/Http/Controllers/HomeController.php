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
        $currentDateTime = Carbon::now()->setTimezone('Asia/Singapore');
        $formattedDateTime = $currentDateTime->format('Y');
        $ProjectList = Project::all();
        $monthlyProjects = Project::selectRaw('MONTH(created_at) as month, COUNT(*) as project_count')->whereYear('created_at', '=', date('Y'))->groupBy(DB::raw('MONTH(created_at)'))->get();
        $onProgressProjectsCount = Project::where('status', 'progress')->count();
        $RevisionProjectsCount = Project::where('status', 'Revision')->count();
        $PendingProjectsCount = Project::where('status', 'Pending')->count();
        $CompletedProjectsCount = Project::where('status', 'Done')->count();
        return view('pages.dashboard')->with(['RevisionProjectsCount' => $RevisionProjectsCount, 'onProgressProjectsCount' => $onProgressProjectsCount, 'PendingProjectsCount' => $PendingProjectsCount, 'CompletedProjectsCount' => $CompletedProjectsCount, 'ProjectList' => $ProjectList, 'monthlyProjects' => $monthlyProjects, 'formattedDateTime' => $formattedDateTime]);
    }
}
