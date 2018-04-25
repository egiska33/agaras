<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UploadFileRequest;
use App\File as FileModel;
use File;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uploads.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadFileRequest $request)
    {
        $file = $request->file('file');

        $file->move(FileModel::GLOBAL_FILE_DEST, FileModel::GLOBAL_FILE_NAME);
        
        return redirect('uploads/files')->with('flash_message_success', trans('adminlte_lang::message.successfullyAdded') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        File::delete(FileModel::GLOBAL_FILE_PATH);

        return redirect('uploads/files')->with('flash_message_success', trans('adminlte_lang::message.successfullyDeleted') );
    }
}
