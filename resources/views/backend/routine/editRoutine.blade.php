{!! Form::model($routine, ['method' => 'PATCH','route' => ['routine.update', $routine->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <select id="days"  name="days" class="form-control">
                @foreach ($days as $day)
                @php dd($routine); @endphp
                    <option value="{{ $day->weekday }}">{{ $day->weekday }}</option>                
                @endforeach
            </select>
            <select id="semesters"  name="semester" class="form-control">
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}">{{ $semester->semester }}</option>                
                @endforeach
            </select>
            <select id="faculties"  name="faculty" class="form-control">
                @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>                
                @endforeach
            </select>
            <select id="course"  name="course" class="form-control">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>                
                @endforeach
            </select>                        
            <select id="room"  name="room" class="form-control">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->room_no }}</option>                
                @endforeach
            </select>                       

            <select name="room_type" class="form-control" id="room_Type" required>
                <option value="1">Theory</option>
                <option value="0">Lab</option>
            </select> 
            <select id="period"  name="period" class="form-control">
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