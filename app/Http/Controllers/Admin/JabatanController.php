<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //panggil library validator
use App\Models\jabatan; //panggil model jabatan
use Illuminate\Support\Facades\DB;
use App\Models\Log;


class JabatanController extends Controller
{
    //Tambah Data Jabatan
    public function create_jabatan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_jbt' => 'required',
            'formasi_jbt' => 'required',
        ]);
        if ($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }
        $jabatan = $validator->validated();
        $jabatan = jabatan::create([
            'kode_jbt' => $jabatan['kode_jbt'],
            'formasi_jbt' => $jabatan['formasi_jbt'],
        ]);

        return response()->json([
            "data" => [
                'msg' => "Jabatan berhasil ditambahkan",
                'kode_jbt' => $jabatan['kode_jbt'],
                'formasi_jbt' => $jabatan['formasi_jbt'],
            ]
        ], 200);
    }

    //Update Data Jabatan
    public function update_jabatan(Request $request, $id_tmja)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'kode_jbt' => 'required',
            'formasi_jbt' => 'required',
        ], [
            'kode_jbt.required' => 'Kode jabatan harus diisi.',
            'formasi_jbt.required' => 'Formasi jabatan harus diisi.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return response()->json(['errors' => $errors], 400);
        }

        $validatedData = $validator->validated();

        // Retrieve the resource by the id_tmja column
        $jabatan = DB::table('tb_m_jabatan')
            ->where('id_tmja', $id_tmja)
            ->update($validatedData);
        //dd($jabatan);

        Log::create([
            'module' => 'Sunting-Jbt',
            'action' => 'Sunting Jabatan',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$jabatan) {
            return response()->json(['message' => 'jabatan dengan id ' . $id_tmja . ', tidak ditemukan'], 404);
        } else {
            return response()->json([
                "data" => [
                    'msg' => "Jabatan berhasil dirubah",
                    'kode_jbt' => $validatedData['kode_jbt'],
                    'formasi_jbt' => $validatedData['formasi_jbt'],
                ]
            ]);
        }
    }

    //Delete Data Jabatan
    public function delete_jabatan($id_tmja)
    {
        $jabatan = DB::table('tb_m_jabatan')
            ->where('id_tmja', $id_tmja)
            ->delete();
        //dd($jabatan);

        Log::create([
            'module' => 'delete-Jbt',
            'action' => 'delete Jabatan',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$jabatan) {
            return response()->json([
                "data" => [
                    'msg' => 'jabatan dengan id ' . $id_tmja . ', tidak ditemukan'
                ]
            ], 422);
        } else {
            return response()->json([
                "data" => [
                    'msg' => 'jabatan dengan id ' . $id_tmja . ', berhasil dihapus'
                ]
            ], 200);
        };
    }

    //Show Data Jabatan
    public function show_jabatan()
    {
        //$jabatan = jabatan::where('kode_jbt', 'formasi_jbt')->get();
        $jabatan = DB::table('tb_m_jabatan')->get();
        //$jabatan = Jabatan::all();

        return response()->json([
            "data" => [
                'msg' => "Data Jabatan",
                'data' => $jabatan
            ]
        ], 200);
    }
}
