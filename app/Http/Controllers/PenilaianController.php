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
            'label' => 'Target Kerja'
        ],
        [
            'key' => 'C2',
            'label' => 'Kehadiran'
        ],
        [
            'key' => 'C3',
            'label' => 'Kedisiplinan'
        ],
        [
            'key' => 'C4',
            'label' => 'Kecekatan'
        ],
        [
            'key' => 'C5',
            'label' => 'Kompetensi'
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
            $n_total = 0;

            foreach ($this->kriteria as $kriteria) {
                $nilai = $karyawan->penilaian()->where('periode', $request->periode)->where('kriteria', $kriteria['key'])->first();

                $n_kriteria[] = [
                    'key' => $kriteria['key'],
                    'label' => $kriteria['label'],
                    'nilai' => $nilai ? $nilai->nilai : '-'
                ];

                if ($nilai) $n_total += $nilai->nilai;
            }

            $n_total = $n_total / count($this->kriteria);

            $data[] = [
                'id' => $karyawan->id,
                'nip' => $karyawan->nip,
                'nama' => $karyawan->nama,
                'penilaian' => $n_kriteria,
                'total' => (float) number_format((float)$n_total, 2)
            ];
        }

        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    public function updatePenilaian(Request $request)
    {
        foreach ($request->penilaian as $p) {
            $penilaian = Penilaian::where('periode', $request->periode)
                ->where('id_karyawan', $request->id)
                ->where('kriteria', $p['key'])
                ->first();

            if ($penilaian && $p['nilai']) {
                $penilaian->update([
                    'nilai' => $p['nilai']
                ]);
            }

            if (!$penilaian && $p['nilai']) {
                Penilaian::create([
                    'periode' => $request->periode,
                    'id_karyawan' => $request->id,
                    'kriteria' => $p['key'],
                    'nilai' => $p['nilai']
                ]);
            }
        }

        return response()->json([
            'error' => false,
            'message' => 'Penilaian berhasil di simpan'
        ]);
    }
}
