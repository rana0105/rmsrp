
{!! Form::model($course, ['method' => 'PATCH','route' => ['course.update', $course->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
        <strong>Course title</strong>
            {!! Form::text('title', $course->title, array('placeholder' => 'Course Name','class' => 'form-control')) !!}                        
            <strong>Course Code:</strong>
            {!! Form::text('course_code', $course->course_code, array('placeholder' => 'Course Code','class' => 'form-control')) !!}                        
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}