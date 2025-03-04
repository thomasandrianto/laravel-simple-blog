<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Enums\PostStatus;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->published() 
            ->latest()
            ->paginate(5);
                 
            return view('posts.index', [
                'posts' => $posts,
                'postStatus' => PostStatus::class
            ]);
    }

    public function create()
    {                      
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $imagePath = $request->file('image') ? $request->file('image')->store('uploads', 'public') : null;

        Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'status' => PostStatus::tryFrom($request->status) ?? PostStatus::Draft,
            'scheduled_at' => $request->status === PostStatus::Scheduled->value ? $request->scheduled_at : null,
            'published_at' => $request->is_draft ? null : $request->published_at,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        if (!$post->isPublished()) {
            abort(403, 'Post is not published yet.');
        }
    
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {           
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        }
    
        if ($request->hasFile('image')) {
            // delete old image if exist
            if ($post->image_url) {
                $oldImagePath = str_replace(asset('storage/'), '', $post->image_url);
                Storage::disk('public')->delete($oldImagePath);
            }
    
            // save new image
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image_url = asset("storage/$imagePath");
        }
    
        // Update data post
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => PostStatus::tryFrom($request->status) ?? PostStatus::Draft,
            'scheduled_at' => $request->status === PostStatus::Scheduled->value ? $request->scheduled_at : null,
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

        // delete image if exist before deleting post
        if ($post->image_url) {
            $imagePath = str_replace(asset('storage/'), '', $post->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
