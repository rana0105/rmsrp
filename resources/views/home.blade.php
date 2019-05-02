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
                <form class="form-inline search_form" action="{{ route('searchTeacher') }}" method="POST">
                        {{ csrf_field() }}
                <div class="col-md-5">
                   <select name="faculty" id="" class="form-control">
                       <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>                  
                   </select>
                </div>
                <div class="col-md-5">
                    <input type="text" name="course_code" placeholder="Course Code" class="form-control">
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
                                <th>Day</th>
                                @foreach($time_slots as $i => $time_slot)
                                    <th>{{$time_slot->start_time}} - {{$time_slot->end_time}}</th>
                                    @if($i == 2)
                                        <th>Break</th>
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($routines as $key => $routine)
                            <tr>
                                <td>{{$routine->day_id}}</td>
                                    @foreach($time_slots as $i => $time_slot)
                                        
                                        @if($time_slot->id == $routine->time_slots_id)   
                                            <td>{{ $routine->course->title}} <br> CC:{{ $routine->course->course_code }}<br> RN:{{ $routine->classRoom->room_no }}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        @if($i == 2)
                                            <th>Break</th>
                                        @endif
                                    @endforeach
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