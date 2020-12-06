@extends('layouts.app')
@section('title', 'Course Management')
@section('css')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"></script>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Course Management <a href="{{ route('course.create') }}" class="btn btn-sm btn-info">Add New</a></div>
        <div class="panel-body">
           @if (Session::has('success'))
            <div class="alert alert-success fade in alert-dismissible">
                <a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                {{ Session::get('success') }}
            </div>
            @endif
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Sl No.</th>
                <th>Course</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $getData)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $getData->name }}</td>
                <td>
                  <a class="btn btn-sm btn-primary" href="{{ route('course.edit',$getData->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['course.destroy', $getData->id],'style'=>'display:inline','onClick'=>"return confirm('Are you sure you want to delete Course ?')"]) !!}
                      {!! Form::button('Delete', ['class' => 'btn btn-sm btn-danger', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  $('#example').DataTable();
});
$('.dropdown-toggle').on('click', function(){
    $('.dropdown-menu').toggle();
});

$('.close').on('click',function(){
    $('.alert').css('display','none');
});
</script>
@endpush