<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
}
