<?php

namespace App\Http\Traits\Hobby;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Hobby as Hb;

trait HobbyCRUDTraits
{


    public function getByIdHobby($id)
    {
        $get_id = Hb::find($id);
        return response()->json($get_id);
    }

    public function updateHobby($req_id, $req_all): JsonResponse
    {
        $fromid = Hb::find($req_id);
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
        $cek_data = Hb::select('*')->where('id', $id)->get();
        if ($cek_data->count() <= 0) {
            return response()->json([
                'respon code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data not found.!'
            ]);
        } else {
            $running_hapus = Hb::destroy($id);

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
