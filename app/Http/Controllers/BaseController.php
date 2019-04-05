<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\User;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->resetViewData();
            return $next($request);
        });
    }

    public function resetViewData()
    {
        View()->share('unread_pm_count', app('App\PM')->where(['receiver_id' => Auth()->id(), 'is_read' => false])->count());
    }

}
