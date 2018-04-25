<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
	protected $request;

	protected $json;

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->json = $request->wantsJson();
	}

    public function responseView($template, $data)
    {
    	if ($this->json) {
    		return $this->responseJson($data);
    	}

    	return view($template, $data);
    }

    public function responseRedirect($route, $dataLabel, $data, $objects = [])
    {
        if ($this->json) {

            if (!empty($objects)) {
                return $this->responseJson($objects);
            }

            return $this->responseJson($this->mergeRecursive($data));
    	}

    	return redirect($route)->with($dataLabel, $data);
    }

    public function responseJson($data)
    {
    	return response()->json(['data' => $data], 200);
    }

    public function mergeRecursive($array)
    {
        $newArr = array();
        foreach ($array as $value) {
            $newArr = array_merge_recursive($newArr, $value);
        }
        return $newArr;
    }
}
