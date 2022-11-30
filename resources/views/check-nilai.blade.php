@extends('layouts.guest')
@section('content')
<div class="panel panel-headline panel-nilai">
    <div class="panel-heading">
        <div class="panel-inputs">
            <input type="text" class="form-control" placeholder="NIP">
            <input type="text" class="form-control" placeholder="Periode">
            <button class="btn btn-primary" type="button" id="btn-search-penilaian"><i class="fas fa-search"></i></button>
        </div>
        <div class="right">
            <img src="{{ asset('assets/img/logo_phd.png') }}" class="penilaian-logo">
        </div>
    </div>
    <div class="panel-body">
        <hr>
        <br>
        <h4>Panel Content</h4>
        <p>Objectively network visionary methodologies via best-of-breed users. Phosfluorescently initiate go forward leadership skills before an expanded array of infomediaries. Monotonectally incubate web-enabled communities rather than process-centric.</p>
    </div>
</div>
@endsection