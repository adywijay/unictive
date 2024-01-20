<?php

namespace App\Http\Controllers\Api\ContentCRUD;

use App\Http\Controllers\Controller;
use App\Http\Traits\Member\MemberCRUD;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class MemberController extends Controller
{
    use MemberCRUD;
    public function __construct()
    {
        $this->middleware('require_loginApi');
    }
    public function getsByIdMembers($id)
    {
        return $this->getByIdMember($id);
    }

    public function actionUpdateMember(Request $req)
    {
        $get_id = $req->id;
        $get_all = $req->all();
        return $this->updateMember($get_id, $get_all);
    }
}
