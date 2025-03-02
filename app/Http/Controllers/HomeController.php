<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = auth()->check() 
            ? Post::where('user_id', auth()->id())->latest()->paginate(5)
            : collect(); // Jika user belum login, kirim koleksi kosong

        return view('home', compact('posts'));
    }
}
