<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Statistic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CollectStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::all();
        $comments = Comment::all();
        $data = [
            'post_count' => $posts->count(),
            'comment_count' => $comments->count(),
            'like_count' => DB::table('likeables')->count(),
            'post_like_count' => $posts->sum('liked_by_profiles_count'),
            'comment_like_count' => $comments->sum('liked_by_profiles_count'),
            'view_count' => 0,
        ];

        Statistic::create($data);
    }
}
