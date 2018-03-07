<?php

namespace App\Providers;

use App\User;
use Illuminate\Broadcasting\BroadcastManager;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(BroadcastManager $broadcastManager)
    {

//        if (Auth::attempt('auth')){
//            Broadcast::routes();   //admin
//        }else{
//            Broadcast::routes(['middleware' => ['web','auth:employee']]);   //employee
//        }

        Broadcast::routes();   //admin


        require base_path('routes/channels.php');
    }
}
