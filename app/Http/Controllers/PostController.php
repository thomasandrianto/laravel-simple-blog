<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
   
    public function index()
    {
        $posts = Post::with('user')->where('status', 'published')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {       
       
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'scheduled_at' => 'nullable|date',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'scheduled_at' => $request->status === 'scheduled' ? $request->scheduled_at : null,
            'published_at' => $request->is_draft ? null : $request->published_at,
            //'image_url' => $imagePath ? asset("storage/$imagePath") : null,
            'image_url' => $imagePath ? "storage/$imagePath" : null,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'title' => 'required|max:60',
            'content' => 'required',
            'scheduled_at' => 'nullable|date',
            'published_at' => 'nullable|date',            
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image_url) {
                Storage::delete(str_replace(asset('storage/'), '', $post->image_url));
            }
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image_url = "storage/$imagePath"; 
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'scheduled_at' => $request->status === 'scheduled' ? $request->scheduled_at : null,
            'published_at' => $request->is_draft ? null : $request->published_at,
            'image_url' => $post->image_url,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }

        if ($post->image_url) {
            Storage::delete(str_replace(asset('storage/'), '', $post->image_url));
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}