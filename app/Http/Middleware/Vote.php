<?php

namespace App\Http\Middleware;

use Closure;
use PollRepo;

class Vote {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        $pollId = (int)$request->route('poll');

        if ($pollId > 0 && !PollRepo::polledByAnyOne($pollId))
            return $next($request);

        return redirect('poll')->with('info',"Désolé, vous ne pouvez pas modifier ce sondage");
    }

}
