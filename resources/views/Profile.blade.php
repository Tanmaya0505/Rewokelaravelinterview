@extends('layouts.app')
@section('title', 'Profile')
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
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success fade in alert-dismissible">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    {{ Form::open(['url' => 'profile', 'role' => 'form', 'class' =>'form-horizontal', 'id' => 'profile-form','files'=>true, 'autocomplete' => 'off']) }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                {!! Form::text('name', old('name',$userDet->name),['id' => 'name', 'required', 'class'=>'form-control', 'maxlength'=>'20', 'placeholder'=>'Full Name *', 'required', 'title'=>'Please enter your name', 'autofocus']) !!}
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
                                {!! Form::text('phone', old('phone',$userDet->phone),['id' => 'phone', 'onkeypress'=>'return isNumber(event)', 'required', 'class'=>'form-control', 'maxlength'=>'10', 'placeholder'=>'Phone Number *', 'required', 'title'=>'Please enter your phone']) !!}
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
                                {!! Form::email('email', old('email',$userDet->email),['id' => 'email', 'required', 'class'=>'form-control', 'placeholder'=>'E-mail Address *', 'required', 'title'=>'Please enter your email']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="photo" class="col-md-4 control-label">Photo</label>

                            <div class="col-md-6">
                                {!! Form::file('photo', ['id' => 'photo', 'class'=>'form-control', 'title'=>'Please select your Profile Photo', 'onchange'=>'return fileValidation()', 'accept'=>'image/x-png, image/jpeg']) !!}
                                <small class="note"><b>Note</b> : For better quality photo width = 50px & Height = 50px<br>Upload only <strong>png, jpg, jpeg</strong> extension banner. </small>
                                {!! Form::hidden('old_photo', $userDet->photo) !!}
                            </div>
                            <img src="{{ asset('public/images') }}/{{ $userDet->photo }}" alt="">
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
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
    var x = $("#profile-form").validate({
        rules: {
            name: "required",
            phone: "required",
            email: {
                required: true,
                email: true
            },
        },

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
