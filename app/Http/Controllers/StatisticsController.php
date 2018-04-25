<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\User;
use App\Route;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
    	$drivers = User::role('driver')->get();

    	$routes = Route::select();

        if(!empty($request->get('date'))) {
            $routes = $routes->where('pick_up_time', 'LIKE', $request->input('date') . '%');
        }
     
        if(!empty($request->get('driver'))) {
        	$routes = $routes->where('user_id', '=', $request->input('driver'));
        }

        $routes = $routes->orderBy('pick_up_time', 'desc')->paginate(10);
        $routes->appends($request->all());

    	return view('statistics.driversStatistics', compact('drivers', 'routes'));
    }
}
