<?php

namespace App\Http\Traits\Member;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Member as Mb;

trait MemberCRUD
{

    public function getByIdMember($id)
    {
        $get_id = Mb::find($id);
        return response()->json($get_id);
    }

    public function updateMember($req_id, $req_all): JsonResponse
    {
        $fromid = Mb::find($req_id);
        $inputan = $req_all;
        $jalankan = $fromid->update($inputan);
        if ($jalankan == true) {
            return response()->json([
                'status' => true,
                'respon code' => Response::HTTP_OK,
                'message' => 'Data has been successfully modify'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'respon code' => Response::HTTP_NOT_MODIFIED,
                'message' => 'Data failled modify'
            ]);
        }
    }

    public function delHobby($id): JsonResponse
    {
        $cek_data = Mb::select('*')->where('id', $id)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Mb::destroy($id);

            if ($running_hapus == true) {
                return response()->json([
                    'status' => 'success',
                    'respon code' => Response::HTTP_OK,
                    'message' => 'Data has been removed successfully.!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'respon code' => Response::HTTP_NOT_MODIFIED,
                    'message' => 'Data has unsuccessfull removed.!'
                ]);
            }
        }
    }
}
