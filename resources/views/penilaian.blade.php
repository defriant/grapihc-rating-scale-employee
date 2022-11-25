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
                                <th style="text-align: center;">{{ $k['label'] }}</th>
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

<div class="modal fade" id="modalUpdatePenilaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Update Penilaian Karyawan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="id">
                    <input type="hidden" id="periode">
                    <div class="col-sm-12 col-md-6" style="margin-bottom: 1.25rem">
                        <p>NIP</p>
                        <input type="text" id="nip" class="form-control" disabled>
                    </div>
                    <div class="col-sm-12 col-md-6" style="margin-bottom: 1.25rem">
                        <p>Nama Karyawan</p>
                        <input type="text" id="nama" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Penilaian</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="update-penilaian-kriteria">
                    @foreach ($kriteria as $k)
                        <div class="col-sm-12 col-md-6">
                            <p>{{ $k['label'] }}</p>
                            <select class="form-control dataPenilaian" id="{{ $k['key'] }}">
                                <option value=""></option>
                                <option value="5">A - Sangat Baik (5)</option>
                                <option value="4">B - Baik (4)</option>
                                <option value="3">C - Cukup (3)</option>
                                <option value="2">D - Kurang (2)</option>
                                <option value="1">E - Sangat Kurang (1)</option>
                            </select>
                            <br>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-update-penilaian">Simpan Penilaian</button>
            </div>
        </div>
    </div>
</div>
@endsection