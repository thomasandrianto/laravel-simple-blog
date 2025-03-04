<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::when(auth()->check(), function ($query) {
            $query->where('user_id', auth()->id())->orderBy('created_at', 'desc');
        })->paginate(5);
    
        return view('home', compact('posts'));
    }
}
