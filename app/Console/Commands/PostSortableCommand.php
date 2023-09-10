<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PostSortableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:sort:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();
        $posts->each(function ($post, $key){
            Post::where('id', $post->id)->update(['sort' => $key]);
        });

        return Command::SUCCESS;
    }
}
