<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckConstruction
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
        if(Session::get('construction') == '') {
            $this->addFlash('Você deve selecionar uma obra antes!', 'info');
            return redirect('home');
        }

        return $next($request);
    }

    public function addFlash($message, $status = 'info')
    {
        Session::flash('flash-message', $message);
        Session::flash('flash-alert', $status);
    }
}
