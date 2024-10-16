<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike($galleryId)
    {
        $gallery = Gallery::findOrFail($galleryId);
        $userId = Auth::id(); // Pastikan mengambil user yang login dengan auth()->id()

        // Cek jika user telah memberikan like sebelumnya
        $like = Like::where('user_id', $userId)->where('gallery_id', $galleryId)->first();

        if ($like && $gallery) {
            // Jika sudah like, hapus like
            $like->delete();
            return back();
        } else {
            // Jika belum, tambahkan like
            Like::create([
                'user_id' => $userId,  // Menggunakan auth()->id() untuk user yang sedang login
                'gallery_id' => $galleryId
            ]);
            return back();

            if (Auth::check()) {
                $user = Auth::user();
                // Debug untuk memeriksa apakah user valid
                dd($user); // Ini akan menghentikan eksekusi dan menampilkan data user
            } else {
                // Jika user belum login
                return redirect()->route('login')->with('error', 'You need to login first.');
            }
        }
    }


    
}
