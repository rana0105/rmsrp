{!! Form::model($routine, ['method' => 'PATCH','route' => ['routine.update', $routine->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        @php
            $days = $days->toArray();
            $faculty = $faculty->toArray();
            $course = $course->toArray();
            $room = $room->toArray();
            $semester = $semester->toArray();
            $period = $period->toArray();
        @endphp 
        {!! Form::select('days', array_merge([0 => 'Select Day'], $days), null, ['class' => 'form-control']) !!}

        {!! Form::select('semester',array_merge([0 => 'Select Semester'], $semester), null, ['class' => 'form-control']) !!}
        
        {!! Form::select('faculty', array_merge([0 => 'Select Faculty'], $faculty), null, ['class' => 'form-control']) !!}

        {!! Form::select('course', array_merge([0 => 'Select Course'], $course), null, ['class' => 'form-control']) !!}
                            
        {!! Form::select('room', array_merge([0 => 'Select Room'], $room), null, ['class' => 'form-control']) !!}

        <select name="room_type" class="form-control" id="room_Type" required>
            <option value="">Select Room Type</option>
            <option value="1">Theory</option>
            <option value="0">Lab</option>
        </select> 
                        
        {!! Form::select('period',array_merge([0 => 'Select Period'], $period), null, ['class' => 'form-control']) !!}                
        
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