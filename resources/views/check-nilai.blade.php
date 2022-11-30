@extends('layouts.guest')

@section('head')
<title>Pizza Hut - Nilai Karyawan</title>
@endsection

@section('content')
<div class="panel panel-headline panel-nilai">
    <div class="panel-heading">
        <a href="/" class="back-to-login">
            <i class="fas fa-chevron-circle-left"></i>
            <span>Login Admin</span>
        </a>
        <div class="panel-inputs">
            <input type="text" class="form-control" placeholder="NIP" id="search-nip">
            <input type="text" class="form-control" placeholder="Periode" id="periode-penilaian" readonly>
            <button class="btn btn-primary" type="button" id="btn-search-penilaian" disabled><i class="fas fa-search"></i></button>
        </div>
        <div class="right">
            <img src="{{ asset('assets/img/logo_phd.png') }}" class="penilaian-logo">
        </div>
    </div>
    <div class="panel-body">
        <hr>

        <div class="loader" id="null-penilaian">
            <br>
            <br>
            <i class="fas fa-info-circle" style="font-size: 5rem; opacity: .5"></i>
            <h5 style="margin-top: 2.5rem; opacity: .75">Input NIP dan periode penilaian untuk melihat data penilaian</h5>
            <br>
            <br>
        </div>

        <div class="loader" id="penilaian-loader" style="display: none;">
            <br>
            <br>
            <div class="loader4"></div>
            <h5 style="margin-top: 2.5rem">Loading data</h5>
            <br>
            <br>
        </div>

        <div class="loader" id="error-penilaian" style="display: none;">
            <br>
            <br>
            <i class="fas fa-ban" style="font-size: 5rem; opacity: .5"></i>
            <h5 style="margin-top: 2.5rem; opacity: .75" id="error-message"></h5>
            <br>
            <br>
        </div>

        <div id="penilaian-data" style="display: none">
            <div class="karyawan-detail">
                <span>NIP</span>
                <span>:</span>
                <span id="detail-nip"></span>

                <span>Nama</span>
                <span>:</span>
                <span id="detail-nama"></span>

                <span>Divisi</span>
                <span>:</span>
                <span id="detail-divisi"></span>
            </div>
            <br>
            <table class="table table-bordered">
                <thead style="background-color: #F7F7F7;">
                    <tr>
                        <td rowspan="3" style="vertical-align: middle; text-align: center; font-weight: 600;">Aspek</td>
                        <th colspan="5" scope="colgroup" style="text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">Nilai</th>
                    </tr>
                    <tr>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">SK</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">K</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">C</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">B</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">SB</th>
                    </tr>
                    <tr>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">1</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">2</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">3</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">4</th>
                        <th scope="col" style="width: 100px; text-align: center; padding: 4px; padding-left: 0; padding-right: 0;">5</th>
                    </tr>
                </thead>
                <tbody id="tbody-nilai">
                    
                </tbody>
            </table>
            <br>
        </div>
    </div>
</div>
<div id="kriteria" data-kriteria="{{ json_encode($kriteria) }}"></div>
@endsection