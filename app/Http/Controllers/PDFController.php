<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getHeader(Request $request)
    {
        $query = $request->all();
        return view('pdfTemplates.header',compact('query'));
    }
}
