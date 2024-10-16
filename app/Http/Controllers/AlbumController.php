<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    // Menampilkan form buat album baru
    public function create()
    {
        return view('albums.create');
    }

    public function index(Request $request)
    {
        $searchInput = $request->input('search');
        $albums = Album::when($searchInput, function ($query) use ($searchInput) {
            $query->where('name', 'like', "%{$searchInput}%");
        })->paginate(12);
    
        return view('albums.index', compact('albums'));
    }

    // Menyimpan album baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Pastikan nama album diisi dan valid
            'description' => 'nullable|string',
        ]);

        // Create the album
        $album = Album::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('albums.index')->with('success', 'Album dibuat dengan sukses.');
    }

    public function show(Album $album)
    {
        $userAlbums = null;
        if (Auth::check()) {
            $userAlbums = Auth::user()->albums;
        }
        return view('albums.show', compact('album', 'userAlbums'));
    }

    public function edit(Album $album)
    {
        // Periksa apakah user adalah pemilik album
        if (Auth::user()->id != $album->user_id) {
            abort(403, 'Unauthorized');
        }

        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        // Periksa apakah user adalah pemilik album
        if (Auth::user()->id != $album->user_id) {
            abort(403, 'Unauthorized');
        }

        // Update the album
        $request->validate([
            'name' => 'required|string|max:255', // Pastikan nama album diisi dan valid
            'description' => 'nullable|string',
        ]);

        $album->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('albums.index')->with('success', 'Album diupdate dengan sukses.');
    }

    public function destroy(Album $album)
    {
        // Periksa apakah user adalah pemilik album
        if (Auth::user()->id != $album->user_id) {
            abort(403, 'Unauthorized');
        }

        // Delete the album
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album dihapus dengan sukses.');
    }


    public function saveToAlbum(Request $request, $id)
    {
        $album = Album::find($id);
        $gallery = Gallery::find($request->image_id);

        if ($album && $gallery) {
            if (Auth::check() && $album->user_id == Auth::id()) {
                $album->galleries()->attach($gallery->id);
                return redirect()->back()->with('success', 'Gambar disimpan ke album dengan sukses.');
            } else {
                return redirect()->back()->with('error', ' Anda tidak memiliki izin untuk menyimpan gambar ke album ini.');
            }
        } else {
            return redirect()->back()->with('error', 'Album atau gambar tidak ditemukan.');
        }
    }


    //ADMIN PANNEL!!

   // ADMIN PANEL ALBUMS
   public function adminIndex(Request $request)
{
    // Ambil semua album dari database
    $albums = Album::paginate(4); 
    
    // Initialize empty collection for images
    $images = collect(); 
    $selectedAlbum = null;

    // Handle album selection via the GET request
    if ($request->has('album_id') && $request->input('album_id')) {
        $selectedAlbum = Album::find($request->input('album_id'));

        if ($selectedAlbum) {
            $images = $selectedAlbum->galleries; // Load images for selected album
        }
    }

    // Kembalikan view admin dengan data semua album
    return view('admin.albums.index', compact('albums', 'selectedAlbum', 'images'));
}


public function showAlbumImages(Album $album)
{
    // Load the images associated with the album
    $images = $album->galleries; // Assuming 'galleries' is the relationship name

    // Retrieve all albums to pass to the view
    $albums = Album::paginate(4); // You can adjust the pagination as needed

    return view('admin.albums.index', compact('albums', 'album', 'images'));
}
    

    public function adminDestroy(Album $album)
    {
        $album->delete(); // Menghapus album
        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully.'); // Redirect setelah sukses
    }

    public function adminEdit(Album $album)
{
    return view('admin.albums.edit', compact('album'));
}

public function adminUpdate(Request $request, Album $album)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Update the album
    $album->update([
        'name' => $request->name,
        'description' => $request->description, // Assuming you have a description field
    ]);

    return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully.');
}


}

