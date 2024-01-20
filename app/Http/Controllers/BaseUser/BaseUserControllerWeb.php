<?php

namespace App\Http\Controllers\BaseUser;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogicTest\HandlingLoopTraits;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Hobby as Hb;
use App\Models\Member as Mm;

class BaseUserControllerWeb extends Controller
{
    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function Logic from call All Traits                          |
     *                                                                               |
     * ==============================================================================+
     */
    use HandlingLoopTraits;

    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function Logic from call Construct                           |
     *                                                                               |
     * ==============================================================================+
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_login');
    }

    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function Logic from call All views                           |
     *                                                                               |
     * ==============================================================================+
     */
    public function index()
    {
        return view('guest.extend.welcome', ['capt' => 'Dashboard | User']);
    }

    public function tesLogic()
    {
        return view('guest.extend.tes_logic_view', ['capt' => 'View Logic Test | User']);
    }

    public function addHobby()
    {
        return view('guest.extend.hobby_view', ['capt' => 'View | Hobby']);
    }

    public function addMember()
    {
        return view('guest.extend.member_view', ['capt' => 'View | Member']);
    }



    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function call bussiness Logic Action Create  { C }           |
     *                                                                               |
     * ==============================================================================+
     */
    public function doRunnLoop(Request $req)
    {
        $this->validate($req, [
            'total_loop' => 'required', 'numeric'
        ]);
        return $this->runnsLoop($req->total_loop);
    }

    public function doActionInsertHobby(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'hobby_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        try {
            $input_event = Hb::create($req->all());
            if ($input_event == true) {
                return response()->json([
                    'status' => true,
                    'code' => Response::HTTP_CREATED,
                    'msg' => 'Data has been successfully added'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => Response::HTTP_NO_CONTENT,
                    'msg' => 'Data has been unsuccessfull added.!'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function doActionInsertMember(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama'  => 'required|max:50',
            'email' => ['required', 'email', Rule::unique('members', 'email')],
            'phone' => 'required|max:13|min:12',
            'hobby' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'success' => false,
                'msg' => $validator->errors()
            ]);
        }
        try {
            $input_event = Mm::create($req->all());
            if ($input_event == true) {
                return response()->json([
                    'status' => true,
                    'code' => Response::HTTP_CREATED,
                    'msg' => 'Data has been successfully added'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => Response::HTTP_NO_CONTENT,
                    'msg' => 'Data has been unsuccessfull added.!'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function call bussiness Logic Action Read or Retrive  { R }  |
     *                                                                               |
     * ==============================================================================+
     */
    public function checkExixstEmail(Request $req)
    {
        $user = Mm::where('email', $req->email)->first();
        if ($user) {
            return response()->json(['status' => 'email address already exists.!']);
        } else {
            return response()->json(['status' => '']);
        }
    }

    public function getListHobby()
    {
        $run_query = Hb::select('id', 'hobby_name')
            ->orderBy('id', 'asc')->get();
        return response()->json($run_query);
    }


    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function call bussiness Logic Action Update  { U }           |
     *                                                                               |
     * ==============================================================================+
     */

    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function call bussiness Logic Action Delete  { D }           |
     *                                                                               |
     * ==============================================================================+
     */


    /**
     * ==============================================================================+
     *                                                                               |
     *                  Function call Another bussiness Logic                        |
     *                                                                               |
     * ==============================================================================+
     */
}
