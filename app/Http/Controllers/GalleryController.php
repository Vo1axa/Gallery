<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        $galleries = Gallery::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%') // Added search for description
                         ->orWhereHas('user', function ($query) use ($search) {
                             $query->where('username', 'like', '%' . $search . '%');
                         });
        })->get();
    
        return view('galleries.index', compact('galleries'));
    }
    

    public function create()
    {
        return view('galleries.create');
    }

    
    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        'description' => 'nullable|string|max:1000',
        'title' => 'required|string|max:255',
    ]);
    $validated_data['image'] =$request->file('image')->store('images','public');
    $validated_data['user_id'] = Auth::id();

    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('images'), $imageName);


    Gallery::create([
        'image' => $imageName,
        'description' => $request->description,
        'user_id' => Auth::id(), 
        'title' => $request->title,

    ]);

    return redirect()->route('galleries.index')->with('success', 'Gallery created successfully.');
    }
    
    public function show(Gallery $gallery, Album $album)
    {
        $userAlbums = Auth::user() ? Auth::user()->albums : collect();
        $albums = Album::all(); // Fetch all albums

        return view('galleries.show', compact('gallery','album'),
        [
            'gallery' => $gallery,
            'userAlbums' => $userAlbums,
            'albums' => $albums, // Pass albums to the view
        ]);
    }

    public function download($id)
    {
        $gallery = Gallery::findOrFail($id);
        $filePath = public_path('images/' . $gallery->image);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'File not found.');
    }


    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
    
        // Hanya izinkan pemilik image atau admin untuk mengedit
        if (!Auth::user()->is_admin && Auth::user()->id != $gallery->user_id) {
            return redirect()->route('galleries.index')->with('error', 'You do not have permission to edit this gallery.');
        }
    
        return view('galleries.edit', compact('gallery'));
    }
    
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
    
        // Hanya izinkan pemilik image untuk menghapus
        if (Auth::user()->id != $gallery->user_id) {
            return redirect()->route('galleries.index')->with('error', 'You do not have permission to delete this gallery.');
        }
    
        $gallery->delete();
    
        return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully.');
    }
    

    public function update(Request $request, $id)
{
    $gallery = Gallery::findOrFail($id);

    // Validasi data yang dikirim
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    // Update data gallery
    $gallery->title = $request->input('title');
    $gallery->description = $request->input('description');

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if (file_exists(public_path('images/' . $gallery->image))) {
            unlink(public_path('images/' . $gallery->image));
        }

        // Upload gambar baru
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        // Simpan nama file gambar baru
        $gallery->image = $imageName;
    }

    // Simpan perubahan
    $gallery->save();

    return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully');
}



    //ADMIN PANNEL!!

    public function adminIndex()
{
    // Ambil semua galeri dengan pagination
    $galleries = Gallery::with('user')->paginate(10); // Ganti angka sesuai kebutuhan
    
    return view('admin.galleries.index', compact('galleries'));
}



    public function adminEdit(Gallery $gallery)
    {
        // Return a view to edit the gallery
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function adminUpdate(Request $request, Gallery $gallery)
    {
        // Update the gallery
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);


        $gallery->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated successfully.');
    }
    public function adminDestroy(Gallery $gallery)
    {
        // Delete the gallery
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Gallery deleted successfully.');
    }
}
