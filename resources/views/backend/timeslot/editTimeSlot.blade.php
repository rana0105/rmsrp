{!! Form::model($timeslot, ['method' => 'PATCH','route' => ['timeslot.update', $timeslot->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Period:</strong>
            {!! Form::text('period', null, array('placeholder' => 'Period','class' => 'form-control', 'required' => '')) !!}
        </div>
        <div class="form-group">
            <strong>Start Time:</strong>
            {!! Form::text('start_time', null, array('placeholder' => 'Start Time','class' => 'form-control', 'required' => '')) !!}
        </div>
        <div class="form-group">
            <strong>End Time:</strong>
            {!! Form::text('end_time', null, array('placeholder' => 'End Time','class' => 'form-control', 'required' => '')) !!}
        </div>
        <div class="form-group">
            <strong>Time ID:</strong>
            <input type="number" name="time_id" readonly="" class="form-control" value="{{ $timeslot->time_id }}" required/>
        </div>
        {{-- <div class="form-group">
            <strong>Status:</strong>
            <select name="slot_status" class="custom-select mr-sm-2" id="slot_status" required>                            
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div> --}}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}