<?php

namespace App\Http\Controllers\api\user;


trait apiResponse
{
    public function apiResponse($data=null, $message='')
    {
        $status = 200;
        $array = [
            'success' => true,
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ];
        return response($array);
    }

    public function sendError($error)
    {
        $code = 404;
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        return response()->json($response, $code);
    }
}
