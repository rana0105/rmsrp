@extends('backend.layouts.app')


@section('content')
<!-- Breadcrumbs-->
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{url('/admin')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Time Slot</li>
    </ol>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
        <div class="pull-left">
            <i class="fas fa-table"></i>Routine Management
        </div>
        <div class="pull-right">
            <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#timeSlotCreateModal" href="#"><i class="fa fa-plus" aria-hidden="true"></i>Time Slot</a>
        </div>   
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Period</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Time ID</th>
                    {{-- <th>Status</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Period</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Time ID</th>
                    {{-- <th>Status</th> --}}
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($timeslots as $key => $timeslot)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $timeslot->period }}</td>
                    <td>{{ $timeslot->start_time }}</td>
                    <td>{{ $timeslot->end_time }}</td>
                    <td>{{ $timeslot->time_id }}</td>
                    {{-- <td>{{ $timeslot->slot_status }}</td> --}}
                    <td>
                        <a class="btn btn-sm btn-light editTimeSlot" data-toggle="modal" data-target="#timeslotEditModal" data-id="{{$timeslot->id}}" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        {{-- {!! Form::open(['method' => 'DELETE','route' => ['timeslot.destroy', $timeslot->id], 'class'=>'delete_form', 'style'=>'display:inline']) !!}
                            <a class="btn btn-sm btn-light delete-btn"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        {!! Form::close() !!} --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>

{{-- Start Modal 'for' post category create --}}
<div class="modal fade" id="timeSlotCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Time Slot Create</h5>
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
            {!! Form::open(array('route' => 'timeslot.store','method'=>'POST')) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Period:</strong>
                        {!! Form::text('period', null, array('placeholder' => 'Period','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Start Time:</strong>
                        {!! Form::text('start_time', null, array('placeholder' => 'Start Time','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>End Time:</strong>
                        {!! Form::text('end_time', null, array('placeholder' => 'End Time','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Time ID:</strong>
                        <input type="number" name="time_id" class="form-control" placeholder="Time ID" required/>
                    </div>
                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <select name="slot_status" class="custom-select mr-sm-2" id="slot_status" required>                            
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div> --}}
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
<div class="modal fade" id="timeslotEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Time Slot Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body timeslotEditAdd">

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
        $(document).on('click', 'a.editTimeSlot', function() {
            var id = $(this).attr('data-id');
            $.get('editTimeSlot/'+id, function(data){
                $('#timeslotEditModal').find('.timeslotEditAdd').first().html(data);
            });
        });
       
    });
</script>
@endsection