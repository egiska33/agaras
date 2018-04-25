<?php

namespace App\Http\Controllers;

use App\Manager;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateManagerRequest;

class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = User::role('manager')->get();
        return view('managers.managers', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('managers.managerCreate');
    }


    /**
     * @param CreateManagerRequest $request
     * @return mixed
     */
    public function store(CreateManagerRequest $request)
    {
        $fields = [
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone'    => $request->input('phone'),
            'plate'    => $request->input('plate'),
            'position' => $request->input('position')
        ];

        $manager = User::create($fields);
        $manager->assignRole('manager');

        return redirect('managers')->with('flash_message_success', 'Įrašas sėkmingai pridėtas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(User $manager)
    {
        return view('managers.managerEdit', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $manager)
    {
        $manager->update($request->toArray());
        return redirect('managers')->with('flash_message_success', trans('adminlte_lang::message.updated'));   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manager)
    {
        if($manager->id != 1) {
            $manager->delete();
        }

        return redirect('managers')->with('flash_message_success', trans('adminlte_lang::message.deleted'));
    }
}
