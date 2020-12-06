@extends('layouts.app')
@section('title', 'Customer Management')
@section('css')
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"></script>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Course Management <a href="{{ route('customer.create') }}" class="btn btn-sm btn-info">Add New</a></div>
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
                <th>User Name</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Customer Comment</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $getData)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $getData->user_data->name }}</td>
                <td>{{ $getData->name }}</td>
                <td>{{ $getData->email }}</td>
                <td>{{ $getData->comment }}</td>
                <td>
                  <button class="assignCourse btn btn-warning btn-sm" data-id="{{ $getData->id }}" data-toggle="modal" data-target="#myModal">Assign</button>
                  <a class="btn btn-sm btn-primary" href="{{ route('customer.edit',$getData->id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['customer.destroy', $getData->id],'style'=>'display:inline','onClick'=>"return confirm('Are you sure you want to delete Customer ?')"]) !!}
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

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        {{ Form::open(['route' => 'course.store', 'role' => 'form', 'class' =>'form-horizontal', 'name' => 'add-course', 'id' => 'add-course','autocomplete' => 'off']) }}
        {!! Form::hidden('customer_id', '',['id' => 'customer_id']) !!}
        <div class="modal-body">
          <ul id="assciate_id">
          </ul>
        </div>
      {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('.assignCourse').click(function(){
  var id = $(this).attr("data-id");
  $.ajax({
      url: "{{ url('assign') }}",
      type: "POST",
      data:  {id:id,},
      dataType: 'json',
    success: function(data) {
      if (data.response == "success") {
         $('#customer_id').val(id);
         $('#assciate_id').empty();
         var assdata__ = data.data;
          $.each(assdata__, function(key, val) {
              $('#assciate_id').append($("<li/>", {
                  text: val.name
              }));
          });
          $('#assciate_id').trigger("chosen:updated");
      }
    }
  });
})
</script>
@endpush