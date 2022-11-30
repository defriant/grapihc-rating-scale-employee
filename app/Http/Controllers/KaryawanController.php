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
        return view('check-nilai', ['kriteria' => $this->kriteria]);
    }

    public function checkNilaiGet(Request $request)
    {
        $karyawan = Karyawan::where('nip', $request->nip)->first();

        if (!$karyawan) return response()->json([
            'error' => true,
            'message' => 'Data karyawan tidak ditemukan !'
        ]);

        $n_kriteria = [];
        $n_total = 0;

        foreach ($this->kriteria as $kriteria) {
            $nilai = $karyawan->penilaian()->where('periode', $request->periode)->where('kriteria', $kriteria['key'])->first();

            $n_kriteria[] = [
                'key' => $kriteria['key'],
                'label' => $kriteria['label'],
                'nilai' => $nilai ? (int) $nilai->nilai : '-'
            ];

            if ($nilai) {
                $n_total += $nilai->nilai;
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Data penilaian belum dibuat !'
                ]);
            }
        }

        $n_total = $n_total / count($this->kriteria);

        $data = [
            'id' => $karyawan->id,
            'nip' => $karyawan->nip,
            'nama' => $karyawan->nama,
            'divisi' => $karyawan->divisi,
            'penilaian' => $n_kriteria,
            'total' => number_format((float)$n_total, 2, '.', '')
        ];

        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }
}
