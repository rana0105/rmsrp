{!! Form::model($announcement, ['enctype' => 'multipart/form-data', 'method' => 'PATCH','route' => ['announcement.update', $announcement->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {!! Form::text('title', null, array('placeholder' => 'Announcement Title','class' => 'form-control', 'required' => '')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong>
            {!! Form::textarea('detail', null, array('placeholder' => 'Announcement Detail','class' => 'form-control', 'required' => '')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Portal:</strong>
            <select name="portal_id" class="form-control">
                
                @foreach(App\Models\Portal::all() as $item)
                    <option value="{{$item->id}}" {{$item->id == $announcement->portal_id ? 'selected' : ''}}>{{$item->portalType}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}