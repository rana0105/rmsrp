@extends('layouts.main')

@section('content')
	<!--================ Start Home Banner Area =================-->
	
			<div class="container">
				<div class="row">
					{{-- <div class="card-body">
			        <div class="table-responsive">
			        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			            <thead>
			                <tr>
			                    <th>Semester</th>
			                    @foreach($period->toArray() as $i => $time_slot)
			                        <th>{{$time_slot}}</th>
			                        @if($i==3)
			                            <th>Break</th>
			                        @endif
			                    @endforeach
			                </tr>
			            </thead>            
			            <tbody>
			                @foreach($routines as $routine)
			                    <tr>
			                        <td>{{$routine->semesters->semester}}</td>
			                        <td>{{ $routine->semesters->semester }}</td>
			                    </tr>
			                @endforeach
			            </tbody>
			        </table>
			        </div>
			    </div> --}}
			    <form action="{{ route('searchTheory') }}" method="POST">
		        		{{ csrf_field() }}
		        <div class="col-md-5">
		            @php $day = \Carbon\Carbon::now()->format( 'l' ); @endphp 
		           <select name="day" id="" class="form-control">
		            @foreach($days as $d)
		               <option value="{{ $d }}" {{ $day == $d ? 'selected="selected"' : '' }}>{{ $d }}</option>
		            @endforeach
		           </select>
		        </div>
		        <div class="col-md-5">
		           <select name="semester" id="" class="form-control">
		            @foreach($semester as $s)
		               <option value="{{ $s->id }}">{{ $s->semester }}</option>
		            @endforeach
		           </select>
		        </div>
		        <div class="col-md-2">
		            <button class="btn btn-sm btn-info">Search</button>
		        </div> 
	        </form>
		    </div>
		    <div class="row">
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
			                </tr>
			            </tfoot>
			            <tbody>
			                @foreach ($routines as $key => $routine)
			                <tr>
			                    <td>{{ ++$key }}</td>
			                    <td>{{$routine->days ? $routine->days->weekday : ''}}</td>   
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
			                </tr>
			                @endforeach
			            </tbody>
			        </table>
			        </div>
			    </div>
				</div>
			</div>
	
	@endsection
	@section('css')
	<style>
		.ttt {
			padding-bottom: 100px;
		}
		.sss {
			padding-bottom: 100px;
		}
	</style>
	@endsection