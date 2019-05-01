{!! Form::model($routine, ['method' => 'PATCH','route' => ['routine.update', $routine->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <select id="days"  name="days" class="form-control">
                @foreach ($days as $day)
                    <option  value="{{ $day->weekday }}" {{ $day->weekday == $routine->day_id ? 'selected="selected"' : '' }}>{{ $day->weekday }}</option>                
                @endforeach
            </select>
            <select id="semesters"  name="semester" class="form-control">
                @foreach ($semesters as $semester)
                    <option  value="{{ $semester->id }}" {{ $semester->id == $routine->semester_id ? 'selected="selected"' : '' }}>{{ $semester->semester }}</option>                
                @endforeach
            </select>
            <select id="faculties"  name="faculty" class="form-control">
                @foreach ($faculties as $faculty)
                    <option  value="{{ $faculty->id }}" {{ $faculty->id == $routine->faculty_id ? 'selected="selected"' : '' }}>{{ $faculty->name }}</option>       
                @endforeach
            </select>
            <select id="course"  name="course" class="form-control">
                @foreach ($courses as $course)
                    <option  value="{{ $course->id }}" {{ $course->id == $routine->course_id ? 'selected="selected"' : '' }}>{{ $course->title }}</option>                     
                @endforeach
            </select>                        
            <select id="room"  name="room" class="form-control">
                @foreach ($rooms as $room)
                    <option  value="{{ $room->id }}" {{ $room->id == $routine->room_id ? 'selected="selected"' : '' }}>{{ $room->room_no }}</option>                 
                @endforeach
            </select>                       

            <select name="room_type" class="form-control" id="room_type" required>
                <option value="1" {{ $routine->room_type == 1 ? 'selected="selected"' : '' }}>Theory</option>
                <option value="0" {{ $routine->room_type == 0 ? 'selected="selected"' : '' }}>Lab</option>
            </select> 
            <select id="period"  name="period" class="form-control">
                @foreach ($periods as $period)
                    <option  value="{{ $period->id }}" {{ $period->id == $routine->time_slots_id ? 'selected="selected"' : '' }}>{{ $period->period }}</option>                
                @endforeach
            </select>
            <select name="section" id="" class="form-control">
                <option value="A" {{ $routine->section == 'A' ? 'selected="selected"' : '' }}>A</option>
                <option value="B" {{ $routine->section == 'B' ? 'selected="selected"' : '' }}>B</option>
                <option value="C" {{ $routine->section == 'C' ? 'selected="selected"' : '' }}>C</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}