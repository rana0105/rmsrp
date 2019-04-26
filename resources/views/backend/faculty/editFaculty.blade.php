
{!! Form::model($faculty, ['method' => 'PATCH','route' => ['faculty.update', $faculty->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', $faculty->name, array('placeholder' => 'Faculty Name','class' => 'form-control')) !!}                        
            <strong>Email:</strong>
            {!! Form::email('email', $faculty->email, array('placeholder' => 'Faculty Email','class' => 'form-control')) !!}                        
            <strong>Phone No:</strong>
            {!! Form::text('phone_no', $faculty->phone_no, array('placeholder' => 'Phone No','class' => 'form-control')) !!}
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'New Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}