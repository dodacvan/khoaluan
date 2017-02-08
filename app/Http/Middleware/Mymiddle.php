<?php namespace App\Http\Middleware;

use Closure;

class Mymiddle {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if($request->has('id'))
			echo 'a';
		else
		return $next($request);
	}

}
