{!! Form::model($weekday, ['method' => 'PATCH','route' => ['weekday.update', $weekday->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Dday:</strong>
            {!! Form::text('weekday', null, array('placeholder' => 'Start Time','class' => 'form-control', 'required' => '')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}