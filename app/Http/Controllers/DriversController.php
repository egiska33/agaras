<?php

namespace App\Http\Controllers;

use App\DocumentsSerials;
use App\Driver;
use App\User;
use App\Http\Requests\CreateDriverRequest;
use http\Env\Request;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::role('driver')->get();

        return view('drivers.drivers', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.driverCreate');
    }

    /**
     * Store the specified resource in storage..
     *
     * @param CreateDriverRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDriverRequest $request)
    {
        $data = $request->toArray();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->assignRole('driver');
        $data['user_id'] = $user->id;
        DocumentsSerials::create($data);

        return redirect('drivers')->with('flash_message_success', trans('adminlte_lang::message.user_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        if (! User::isDriver($driver->id) ) {
            return redirect('drivers')->with('flash_message_error', trans('adminlte_lang::message.isNotDriverError'));
        }

        return view('drivers.driverEdit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateDriverRequest $request
     * @param  \App\Driver $driver
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDriverRequest $request, Driver $driver)
    {
        $data = $request->toArray();

        $driver->update($data);
        $driver->serials->update($request->all());

        return redirect('drivers')->with('flash_message_success', trans('adminlte_lang::message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver $driver
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Driver $driver)
    {
        if($driver->id != 1) {
            foreach ($driver->routes as $route) {
                $route->delete();
            }
            $driver->serials->delete();
            $driver->delete();
        }

        return redirect('drivers')->with('flash_message_success', trans('adminlte_lang::message.deleted'));
    }

    /**
     * @param Request $request
     * @param Driver $driver
     */
    public function updateCar(Request $request, Driver $driver)
    {
        $data = $request->toArray();

        $driver->update($data);

    }
}
