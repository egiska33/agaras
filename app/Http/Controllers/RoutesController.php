<?php

namespace App\Http\Controllers;

use App\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\User;
use App\File;
use App\Http\Requests\CreateRouteRequest;
use Carbon\Carbon;

class RoutesController extends ResponseController
{
    protected $destinationPathFiles = 'uploads';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->hasAnyRole(['superadmin', 'manager'])) {
            $routes = Route::select();

            if(!empty($request->get('search'))) {
            $routes = Route::where('name', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('seller_address', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('pick_up_time', 'LIKE', '%'. $request->input('search') .'%')
                            ->orWhere('phone', 'LIKE', '%'. $request->input('search') .'%');
            }

            if(!empty($request->get('date'))) {
                if($request->get('week')) {
                    $routes = Route::whereBetween('pick_up_time', array(Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')));
                } else {
                    $routes = Route::where('pick_up_time', 'LIKE', $request->input('date') . '%');
                }
            }

            $routes = $routes->orderBy('pick_up_time', 'desc')->paginate(10);
            $routes->appends($request->all());

            return view('routes.routesAdmin', compact('routes'));
        }

        $routes = Route::where('user_id', Auth::user()->id)->with('file')->get();

        $markers = array();
        foreach ($routes as $route) {
            $markers[] = $route->seller_address;
        }
        $markers = array_unique($markers);

        return $this->responseView('routes.routesDriver', compact('routes', 'markers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $drivers = User::role('driver')->get();
        return view('routes.routeCreate', compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRouteRequest $request)
    {
        $id = Route::create(array_merge($request->toArray(), [
            'seller_address' => $request->input('seller_address_1').' '.$request->input('seller_address_2').' '.$request->input('seller_address_3')
        ]))->id;

        if($request->hasFile('file')) {

            $file = $request->file('file');

            $fileName = trans('adminlte_lang::message.file') . '-' . \Carbon\Carbon::now()->format('Y-m-d-h-i-s') . '.' . $file->getClientOriginalExtension();

            $file->move($this->destinationPathFiles, $fileName);

            File::create([
                'route_id'  => $id,
                'filename'  => $fileName
            ]);
        }
        return redirect('routes')->with('flash_message_success', 'Įrašas sėkmingai pridėtas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        $drivers = User::role('driver')->get();

        return view('routes.routeEdit', compact('route', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRouteRequest $request, Route $route)
    {
        $route->update($request->all());

        if($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = trans('adminlte_lang::message.file') . '-' . \Carbon\Carbon::now()->format('Y-m-d-H-i-s') . '.' . $file->getClientOriginalExtension();

            if($route->file()->exists()) {
                $oldFile = $route->file;
                unlink($this->destinationPathFiles . '/' . $oldFile->filename);
                $oldFile->filename = $fileName;
                $oldFile->save();
            } else {
                File::create([
                    'route_id'  => $route->id,
                    'filename'  => $fileName
                ]);
            }

            $file->move($this->destinationPathFiles, $fileName);
        }

        return redirect('routes')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        $id = $route->id;
        $file = $route->file;

        if(!empty($file)) {
            unlink($this->destinationPathFiles . '/' . $file->filename);
            $file->delete();
        }

        $route->delete();

        return redirect('routes')->with('flash_message_success', trans('adminlte_lang::message.deleted'));
    }

    public function updateComment(Request $request)
    {
        $route = Route::find($request->input('id'));
        $route->comment = $request->input('comment');

        $route->save();

        return redirect('routes')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }
}
