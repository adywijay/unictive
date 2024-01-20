<?php

namespace App\Http\Controllers\Api\ContentCRUD;

use App\Http\Controllers\Controller;
use App\Http\Traits\Hobby\HobbyCRUDTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class HobbyController extends Controller
{
    use HobbyCRUDTraits;
    public function __construct()
    {
        $this->middleware('require_loginApi');
    }
    public function getsByIdHobby($id)
    {
        return $this->getByIdHobby($id);
    }

    public function actionUpdateHobby(Request $req)
    {
        $get_id = $req->id;
        $get_all = $req->all();
        return $this->updateHobby($get_id, $get_all);
    }
}
