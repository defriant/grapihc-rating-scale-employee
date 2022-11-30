@extends('layouts.guest')
@section('content')
<div class="auth-box">
    <div class="left">
        <div class="content">
            <div class="header">
                <div class="logo text-center"><img src="{{ asset('assets/img/logo_phd.png') }}" class="login-logo"></div>
                <p class="lead">Login as admin</p>
            </div>
            <form class="form-auth-small" method="POST" action="/login-attempt">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="signin-email" class="control-label sr-only">Email</label>
                    <input type="text" name="username" class="form-control" id="signin-email" value="{{ old('username') }}" placeholder="username">
                    @if ($message = Session::get('failed'))
                        <span class="login-failed-message"><i>Username dan password tidak sesuai </i></span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="signin-password" class="control-label sr-only">Password</label>
                    <input type="password" name="password" class="form-control" id="signin-password" value="{{ old('password') }}" placeholder="Password">
                </div>
                <div class="form-group clearfix">
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-login">LOGIN</button>
                <br>
                <div class="auth-box-btm">
                    <div>
                        <hr>
                    </div>
                    <span>or</span>
                    <div>
                        <hr>
                    </div>
                </div>
                <a href="/karyawan/nilai" class="lihat-nilai-link">
                    <button type="button" class="btn btn-block btn-default">
                        <i class="far fa-analytics"></i>
                        &nbsp;
                        <span>Lihat nilai karyawan</span>
                    </button>
                </a>
            </form>
        </div>
    </div>
    <div class="right">
        <div class="overlay"></div>
        <div class="content text">
            <h1 class="heading">Sistem Penilaian Karyawan</h1>
            <p>Pizza Hut</p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection