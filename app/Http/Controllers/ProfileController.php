<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $galleries = Gallery::where('user_id', $user->id)->get();
        $albums = $user->albums;
    
        return view('profile.show', compact('user', 'galleries', 'albums'));
    }


   public function edit($id)
{
    $user = User::findOrFail($id);
    return view('profile.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'bio' => 'nullable|string|max:500',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'fullname' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
    ]);

    $user = User::findOrFail($id);

    // Update user data
    $user->update($request->only(['username', 'bio', 'fullname', 'address']));

    // Handle file upload
    if ($request->hasFile('profile_image')) {
        $imageName = time() . '.' . $request->profile_image->extension();
        $request->profile_image->move(public_path('images/profile'), $imageName);
        $user->profile_image = $imageName;
        $user->save();
    }

    return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully.');
}

}

