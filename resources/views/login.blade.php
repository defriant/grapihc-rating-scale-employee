@extends('layouts.guest')
@section('content')
<div class="left">
    <div class="content">
        <div class="header">
            <div class="logo text-center"><img src="{{ asset('assets/img/smk6.png') }}" class="login-logo"></div>
            <p class="lead">Login to Your Account</p>
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
        </form>
    </div>
</div>
<div class="right">
    <div class="overlay"></div>
    <div class="content text">
        <h1 class="heading">Lorem ipsum dolor sit amet.</h1>
        <p>Lorem, ipsum dolor.</p>
    </div>
</div>
@endsection