@extends('backend.layouts.app')


@section('content')
<!-- Breadcrumbs-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/admin')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Class Routine</li>
    </ol>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
        <div class="pull-left">
            <i class="fas fa-table"></i>Class Routine 
        </div>
        <div class="pull-right">
            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#routineCreateModal" href="#"><i class="fa fa-plus" aria-hidden="true"></i>Class Routine</a>
        </div>   
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Routine</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Routine</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($routines as $key => $routine)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $routine->name }}</td>   
                    <td>{{ $routine->email }}</td>
                    <td>{{ $routine->phone_no }}</td>
                    <td>
                        <a class="btn btn-sm btn-light editRoutine" data-toggle="modal" data-target="#routineEditModal" data-id="{{$routine->id}}" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        {!! Form::open(['method' => 'DELETE','route' => ['routine.destroy', $routine->id], 'class'=>'delete_form', 'style'=>'display:inline']) !!}
                            <a class="btn btn-sm btn-light delete-btn"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>

{{-- Start Modal 'for' post category create --}}
<div class="modal fade" id="routineCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Routine Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            {!! Form::open(array('route' => 'faculty.store','method'=>'POST')) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Day:</strong> 
                        {!! Form::select('days', $days, null, ['class' => 'form-control']) !!}                        
                        <strong>Select Course:</strong>                      
                        {!! Form::select('course', $course, null, ['class' => 'form-control']) !!}
                        <strong>Select Semester:</strong>                  
                        {!! Form::select('semester', $semester, null, ['class' => 'form-control']) !!}
                        <strong>Select Rooms:</strong>                        
                        {!! Form::select('room', $room, null, ['class' => 'form-control']) !!}
                        <strong>Section:</strong>
                        {!! Form::text('section', null, array('placeholder' => 'Section','class' => 'form-control')) !!}                      
                        <strong>Academic year:</strong>
                        {!! Form::text('year', null, array('placeholder' => 'Academic year:','class' => 'form-control')) !!}
                         
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
        </div>
    </div>
  </div>
</div>
{{-- End post category create Modal --}}

{{-- Start Modal 'for' Post category edit --}}
<div class="modal fade" id="facultyEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Faculty Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body regionEditAdd">
           
        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>
{{-- End Post category edit Modal --}}
@endsection
@section('style')
<style>
    a.btn.btn-sm.btn-light.showModal {
        background: #b9a4a436;
    }
</style>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        //edit region in modal
        $(document).on('click', 'a.editFaculty', function() {
            var id = $(this).attr('data-id');
            $.get('editFaculty/'+id, function(data){
                $('#facultyEditModal').find('.regionEditAdd').first().html(data);
            });
        });
       
    });
</script>
@endsection