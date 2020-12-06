@extends('layouts.app')
@section('title', 'Login')
@section('css')
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<style>
label.error {
    color: #e00;
    font-size: 12px;
    margin-bottom: 0;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    {{ Form::open(['route' => 'login', 'role' => 'form', 'class' =>'form-horizontal', 'id' => 'signin-form', 'autocomplete' => 'off']) }}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail / Phone</label>

                            <div class="col-md-6">
                                {!! Form::text('email', old('email'),['id' => 'email', 'required', 'class'=>'form-control', 'placeholder'=>'E-mail / Phone *', 'required', 'title'=>'Please enter your email', 'autofocus']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                {!! Form::password('password', ['id' => 'password', 'class'=>'form-control', 'title'=>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters', 'required', 'placeholder'=>'Password *']) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('public/js/validator.js') }}"></script>
<script>
$(document).ready(function () {
    var x = $("#signin-form").validate({
        rules: {
            // email: {
            //     required: true,
            //     email: true
            // },
            password: {
                  required: true,
                  pwcheck: true,
                  minlength: 7
              },
        },

    });

$.validator.addMethod("pwcheck", function(value) {
return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
   && /[a-z]/.test(value) // has a lowercase letter
   && /\d/.test(value) // has a digit
});
});
</script>
@endpush
