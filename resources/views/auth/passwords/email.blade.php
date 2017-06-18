@extends('layouts.auth')

@section('page_title')
Reset Password
@endsection

@section('css')

@endsection

@section('content')
<div class="header">
    <div class="logo text-center"><img src="{{ asset('front/assets/img/logo-sintesa.png') }}" width="125" alt="Klorofil Logo"></div>
    <p class="lead">Reset Password</p>
</div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<form class="form-auth-small" action="{{ url('/password/email') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="control-label sr-only">E-Mail Address</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Send Password Reset Link</button>
    <div class="bottom">
        <span class="helper-text"><i class="fa fa-sign-in"></i> <a href="{{ url('/login') }}">Login?</a></span>
    </div>
</form>
@endsection

@section('javascript')

@endsection
