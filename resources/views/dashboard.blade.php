@extends('layouts.dashboard')
@section('content')
<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Sistem Penilaian Kinerja Karyawan</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="metric">
                    <span class="icon"><i class="fas fa-users"></i></span>
                    <p>
                        <span class="number" style="margin-bottom: .5rem" id="karyawan">{{ count($karyawan) }}</span>
                        <span class="title" style="font-size: 1.4rem;">Karyawan</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <p>Periode penilaian :</p>
        <div class="input-group" style="width: 300px">
            <input class="form-control" type="text" id="periode-penilaian" readonly value="{{ date('Y-m') }}">
            <span class="input-group-btn"><button class="btn btn-primary" type="button" id="search-penilaian"><i class="fas fa-search"></i></button></span>
        </div>
        <br>
        <div class="loader" id="chart-loader">
            <br>
            <div class="loader4"></div>
            <h5 style="margin-top: 2.5rem">Loading data</h5>
        </div>
        <div class="row" id="row-penilaian" style="display: none">
            <div class="col-md-8">
                <canvas id="chart-penilaian"></canvas>
            </div>
            <div class="col-md-4">
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th style="width: 94px">Skor</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-penilaian">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>
@endsection