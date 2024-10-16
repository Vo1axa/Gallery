<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $galleryId)
    {
        $request->validate([
            'body' => 'required|string'  // Validasi input body
        ]);

        // Cari galeri berdasarkan ID
        $gallery = Gallery::findOrFail($galleryId);
        $userId = Auth::id(); // Pastikan user yang login diambil dengan benar

        // Simpan komentar
        Comment::create([
            'user_id' => $userId,  // Pastikan user yang login
            'gallery_id' => $galleryId,
            'body' => $request->body
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
    
        // Cek apakah user yang login adalah admin
        if (Auth::user()->is_admin) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully!');
        }
    
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }
}
