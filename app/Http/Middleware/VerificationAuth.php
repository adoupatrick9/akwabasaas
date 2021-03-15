<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\AuthentificationController;

class VerificationAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = new AuthentificationController();
        $res = $auth->VerificationAuthentification($request);

        
        if ($res == false) {
            return redirect('/login');
        }

        return $next($request);
          
    }
}
