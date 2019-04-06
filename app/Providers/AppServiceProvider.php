<?php

namespace App\Providers;

use App\Code;
use App\PM;
use App\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('code',Code::class);
        app()->bind('pm',PM::class);
        app()->bind('user',User::class );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('top_share_users',function () {

            $users = app('user')->where('code_count','>',0)->orderBy('code_count','DESC')->get();
            $html = '<ul style="list-style-type: square">';
            foreach ($users as $user) {
                $html .= '<li><a class="text-success" href="' . route('user_info',['id' => $user->id]) . '">' . $user->name . '</a> (' . $user->code_count . ')</li>';
            }
            $html .= '</u>';
            return $html;
        });
    }
}
