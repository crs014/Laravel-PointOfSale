@extends('layouts.auth')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <!-- <img src="{{ asset('/public/images/logo.png') }}"> -->
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Login untuk Mengunakan Aplikasi</p>
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection
