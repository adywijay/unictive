<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Hobby as Hb;

trait TestingTraits
{
    public function addHobby($pram_insert)
    {
        $input_event = Hb::create($pram_insert->all());
        if ($input_event == true) {
            return response()->json([
                'status' => true,
                'respon_code' => Response::HTTP_CREATED,
                'message' => 'Data has been successfully added'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon_code' => Response::HTTP_NO_CONTENT,
                'message' => 'Data has been unsuccessfull added.!'
            ]);
        }
    }
}
