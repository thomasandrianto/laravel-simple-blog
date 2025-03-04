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
        Log::info('Command posts:publish-scheduled start.');

        $updatedCount = Post::where('status', Post::STATUS_SCHEDULED)
            ->where('scheduled_at', '<=', now())
            ->update([
                'status' => Post::STATUS_PUBLISHED,
                'published_at' => now(),
            ]);

        if ($updatedCount > 0) {
            Log::info("Total {$updatedCount} post has published.");
        } else {
            Log::info('There are no posts that must be published.');
        }

        Log::info('Command posts:publish-scheduled done.');
    }
}
