<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $ProjectList = $user -> project;
        return view('pages.user-profile', compact('ProjectList', 'user'));
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required', 'max:255', 'min:2'],
            'firstname' => ['max:100'],
            'lastname' => ['max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'address' => ['max:100'],
            'city' => ['max:100'],
            'country' => ['max:100'],
            'postal' => ['max:100'],
            'about' => ['max:255'],
            'user_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,jfif'],
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Update user information
        $user->update($attributes);

        // Handle user image upload
        if ($request->hasFile('user_image')) {
            $imagePath = $request->file('user_image')->store('photo', 'public');
            $user->user_image = $imagePath;
            $user->save(); // Save the updated user with the new image path
        }

        return back()->with('success', 'Profile successfully updated');

    }
    public function get() {
        $data = User::get();
        return $data;

    }
}
