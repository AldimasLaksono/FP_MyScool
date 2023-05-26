<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; //panggil library validator
use App\Models\gedung; //panggil model gedung
use App\Models\Log;

class GedungController extends Controller
{
    //Tambah Data Gedung
    public function create_gedung(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gedung' => 'required',
        ]);
        if ($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }
        $gedung = $validator->validated();
        $gedung = gedung::create([
            'gedung' => $gedung['gedung'],
        ]);

        return response()->json([
            "data" => [
                'msg' => "Data Gedung berhasil ditambahkan",
                'gedung' => $gedung['gedung'],
            ]
        ], 200);
    }

    //Update Data Gedung
    public function update_gedung(Request $request, $id_tmge)
    {

        $validator = Validator::make($request->all(), [
            'gedung' => 'required',
        ], [
            'gedung.required' => 'Nama gedung harus diisi.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return response()->json(['errors' => $errors], 400);
        }

        $data = $validator->validated();
        //dd($data);

        // Retrieve the resource by the id_tmja column
        $gedung = DB::table('tb_m_gedung')
            ->where('id_tmge', $id_tmge)
            ->update($data);
        //dd($gedung);

        Log::create([
            'module' => 'Sunting-GD',
            'action' => 'Sunting Gedung',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$gedung) {
            return response()->json(['message' => 'Gedung dengan id ' . $id_tmge . ', tidak ditemukan'], 404);
        } else {
            return response()->json([
                "data" => [
                    'msg' => "Nama Gedung berhasil diupdate",
                    'gedung' => $data['gedung'],
                ]
            ]);
        }
    }

    //Delete Data Gedung
    public function delete_gedung($id_tmge)
    {
        $gedung = DB::table('tb_m_gedung')
            ->where('id_tmge', $id_tmge)
            ->delete();
        //dd($gedung);

        Log::create([
            'module' => 'delete-GD',
            'action' => 'Delete Gedung',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$gedung) {
            return response()->json([
                "data" => [
                    'msg' => 'Nama Gedung dengan id ' . $id_tmge . ', tidak ditemukan'
                ]
            ], 422);
        } else {
            return response()->json([
                "data" => [
                    'msg' => 'Nama Gedung dengan id ' . $id_tmge . ', berhasil dihapus'
                ]
            ], 200);
        };
    }

    //Show Data Gedung
    public function show_gedung()
    {
        $gedung = DB::table('tb_m_gedung')->get();

        return response()->json([
            "data" => [
                'msg' => "Data Gedung",
                'data' => $gedung
            ]
        ], 200);
    }
}
