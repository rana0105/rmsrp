{!! Form::model($semester, ['method' => 'PATCH','route' => ['semester.update', $semester->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Semester:</strong>
            {!! Form::text('semester', null, array('placeholder' => 'Start Time','class' => 'form-control', 'required' => '')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}