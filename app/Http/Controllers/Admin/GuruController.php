<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; //panggil library validator
use App\Models\guru; //panggil model jabatan
use App\Models\Log;

class GuruController extends Controller
{
    //Tambah Data guru
    public function create_guru(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nip' => 'required|unique:tb_m_guru',
            'nama_guru' => 'required',
            'email_guru' => 'required|email|unique:tb_m_guru',
            'ttl_guru' => 'required',
            'gender_guru' => 'required',
            'notelp_guru' => 'required',
            'alamat_guru' => 'required',
            'status_guru' => 'required',
            'id_tmja' => 'required|exists:tb_m_jabatan,id_tmja',
            'id_tmm' => 'required|exists:tb_m_mapel,id_tmm',
            'id_tmu' => 'required|unique:tb_m_guru|exists:tb_m_user,id_tmu'
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'exists' => 'ID User tidak ditemukan.'
        ]);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->first()
            ], 400);
        }

        // Mendapatkan data yang telah divalidasi
        $guru = $validator->validated();

        // Membuat sebuah instansi baru dari model "guru" dan menyimpannya ke dalam database
        $guru = guru::create([
            'nip' => $guru['nip'],
            'nama_guru' => $guru['nama_guru'],
            'email_guru' => $guru['email_guru'],
            'ttl_guru' => $guru['ttl_guru'],
            'gender_guru' => $guru['gender_guru'],
            'notelp_guru' => $guru['notelp_guru'],
            'alamat_guru' => $guru['alamat_guru'],
            'status_guru' => $guru['status_guru'],
            'id_tmja' => $guru['id_tmja'],
            'id_tmm' => $guru['id_tmm'],
            'id_tmu' => $guru['id_tmu']
        ]);

        // Mengembalikan respons JSON dengan pesan sukses dan data guru yang telah dibuat
        return response()->json([
            "data" => [
                'msg' => "Biodata Guru berhasil ditambahkan",
                'nip' => $guru['nip'],
                'nama_guru' => $guru['nama_guru'],
                'email_guru' => $guru['email_guru'],
            ]
        ], 200);
    }

    //Update Data Guru
    public function update_guru(Request $request, $id_tmg)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama_guru' => 'required',
            'email_guru' => 'required|email',
            'ttl_guru' => 'required',
            'gender_guru' => 'required',
            'notelp_guru' => '',
            'alamat_guru' => 'required',
            'status_guru' => 'required',
            'id_tmja' => 'required|exists:tb_m_jabatan,id_tmja',
            'id_tmm' => 'required|exists:tb_m_mapel,id_tmm',
            'id_tmu' => 'required|exists:tb_m_user,id_tmu'
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'exists' => 'ID User tidak ditemukan.'
        ]);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->first()
            ], 400);
        }

        // Mendapatkan data yang telah divalidasi
        $guru = $validator->validated();

        // Retrieve the resource by the id_tmg column
        $guru = DB::table('tb_m_guru')
            ->where('id_tmg', $id_tmg)
            ->update($guru);
        //dd($guru);

        Log::create([
            'module' => 'Sunting-DG',
            'action' => 'Sunting Data Guru',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$guru) {
            return response()->json(['message' => 'Data guru dengan id ' . $id_tmg . ', tidak ditemukan'], 404);
        } else {
            return response()->json([
                "data" => [
                    'msg' => "Data Guru berhasil diupdate",
                    'nama_guru' => $guru['nama_guru'],
                ]
            ]);
        }
    }

    //Delete Data Guru
    public function delete_guru($id_tmg)
    {
        $guru = DB::table('tb_m_guru')
            ->where('id_tmg', $id_tmg)
            ->delete();
        //dd($jabatan);

        Log::create([
            'module' => 'delete-DG',
            'action' => 'delete Data Guru',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$guru) {
            return response()->json([
                "data" => [
                    'msg' => 'Data guru dengan id ' . $id_tmg . ', tidak ditemukan'
                ]
            ], 422);
        } else {
            return response()->json([
                "data" => [
                    'msg' => 'Data guru dengan id ' . $id_tmg . ', berhasil dihapus'
                ]
            ], 200);
        };
    }

    //Show Data Guru
    public function show_guru()
    {
        $guru = DB::table('tb_m_guru')->get();

        return response()->json([
            "data" => [
                'msg' => "Data Guru",
                'data' => $guru
            ]
        ], 200);
    }
}
