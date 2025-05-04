<?php

namespace App\Http\Middleware;

use App\Models\DbLogs;
use Closure;
use http\Exception;
use http\Message;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LogMiddleware
{
    protected $queries = [];
    protected $sqlCommands = [
        'insert' => 0,
        'select' => 0,
        'update' => 0,
        'delete' => 0,
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

//        Log::info($request->uri());
        DB::listen(function ($query) use ($request, $next) {
            $this->queries[] = [
                'sql' => $query->sql,
                'bindings' => $query->bindings,
                'time' => $query->time,
                //'status' => $next($request)->status()
            ];

        });


        $this->logQueries($request, $next);

        return $next($request);
    }

    protected function logQueries($request, $next)
    {

        $response = $next($request);

        try {
            $message = $response->exception->getMessage();
        } catch (Throwable $e) {
            Log::info('Caught exception: ' . $e->getMessage());
            $message = 'ok';
        }

//        foreach ($this->sqlCommands as $key => $value) {
//             DbLogs::create([
//                'user_id' => Auth::user()->id,
//                'query_count' => 0,
//                'status' => $next($request)->status(),
//                'message' => $message,
//                'route' => $request->uri(),
//                'time' => 0,
//                'operation' => $key,
//            ]);
//        }
//
//        foreach ($this->queries as $query) {
//            $spacePos = strpos($query['sql'], ' ');
//            $firstWord = substr($query['sql'], 0, $spacePos);
//            foreach ($this->sqlCommands as $key => $value) {
//                if (str_contains($firstWord, $key)) {
//                    $dbLog = DbLogs::where('operation', '=', $key)->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();
//                    $dbLog->update([
//                                    'time'=> $dbLog->time + $query['time'],
//                                    'query_count'=> $dbLog-> query_count + 1 ,
//                                        ]);
//                    $dbLog->dbQuery()->create(['query' => $query['sql']]);
//
//                }
//            }
//        }

        foreach ($this->sqlCommands as $key => $value) {
            DbLogs::create([
                'user_id' => Auth::user()->id,
                'query_count' => 0,
                'status' => $response->status(),
                'message' => $message,
                'route' => $request->uri(),
                'time' => 0,
                'operation' => $key,
            ]);
        }

        foreach ($this->queries as $query) {
            $spacePos = strpos($query['sql'], ' ');
            $firstWord = substr($query['sql'], 0, $spacePos);
            foreach ($this->sqlCommands as $key => $value) {
                if (str_contains($firstWord, $key)) {
                    $dbLog = DbLogs::where('operation', '=', $key)->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();
                    $dbLog->update([
                        'time'=> $dbLog->time + $query['time'],
                        'query_count'=> $dbLog-> query_count + 1 ,
                    ]);
                    $dbLog->dbQuery()->create(['query' => $query['sql']]);

                }
            }
        }

        DbLogs::where('query_count', 0)->delete();

    }
}
