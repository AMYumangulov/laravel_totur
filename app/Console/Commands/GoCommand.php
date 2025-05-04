<?php

namespace App\Console\Commands;

use App\Mail\Comment\StoredCommentMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\DbLogs;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

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
//        Post::create([
//            'title'=>'my first post'
//        ]);

        /*$post = Post::find(2);

        $post->update(
            ['content'=>'my content']
        );
        $post->delete();*/

        //belongsTo
        //hasOne
        //hasMany
        //belongsMany
        /*-------------------------------------ПРОВЕРКА ОТНОШЕНИЙ----------------------------------------------*/
        //$post = Post::first();
        //dd($post->tags->toArray());
        //dd($post->likedProfiles->toArray());
        //dd($post->profile->toArray());
        //dd($post->category->toArray());
        //dd($post->comments->toArray());

        //$tag = Tag::find(1);
        //dd($tag->posts->toArray());

        //$profile = Profile::first();
        //dd($profile->likedPosts->toArray());
        //dd($profile->posts->toArray());
        //dd($profile->user->toArray());

        //$category = Category::find(2);
        //dd($category->posts->toArray());

        //$comment = Comment::find(6);
        //dd($comment->subComments->toArray());
        //dd($comment->post->toArray());
        //dd($comment->comment?->toArray());

        //$user = User::find(2);
        //dd($user->profiles->toArray());

        /*-----------------------------------------Полиморфы-----------------------------------------------*/
        //attach
        //detach
        //sync
        //syncWithoutDetaching
        //toggle

////        $post->likedByProfiles()->attach(1);
//        $post->image()->create([
//            'path' => fake()->imageUrl
//        ]);
//
//        $comment = Comment::first();
//        $comment->likedByProfiles()->attach(1);
//        $comment->image()->create([
//            'path' => fake()->imageUrl]);
//        dd($comment->image->toArray());

        //$profile = Profile::find(3);
//        //dd($profile->likedPosts->toArray());
//        dd($profile->likedComments->toArray());

        //$profile->update(['name'=>'проверкаkkk5аа6uu5']);
        //$profile->delete();
//        $nums = [3,2,4];
//        $target = 9;
//
//        $array_length = count($nums);
//        $result = [];
//        for ($i = 0; $i < $array_length; $i++){
//            for ($j = 0; $j < $array_length; $j++) {
//                if ($i == $j) continue;
//                //echo $nums[$i] , $nums[$j];
//                if ($nums[$i] + $nums[$j] == $target){
//                    $result = [$i, $j];
//                    echo $result ;
//                }
//
//            }
//        }
//        $post = Post::find(1);
//        dd($post->likedByProfiles->toArray());

        $post = Post::find(92);
        dd($post->comments->count());

        dd($post->liked_by_profiles_count);

        $comment = Comment::first();
        Mail::to('amyumangulov@inbox.ru')->send(new StoredCommentMail($comment));
        dd(111111111111);

        $profile = Profile::find(1);

        $post = $profile->posts();
        dd($post);
        Post::factory(10)
            ->has(Comment::factory()
                ->count(3),'comments')
            ->create();

        dd(1);

        $post = Post::whereNull('profile_id')->update(['profile_id' => 1]);
        dd($post);
        $queries[] = [
            'sql' => 'select * from "posts" where "posts"."deleted_at" is null',
            'bindings' => '$query->bindings',
            'time' => 1,
        ];
        $queries[] = [
            'sql' => 'insert into "logs" ("model_name", "event_name", "old_attribute", "new_attribute", "updated_at", "created_at") values (?, ?, ?, ?, ?, ?) returning "id"',
            'bindings' => '$query->bindings',
            'time' => 2,
        ];

        $queries[] = [
            'sql' => 'insert into "logs" ("model_name", "event_name", "old_attribute", "new_attribute", "updated_at", "created_at") values (?, ?, ?, ?, ?, ?) returning "id"',
            'bindings' => '$query->bindings',
            'time' => 2,
        ];

        $sqlCommands = [
            'insert' => 0,
            'select' => 0,
            'update' => 0,
            'delete' => 0,
        ];

        foreach ($queries as $query) {
            $spacePos = strpos($query['sql'], ' ');
            $firstWord = substr($query['sql'], 0, $spacePos);
            foreach ($sqlCommands as $key => $value) {
                if (str_contains($firstWord, $key)) {
                    $sqlCommands[$key] = $value + 1;
                    $dbLog = DbLogs::firstOrNew(['user_id' =>  1]);
                }
            }
        }
        foreach ($sqlCommands as $key => $value) {
            if ($value > 0) {
                $data = [
                    'user_id' => 1,
                    'query_count' => $value,
                    'status' => '$next($request)->status()',
                    'time' => 1,
                    'message' => $key,
                    'route' => '$request->uri',
                ];
                $dbLog = DbLogs::create($data);
            }
        }

        //$dbLog = DbLogs::create($data);
        dd($dbLog);


        DB::table('db_logs')->delete();
        dd(11);
        $data = [
            'user_id' => 1,
            'query_count' => 1,
            'status' => '$next($request)->status()',
            'time' => now(),
            'message' => '$next($request)->exception->getMessage()',
            'route' => '$request->uri',
        ];
        $dbLog = DbLogs::create($data);
        dd($dbLog);
        $postQuery = Post::has('comments', '>=', 3)->get();
        dd($postQuery);
        $postQuery = Post::has('likedByProfiles', '=', 0)->get()->toArray();
        dd($postQuery);
//        $postQuery->whereHas('likeables', function ($q) use ($value) {
//            $q->where('title', 'ilike', "%$value%");
//        });
        $postQuery->withCount('likedByProfiles');
        dd($postQuery->where('liked_by_profiles_count', '=', 0)->get());


    }
}
