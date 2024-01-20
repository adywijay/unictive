<?php

namespace App\Http\Traits\LogicTest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait OutJson
{
    public function resJson($param_output): JsonResponse
    {
        return response()->json([
            'status' => $param_output['status'],
            'code' => $param_output['code'],
            'msg' => $param_output['msg']
        ]);
    }
}
