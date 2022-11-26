<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $karyawan = Karyawan::all();

        return view('dashboard', compact('karyawan'));
    }

    public function chartData(Request $request)
    {
        $karyawans = Karyawan::all();
        $data = [];

        foreach ($karyawans as $karyawan) {
            $n_total = 0;

            foreach ($this->kriteria as $kriteria) {
                $nilai = $karyawan->penilaian()->where('periode', $request->periode)->where('kriteria', $kriteria['key'])->first();
                if ($nilai) $n_total += $nilai->nilai;
            }

            $n_total = $n_total / count($this->kriteria);

            $data[] = [
                'nama' => $karyawan->nama,
                'total' => number_format((float)$n_total, 2, '.', '')
            ];
        }

        array_multisort(array_column($data, 'total'), SORT_DESC, $data);

        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }
}
