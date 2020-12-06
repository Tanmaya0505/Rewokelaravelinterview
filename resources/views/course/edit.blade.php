@extends('layouts.app')
@section('title','Edit Course')
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
                <div class="panel-heading">Add Course</div>

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
            {!! Form::model($course, ['method' => 'PATCH', 'role' => 'form', 'class' =>'form-horizontal form-label-left', 'name' => 'edit-course', 'id' => 'edit-course','autocomplete' => 'off', 'route' => ['course.update', $course->id]]) !!}
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Course Name</label>

                            <div class="col-md-6">
                                {!! Form::text('name', old('name',$course->name),['id' => 'name', 'required', 'class'=>'form-control', 'maxlength'=>'20', 'placeholder'=>'Course Name *', 'required', 'title'=>'Please enter course Name']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {{ Form::submit('Update', array('class' => 'btn btn-primary btn-sm')) }}
                                <a href="{{ route('course.index') }}" class="btn btn-warning btn-sm">Back</a>
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
    var x = $("#add-course").validate({
        rules: {
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