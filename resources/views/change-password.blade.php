@extends('layouts.app')
@section('title', 'Change Password')
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
                <div class="panel-heading">Change Password</div>

                <div class="panel-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success fade in alert-dismissible">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger fade in alert-dismissible">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong>Error!</strong> {{ Session::get('error') }}
                    </div>
                    @endif
                    {{ Form::open(['url' => 'change-password', 'role' => 'form', 'class' =>'form-horizontal', 'id' => 'changePassword-form','files'=>true, 'autocomplete' => 'off']) }}
                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="old_password" class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                {!! Form::password('old_password', ['id' => 'old_password', 'required', 'class'=>'form-control',  'placeholder'=>'Old Password *', 'required', 'title'=>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters', 'autofocus']) !!}
                                @if ($errors->has('old_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                {!! Form::password('new_password', ['id' => 'new_password', 'required', 'class'=>'form-control',  'placeholder'=>'New Password *', 'required', 'title'=>'Must contain at least one number and one uppercase and lowercase letter, and at least 7 or more characters',]) !!}
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            <label for="confirm_password" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                {!! Form::password('confirm_password', ['id' => 'confirm_password', 'required', 'class'=>'form-control',  'placeholder'=>'Confirm Password *', 'required', 'title'=>'Please enter your confirm Password', 'autofocus']) !!}
                                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Change Password', array('class' => 'btn btn-primary')) }}
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
    var x = $("#changePassword-form").validate({
        rules: {
            old_password: {
                  required: true,
                  pwcheck: true,
                  minlength: 7
              },
            new_password: {
                  required: true,
                  pwcheck: true,
                  minlength: 7
              },
            confirm_password: {
                equalTo: "#new_password"
            },
        },

    });

    $.validator.addMethod("pwcheck", function(value) {
    return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[a-z]/.test(value) // has a lowercase letter
       && /\d/.test(value) // has a digit
    });

});
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

$('.dropdown-toggle').on('click', function(){
    $('.dropdown-menu').toggle();
});

$('.close').on('click',function(){
    $('.alert').css('display','none');
});
</script>
@endpush
