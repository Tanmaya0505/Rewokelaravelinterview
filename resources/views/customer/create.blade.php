@extends('layouts.app')
@section('title','Add Customer')
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
                <div class="panel-heading">Add Customer</div>

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
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    {{ Form::open(['route' => 'customer.store', 'role' => 'form', 'class' =>'form-horizontal', 'name' => 'add-customer', 'id' => 'add-customer','autocomplete' => 'off']) }}

                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id" class="col-md-4 control-label">Select User</label>

                            <div class="col-md-6">
                                {!! Form::select('user_id',$data,old('user_id'), ['id' => 'user_id', 'required', 'title'=>'Please Select usename', 'class'=>'form-control']) !!}
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                {!! Form::text('name', old('name'),['id' => 'name', 'required', 'class'=>'form-control', 'maxlength'=>'20', 'placeholder'=>'Full Name *', 'required', 'title'=>'Please enter Full Name']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email</label>

                            <div class="col-md-6">
                                {!! Form::text('email', old('email'),['id' => 'email', 'required', 'class'=>'form-control', 'placeholder'=>'Email *', 'required', 'title'=>'Please enter E-mail']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label for="comment" class="col-md-4 control-label">Comment</label>

                            <div class="col-md-6">
                                {!! Form::textarea('comment', old('comment'),['id' => 'comment', 'required', 'class'=>'form-control', 'rows'=>'3', 'placeholder'=>'Comment *', 'required', 'title'=>'Please enter Comment']) !!}
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Add', array('class' => 'btn btn-primary btn-sm')) }}
                                <a href="{{ route('customer.index') }}" class="btn btn-warning btn-sm">Back</a>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('script')
<script src="{{ asset('public/js/validator.js') }}"></script>
<script>
$(document).ready(function () {
    var x = $("#add-customer").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            name: "required",
        },

    });
});

$('.dropdown-toggle').on('click', function(){
    $('.dropdown-menu').toggle();
});

$('.close').on('click',function(){
    $('.alert').css('display','none');
});
</script>
@endpush