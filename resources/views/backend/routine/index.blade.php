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
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <!-- DataTables Example -->
    <div class="card mb-3">
    <div class="card-header">
        <div class="pull-left">
            @php $day = \Carbon\Carbon::now()->format( 'l' ); @endphp 
           <select name="days" id="" class="form-control">
            @foreach($days as $d)
               <option value="{{ $d->weekday }}" {{ $day == $d->weekday ? 'selected="selected"' : '' }}>{{ $d->weekday }}</option>
            @endforeach
           </select>
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
                    <th>Day</th>
                    <th>Semister</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Faculty</th>
                    <th>Time Slots</th>
                    <th>Class Room</th>
                    <th>Room Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Day</th>
                    <th>Semister</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th>Faculty</th>
                    <th>Time Slots</th>
                    <th>Class Room</th>
                    <th>Room Type</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($routines as $key => $routine)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $routine->day_id}}</td>   
                    <td>{{ $routine->semesters->semester}}</td>
                    <td>{{ $routine->course->title}}</td>
                    <td>{{ $routine->section }}</td>
                    <td>{{ $routine->faculty->name}}</td>
                    <td>{{ $routine->timeSlot->period}}</td>
                    <td>{{ $routine->classRoom->room_no}}</td>
                    <td>
                        @if($routine->room_type == 1)
                         <span class="badge badge-info">Theory</span>
                        @else
                        <span class="badge badge-info">Lab</span>
                        @endif
                    </td>
                    <td>
                        {{-- <a class="btn btn-sm btn-light editRoutine" data-toggle="modal" data-target="#routineEditModal" data-id="{{$routine->id}}" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> --}}
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
            {!! Form::open(array('route' => 'routine.store','method'=>'POST')) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        
                        <select id="days"  name="days" class="form-control">                            
                            <option value="">Select Day</option>
                            @foreach ($days as $day)
                                <option value="{{ $day->weekday }}">{{ $day ->weekday }}</option>                
                            @endforeach
                        </select>
                        <select id="semesters"  name="semester" class="form-control">                            
                            <option value="">Select Semester</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">{{ $semester->semester }}</option>                
                            @endforeach
                        </select>
                        <select id="faculties"  name="faculty" class="form-control">                            
                            <option value="">Select Faculty</option>
                            @foreach ($faculties as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>                
                            @endforeach
                        </select>
                        <select id="course"  name="course" class="form-control">                            
                            <option value="">Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>                
                            @endforeach
                        </select>                        
                        <select id="room"  name="room" class="form-control">                            
                            <option value="">Select Room</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_no }}</option>                
                            @endforeach
                        </select>                       

                        <select name="room_type" class="form-control" id="room_Type" required>
                            <option value="">Select Room Type</option>
                            <option value="1">Theory</option>
                            <option value="0">Lab</option>
                        </select> 
                        <select id="period"  name="period" class="form-control">                            
                            <option value="">Select Period</option>
                            @foreach ($periods as $period)
                                <option value="{{ $period->id }}">{{ $period->period }}</option>                
                            @endforeach
                        </select> 

                        <select name="section" id="" class="form-control">
                            <option value="">Select Section</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                         
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
<div class="modal fade" id="routineEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Routine Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body routineEditAdd">
           
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
        //edit routine in modal
        $(document).on('click', 'a.editRoutine', function() {
            var id = $(this).attr('data-id');
            $.get('editRoutine/'+id, function(data){
                $('#routineEditModal').find('.routineEditAdd').first().html(data);
            });
        });
       
    });
</script>
@endsection