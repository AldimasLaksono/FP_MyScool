<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; //panggil library validator
use App\Models\ruang; //panggil model jabatan
use App\Models\Log;

class RuangController extends Controller
{
    //Tambah Data Ruangan
    public function create_ruang(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_ruang' => 'required',
            'kategori' => 'required',
            'id_tmge' => 'required|exists:tb_m_gedung,id_tmge'
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'exists' => 'ID Gedung tidak ditemukan.'
        ]);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return response()->json([
                "error" => $validator->errors()->first()
            ], 400);
        }

        // Mendapatkan data yang telah divalidasi
        $ruang = $validator->validated();

        // Membuat sebuah instansi baru dari model "ruang" dan menyimpannya ke dalam database
        $ruang = ruang::create([
            'nama_ruang' => $ruang['nama_ruang'],
            'kategori' => $ruang['kategori'],
            'id_tmge' => $ruang['id_tmge']
        ]);

        // Mengembalikan respons JSON dengan pesan sukses dan data ruangan yang telah dibuat
        return response()->json([
            "data" => [
                'msg' => "Data Ruangan berhasil ditambahkan",
                'Nama_ruangan' => $ruang['nama_ruang'],
                'kategori' => $ruang['kategori'],
                'Id_Gedung' => $ruang['id_tmge']
            ]
        ], 200);
    }

    //Update Data Ruangan
    public function update_ruang(Request $request, $id_tmr)
    {

        $validator = Validator::make($request->all(), [
            'nama_ruang' => 'required',
            'kategori' => 'required',
            'id_tmge' => 'required|exists:tb_m_gedung,id_tmge'
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'exists' => 'ID Gedung tidak ditemukan.'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages()->all();
            return response()->json(['errors' => $errors], 400);
        }

        $data = $validator->validated();
        //dd($data);

        // Retrieve the resource by the id_tmja column
        $ruang = DB::table('tb_m_ruang')
            ->where('id_tmr', $id_tmr)
            ->update($data);
        //dd($ruang);

        Log::create([
            'module' => 'Sunting-RG',
            'action' => 'Sunting Ruangan',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$ruang) {
            return response()->json(['message' => 'Ruangan dengan id ' . $id_tmr . ', tidak ditemukan'], 404);
        } else {
            return response()->json([
                "data" => [
                    'msg' => "Data ruangan berhasil diupdate",
                    'Nama_ruangan' => $data['nama_ruang'],
                    'Kategori' => $data['kategori'],
                    'Id_Gedung' => $data['id_tmge']
                ]
            ]);
        }
    }

    //Delete Data Ruangan
    public function delete_ruang($id_tmr)
    {
        $ruang = DB::table('tb_m_ruang')
            ->where('id_tmr', $id_tmr)
            ->delete();
        //dd($ruang);

        Log::create([
            'module' => 'delete-RG',
            'action' => 'delete Ruangan',
            'useraccess' => 'Administrator'
        ]);

        // Check if the resource exists
        if (!$ruang) {
            return response()->json([
                "data" => [
                    'msg' => 'Nama Ruangan dengan id ' . $id_tmr . ', tidak ditemukan'
                ]
            ], 422);
        } else {
            return response()->json([
                "data" => [
                    'msg' => 'Nama Ruangan dengan id ' . $id_tmr . ', berhasil dihapus'
                ]
            ], 200);
        };
    }

    //Show Data Gedung
    public function show_ruang()
    {
        $ruang = DB::table('tb_m_ruang')
            ->join('tb_m_gedung', 'tb_m_ruang.id_tmge', '=', 'tb_m_gedung.id_tmge')
            ->select('tb_m_ruang.id_tmr', 'tb_m_ruang.nama_ruang','tb_m_ruang.kategori', 'tb_m_gedung.gedung')
            ->get();;

        return response()->json([
            "data" => [
                'msg' => "Data Ruangan",
                'data' => $ruang
            ]
        ], 200);
    }
}
