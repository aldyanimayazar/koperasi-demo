@extends('layouts.auth')

@section('page_title')
Login
@endsection

@section('css')

@endsection

@section('content')
<div class="header">
    <div class="logo text-center"><img src="{{ asset('img/logo-main.jpg') }}" width="125" alt="Klorofil Logo"></div>
    <p class="lead">Login to your account</p>
</div>
<form class="form-auth-small" action="{{ url('/login') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="signin-email" class="control-label sr-only">Email</label>
        <input type="email" class="form-control" id="signin-email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="signin-password" class="control-label sr-only">Password</label>
        <input type="password" class="form-control" id="signin-password" name="password" value="{{ old('password') }}" placeholder="Password" required>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group clearfix">
        <label class="fancy-checkbox element-left">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
            <span>Ingat saya</span>
        </label>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
    <div class="bottom">
        <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ url('/password/reset') }}">Lupa password?</a></span>
    </div>
</form>
@endsection

@section('javascript')

@endsection
