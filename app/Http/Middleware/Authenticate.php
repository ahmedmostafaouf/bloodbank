<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Request;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //هنا انا لو مش ادمن وكتب مثلا صفخهع admin/category هيوديني ع اللوجن عشان اسجل غير كده هيوديني علي ادمن بتاعت اليوزر
        if (!$request->expectsJson()) {
            if (Request::is('admin/*'))
                return route('admin.login');
            else
                return route('get.front.login'); // user
        }

    }
}
