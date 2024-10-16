<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Album;
use App\Models\Gallery;

class AdminController extends Controller
{   
    public function updateUser(Request $request, User $user)
    {
        $user->is_admin = $request->has('is_admin');
        $user->save();
    
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function manageUsers()
    {
        // Ambil pengguna dengan paginasi
        $users = User::paginate(10); // Ganti 10 dengan jumlah pengguna per halaman yang diinginkan
        return view('admin.users.index', compact('users'));
    }


    public function manageAlbums()
    {
        $albums = Album::all(); // Mendapatkan semua album
        return view('admin.albums.index', compact('albums'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function editGallery(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function updateGallery(Request $request, Gallery $gallery)
    {
        $gallery->update($request->only('title', 'description'));
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated successfully.');
    }

    // app/Http/Controllers/AdminController.php

public function dashboard(Request $request)
{
    // Retrieve data for the dashboard
    $userCount = User::count();
    $albumCount = Album::count();
    $galleryCount = Gallery::count();

    // Get the current year or the selected year from the request
    $year = $request->input('year') ?? now()->year;

    // Retrieve new users and galleries data grouped by month
    $newUsersData = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', $year) // Selected year
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count')
        ->toArray();

    $newGalleriesData = Gallery::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', $year) // Selected year
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count')
        ->toArray();

    // Get the list of years for the dropdown menu
    $years = User::selectRaw('YEAR(created_at) as year')
        ->distinct()
        ->pluck('year')
        ->toArray();

    // Pass data to the view
    return view('admin.dashboard', compact('userCount', 'albumCount', 'galleryCount', 'newUsersData', 'newGalleriesData', 'years', 'year'));
}

}

