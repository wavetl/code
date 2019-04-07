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
        app()->bind('code', Code::class);
        app()->bind('pm', PM::class);
        app()->bind('user', User::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('top_share_users', function () {

            $users = app('user')->where('code_count', '>', 0)->orderBy('code_count', 'DESC')->get();
            $html = '<ul class="pl-0 list-unstyled">';
            foreach ($users as $user) {
                $html .= '<li><i class="fa fa-user mr-2"></i> <a class="text-success" href="' . route('user_info', ['id' => $user->id]) . '">' . $user->name . '</a> (' . $user->code_count . ')</li>';
            }
            $html .= '</u>';
            return $html;
        });

        app('cache')->get('total_users', function () {
            $count = app('user')->count();
            app('cache')->set('total_users', $count, 86400);
            return $count;
        });

        app('cache')->get('total_shares', function () {
            $count = app('code')->count();
            app('cache')->set('total_shares', $count, 86400);
            return $count;
        });
    }
}
