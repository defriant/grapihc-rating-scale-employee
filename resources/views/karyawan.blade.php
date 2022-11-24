@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- RECENT PURCHASES -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title">Data Karyawan</h3>
                <div class="right">
                    <button type="button" data-toggle="modal" data-target="#modalInput"><i class="far fa-plus"></i>&nbsp; Input Data Karyawan</button>
                </div>
            </div>
            <div class="panel-body">
                <div class="loader" id="loader-karyawan">
                    <div class="loader4"></div>
                    <h5 style="margin-top: 2.5rem">Loading data</h5>
                </div>

                <div class="loader" id="null-karyawan" style="display: none;">
                    <i class="fas fa-ban" style="font-size: 5rem; opacity: .5"></i>
                    <h5 style="margin-top: 2.5rem; opacity: .75">Belum ada data karyawan.</h5>
                </div>

                <table class="table" id="table-karyawan" style="display: none;">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Tgl Lahir</th>
                            <th>Divisi</th>
                            <th style="width: 125px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="loading">12</span></td>
                            <td><span class="loading">Lorem, ipsum dolor.</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="loading">12</span></td>
                            <td><span class="loading">Lorem, ipsum dolor.</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="loading">12</span></td>
                            <td><span class="loading">Lorem, ipsum dolor.</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td><span class="loading">Lorem, ipsum.</span></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END RECENT PURCHASES -->
    </div>
</div>

<div class="modal fade" id="modalInput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Input Data Karyawan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>NIP</p>
                        <input type="text" id="nip" class="form-control">
                        <br>
                    </div>
                    <div class="col-md-12">
                        <p>Nama</p>
                        <input type="text" id="nama" class="form-control">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <p>Tanggal Lahir</p>
                        <input type="text" id="tgl_lahir" class="form-control date-picker" readonly>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <p>Divisi</p>
                        <select class="form-control" id="divisi">
                            <option value=""></option>
                            <option value="Back of House">Back of House</option>
                            <option value="Front of House">Front of House</option>
                        </select>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-input-data" disabled>Input</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Data Karyawan</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input hidden id="id">
                    <div class="col-md-12">
                        <p>NIP</p>
                        <input type="text" id="nip" class="form-control" disabled>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <p>Nama</p>
                        <input type="text" id="nama" class="form-control">
                        <br>
                    </div>
                    <div class="col-md-6">
                        <p>Tanggal Lahir</p>
                        <input type="text" id="tgl_lahir" class="form-control date-picker" readonly>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <p>Divisi</p>
                        <select class="form-control" id="divisi">
                            <option value=""></option>
                            <option value="Back of House">Back of House</option>
                            <option value="Front of House">Front of House</option>
                        </select>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-edit-data" disabled>Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center" style="margin-top: 3rem" id="delete-warning-message"></h4>
                <input type="hidden" id="id">
                <div style="margin-top: 5rem; text-align: center">
                    <button type="button" class="btn btn-danger" id="btn-delete-data">Hapus</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection