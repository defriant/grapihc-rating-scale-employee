@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-headline" id="panel-prediksi-loading">
            {{-- Penilaian --}}
            <div class="panel-heading">
                <h3 class="panel-title">Penilaian Karyawan</h3>
            </div>
            <div class="panel-body">
                <p>Periode penilaian :</p>
                <div class="input-group" style="width: 300px">
                    <input class="form-control" type="text" id="periode-penilaian" readonly value="{{ date('Y-m') }}">
                    <span class="input-group-btn"><button class="btn btn-primary" type="button" id="search-penilaian"><i class="fas fa-search"></i></button></span>
                </div>
                <br>
                <div class="loader" id="penilaian-karyawan-loader">
                    <br>
                    <div class="loader4"></div>
                    <h5 style="margin-top: 2.5rem">Loading data</h5>
                </div>
                <br>
                <table class="table" id="table-penilaian" style="display: none;">
                    <thead>
                        <tr id="thead-penilaian">
                            <th></th>
                            @foreach ($kriteria as $k)
                                <th style="text-align: center;">{{ $k['name'] }}</th>
                            @endforeach
                            <th style="width: 75px"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-penilaian">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="kriteria" data-kriteria="{{ json_encode($kriteria) }}"></div>
@endsection