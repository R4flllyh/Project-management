<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class projectController extends Controller
{
    public function index() {
        $ProjectList = Project::where('status', '!=', 'Done')->with('assignee')->get();
        $projectCount = Project::where('status', '!=', 'Done')->count();
        $users = User::where('user_image');

        return view('pages.project-management', compact('ProjectList', 'users', 'projectCount'));
    }

    // filter function
    public function filter(Request $request) {
        $status = $request->input('status');
        $priority = $request->input('priority');

        $projectQuery = Project::where('status', '!=', 'Done');

        if ($status) {
            $projectQuery->where('status', $status);
        }

        if ($priority) {
            $projectQuery->where('priority', $priority);
        }

        $ProjectList = $projectQuery->get();
        $projectCount = $ProjectList->count();

        return view('pages.project-management', compact('ProjectList', 'projectCount'));
    }

    // create function
    public function create() {
        $usercontroller = new UserProfileController;
        $data = $usercontroller->get();
        return view('pages.add-project', compact('data'));
    }

    // view completed project page
    public function completed() {
        $currentDateTime = Carbon::now()->setTimezone('Asia/Singapore');
        $formattedDateTime = $currentDateTime->format('d M Y'); // Example format: 2023-09-15 15:30:00
        $completedProjects = Project::where('status', 'Done')->get();
        $completedProjectsCount = Project::where('status', 'Done')->count();
        return view('pages.completed-project', compact('completedProjects', 'formattedDateTime', 'completedProjectsCount'));
    }

    // Set status to completed
    public function statusComplete($id) {
        $project = Project::findOrFail($id);
        $project -> status = 'Done';
        $project -> save();

        return redirect() -> back() -> with('success', 'Project marked as completed successfully');
    }

    // store function
    public function store(Request $request) {
    $this->validate($request, [
        'project_name' => 'required|min:3|max:50',
        'project_description' => 'required',
        'timeline' => 'required',
        'link' => 'required',
        'assets' => 'required',
        'priority' => 'required',
        'user_id' => 'nullable',
        'status' => 'required',
        'project_type' => 'required|max:10',
        'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048',
    ]);

    // Get information
    if ($request->hasFile('project_image')) {
        $image = $request->file('project_image')->store('photo', 'public');
        // You can store the image path in the database or perform other actions if needed.
        // Example: $imagePath = 'storage/' . $image;
    } else {
        $image = null; // Set $image to null if no photo was provided.
    }

    Project::create([
        'project_name' => $request['project_name'],
        'project_description' => $request['project_description'],
        'timeline' => $request['timeline'],
        'link' => $request['link'],
        'assets' => $request['assets'],
        'priority' => $request['priority'],
        'user_id' => $request['user_id'],
        'status' => $request['status'],
        'project_type' => $request['project_type'],
        'project_image' => $image,
    ]);

    return redirect()->route('project-index')->with('success', 'Project data created successfully');
    }

    // detail function
    function details($id) {
        $detail = Project::find($id);
        return view('pages.project-management', compact('detail'));
    }

    // edit function
    function edit($id){
        $users = User::all();
        $edit = Project::find($id);
        return view('pages.edit-project', compact('edit', 'users'));
    }

    // Update function
    public function update(Request $request, $id) {
        $this->validate($request, [
            'project_name' => 'required|min:3|max:50',
            'project_description' => 'required',
            'timeline' => 'required',
            'link' => 'required',
            'assets' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'user_id' => 'nullable',
            'project_type' => 'required',
            'project_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048',
            // validation rules for project fields
        ]);

        $project = Project::find($id);

        if (!$project) {
            return redirect()->route('project-index')->with('error', 'Project not found.');
        }

        $project->update([
            'project_name' => $request->input('project_name'),
            'project_description' => $request->input('project_description'),
            'timeline' => $request->input('timeline'),
            'link' => $request->input('link'),
            'assets' => $request->input('assets'),
            'priority' => $request->input('priority'),
            'status' => $request->input('status'),
            'user_id' => $request->input('user_id'),
            'project_type' => $request->input('project_type'),
            // update other fields as needed
        ]);

        if ($request->hasFile('project_image')) {
            $imagePath = $request->file('project_image')->store('photo', 'public');
            $project->project_image = $imagePath;
            $project->save(); // Save the updated project with the new image path
        }

        return redirect()->route('project-index')->with('success', 'Project updated successfully');
    }

    // Project Delete function
    public function destroy($id) {
        //find the project record by id
        $project = Project::find($id);
        //Delete the project record
        $project -> delete();

        // Redirect back to the appropriate page with a success message
        return redirect()->route('project-index')->with('success', 'Project data deleted successfully');

    }
}
