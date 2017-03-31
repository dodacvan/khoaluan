<?php namespace App\Http\Middleware;

use Closure;
use App\Thoigian;
use Carbon\Carbon;

class CheckTime {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$thoigian = Thoigian::find(1);
		$mytime = Carbon::now();
		if($thoigian->thoigianbatdau < $mytime && $mytime < $thoigian->thoigianketthuc){
			return $next($request);
		}
		return redirect()->back()->with(['timeout'=>"het han dang ki"]);
	}

}
