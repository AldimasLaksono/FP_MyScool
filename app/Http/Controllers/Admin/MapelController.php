<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; //panggil library validator
use App\Models\mapel; //panggil model mapel
use App\Models\Log;

class MapelController extends Controller
{
    //Tambah Data Mapel
    public function create_mapel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required',
            'mapel' => 'required',
        ],[
            'required' => 'Kolom :attribute harus diisi.'
        ]);
        if ($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }
        $mapel = $validator->validated();
        $mapel = mapel::create([
            'kode_mapel' => $mapel['kode_mapel'],
            'mapel' => $mapel['mapel'],
        ]);

        return response()->json([
            "data" => [
                'msg' => "Data Mapel berhasil ditambahkan",
                'kode_mapel' => $mapel['kode_mapel'],
                'mapel' => $mapel['mapel'],
            ]
        ], 200);
    }

    //Update Data Mapel
    public function update_mapel(Request $request, $id_tmm)
    {

        $validator = Validator::make($request->all(), [
            'kode_mapel' => 'required',
            'mapel' => 'required',
        ], [
            'kode_mapel.required' => 'Kode Mapel harus diisi.',
            'mapel.required' => 'Nama Mapel harus diisi.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return response()->json(['errors' => $errors], 400);
        }

        $data = $validator->validated();

        // Retrieve the resource by the id_tmja column
        $mapel = DB::table('tb_m_mapel')
            ->where('id_tmm', $id_tmm)
            ->update($data);
        //dd($mapel);

        Log::create([
            'module' => 'Sunting-MP',
            'action' => 'Sunting Mapel',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$mapel) {
            return response()->json(['message' => 'Mapel dengan id ' . $id_tmm . ', tidak ditemukan'], 404);
        } else {
            return response()->json([
                "data" => [
                    'msg' => "Mapel berhasil diupdate",
                    'kode_mapel' => $data['kode_mapel'],
                    'mapel' => $data['mapel'],
                ]
            ]);
        }
    }

    //Delete Data Mapel
    public function delete_mapel($id_tmm)
    {
        $mapel = DB::table('tb_m_mapel')
            ->where('id_tmm', $id_tmm)
            ->delete();
        //dd($jabatan);

        Log::create([
            'module' => 'delete-MP',
            'action' => 'delete Mapel',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$mapel) {
            return response()->json([
                "data" => [
                    'msg' => 'Mapel dengan id ' . $id_tmm . ', tidak ditemukan'
                ]
            ], 422);
        } else {
            return response()->json([
                "data" => [
                    'msg' => 'Mapel dengan id ' . $id_tmm . ', berhasil dihapus'
                ]
            ], 200);
        };
    }

    //Show Data Mapel
    public function show_mapel()
    {
        $mapel = DB::table('tb_m_mapel')->get();

        return response()->json([
            "data" => [
                'msg' => "Data Mapel",
                'data' => $mapel
            ]
        ], 200);
    }
}
