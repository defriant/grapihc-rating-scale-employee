<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function karyawan()
    {
        return view('karyawan');
    }

    public function getKaryawan()
    {
        $data = Karyawan::all();
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    public function addKaryawan(Request $request)
    {
        $check = Karyawan::where('nip', $request->nip)->first();
        if ($check) return response()->json(['error' => true, 'message' => "NIP $request->nip sudah terdaftar !"]);

        Karyawan::create($request->all());
        return response()->json([
            'error' => false,
            'message' => 'Data karyawan berhasil ditambahkan'
        ]);
    }

    public function updateKaryawan(Request $request)
    {
        $data = Karyawan::find($request->id);

        $data->update([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'divisi' => $request->divisi
        ]);

        return response()->json([
            'error' => false,
            'message' => "Data karyawan $data->nip berhasil di edit"
        ]);
    }

    public function deleteKaryawan(Request $request)
    {
        $data = Karyawan::find($request->id);

        $data->delete();

        Penilaian::where('id_karyawan', $request->id)->delete();

        return response()->json([
            'error' => false,
            'message' => "Data karyawan $data->nip berhasil di hapus"
        ]);
    }

    public function checkNilai()
    {
        return view('check-nilai');
    }
}
