<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostsPublishScheduled extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Publish scheduled posts';

    public function handle()
    {
        Log::info('Command posts:publish-scheduled mulai berjalan.');

        $posts = Post::where('status', 'scheduled')
             ->where('scheduled_at', '<=', now())
             ->get();

        if ($posts->isEmpty()) {
            Log::info('Tidak ada post yang harus dipublish.');
        } else {
            foreach ($posts as $post) {
                Log::info("Memproses post ID: {$post->id}");
                $post->update([
                    'status' => 'published',
                    'published_at' => now(),
                ]);
                Log::info("Post ID {$post->id} telah dipublish.");
            }
        }

        Log::info('Command posts:publish-scheduled selesai.');
    }
}
