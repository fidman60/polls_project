<?php

namespace App\Providers\Poll;

use Illuminate\Support\ServiceProvider;

class PollProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        $this->app->bind('poll_repository',function (){
            return new \App\Repositories\PollRepositoryImpl(new \App\Models\Poll());
        });
    }
}
