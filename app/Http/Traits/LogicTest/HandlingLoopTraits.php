<?php

namespace App\Http\Traits\LogicTest;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait HandlingLoopTraits
{
    public function runnsLoop($param_input_loop)
    {
        $result = [];
        for ($i = 1; $i <= $param_input_loop; $i++) {
            if ($i % 4 == 0 && $i % 14 == 0) {
                $result[] = "<b style=color:red;>" . "Unictive Media" . "</b>";
            } elseif ($i % 4 == 0) {
                $result[] = "<b style=color:blue;>" . "Unictive" . "</b>";
            } else {
                $result[] = "<b>" . $i . "</b>";
            }
        }
        return response()->json($result);
    }
}
