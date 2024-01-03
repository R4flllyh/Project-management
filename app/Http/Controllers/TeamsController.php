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
        $users = User::all();

        return view('pages.teams', compact('users', 'user'));
    }
}
