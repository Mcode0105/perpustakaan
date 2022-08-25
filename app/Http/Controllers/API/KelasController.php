<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KelasModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{

    public function showkelas()
    {
        $data = KelasModels::all();
        return response()->json([
            'data' => $data
        ]);
    }
    public function addkelas(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'kelas' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'message' => 'validate error',
                'error' => $validate->errors()
            ], 401);
        };

        $data = KelasModels::create([
            'kelas' => $request->kelas
        ]);
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    public function editkelas(Request $request)
    {
        $data = [
            'kelas' => $request->kelas
        ];
        KelasModels::where('id_kelas', $request->kelas)->update($data);
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function deletekelas(Request $request)
    {
        KelasModels::where('id_kelas', $request->id_kelas)->delete();
        return response()->json([
            'status' => true,
            'message' => 'data delete success'
        ], 200);
    }
}
