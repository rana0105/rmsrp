{!! Form::model($classroom, ['method' => 'PATCH','route' => ['classroom.update', $classroom->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Start Time:</strong>
            {!! Form::text('room_no', null, array('placeholder' => 'Start Time','class' => 'form-control', 'required' => '')) !!}
        </div>
        {{-- <div class="form-group">
            <strong>Status:</strong>
            <select name="room_Type" class="custom-select mr-sm-2" id="room_Type" required>
                <option value="1" {{ $classroom->room_Type == 1 ? 'selected="selected"' : '' }}>Theory</option>
                <option value="0" {{ $classroom->room_Type == 0 ? 'selected="selected"' : '' }}>Lab</option>
            </select>
        </div> --}}
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}