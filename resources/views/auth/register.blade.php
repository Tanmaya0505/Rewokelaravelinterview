@extends('layouts.app')
@section('title', 'Register')
@section('css')
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<style>
label.error {
    color: #e00;
    font-size: 12px;
    margin-bottom: 0;
}
small.note {
    color: #ec4100;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    {{ Form::open(['route' => 'register', 'role' => 'form', 'class' =>'form-horizontal', 'id' => 'signup-form','files'=>true, 'autocomplete' => 'off']) }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                {!! Form::text('name', old('name'),['id' => 'name', 'required', 'class'=>'form-control', 'maxlength'=>'20', 'placeholder'=>'Full Name *', 'required', 'title'=>'Please enter your name', 'autofocus']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                {!! Form::text('phone', old('phone'),['id' => 'phone', 'onkeypress'=>'return isNumber(event)', 'required', 'class'=>'form-control', 'maxlength'=>'10', 'placeholder'=>'Phone Number *', 'required', 'title'=>'Please enter your phone']) !!}
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                {!! Form::email('email', old('email'),['id' => 'email', 'required', 'class'=>'form-control', 'placeholder'=>'E-mail Address *', 'required', 'title'=>'Please enter your email']) !!}
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
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class'=>'form-control', 'title'=>'Please enter your Confirm Password', 'required', 'placeholder'=>'Confirm Password *']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Register', array('class' => 'btn btn-primary')) }}
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
    var x = $("#signup-form").validate({
        rules: {
            name: "required",
            phone: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                  required: true,
                  pwcheck: true,
                  minlength: 7
              },
            password_confirmation: {
                equalTo: "#password"
            },
        },

    });

/*$.validator.addMethod("pwcheck", function(value) {
return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
   && /[a-z]/.test(value) // has a lowercase letter
   && /\d/.test(value) // has a digit
});
});*/

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function fileValidation(){
    var fileInput = document.getElementById('photo');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.png|\.jpg|\.jpeg)$/i;
    if(!allowedExtensions.exec(filePath)){
        alert('Please upload file having extensions .png/.jpg/.jpeg only.');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}
</script>
@endpush
