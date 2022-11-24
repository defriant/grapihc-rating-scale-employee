<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    protected $kriteria = [
        [
            'key' => 'C1',
            'name' => 'Target Kerja'
        ],
        [
            'key' => 'C2',
            'name' => 'Kehadiran'
        ],
        [
            'key' => 'C3',
            'name' => 'Kedisiplinan'
        ],
        [
            'key' => 'C4',
            'name' => 'Kecekatan'
        ],
        [
            'key' => 'C5',
            'name' => 'Kompetensi'
        ],
    ];

    public function penilaian()
    {
        return view('penilaian', ['kriteria' => $this->kriteria]);
    }

    public function getPenilaian(Request $request)
    {
        $karyawans = Karyawan::all();
        $data = [];

        foreach ($karyawans as $karyawan) {
            $n_kriteria = [];

            foreach ($this->kriteria as $kriteria) {
                $nilai = $karyawan->penilaian()->where('periode', $request->periode)->where('kriteria', $kriteria['key'])->first();

                $n_kriteria[] = [
                    'key' => $kriteria['key'],
                    'nilai' => $nilai ? $nilai->nilai : '-'
                ];
            }

            $data[] = [
                'id' => $karyawan->id,
                'nama' => $karyawan->nama,
                'penilaian' => $n_kriteria
            ];
        }

        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }
}
