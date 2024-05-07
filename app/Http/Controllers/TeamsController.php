<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamsController extends Controller
{
    public function teams() {
        $user = Auth::user();
        $users = User::all() -> map(function($user) {
            $user -> is_online = $user -> isOnline();
            return $user;
        });
        $ProjectActivity = Project::all();

        return view('pages.teams', compact('users', 'user', 'ProjectActivity'));
    }
}

