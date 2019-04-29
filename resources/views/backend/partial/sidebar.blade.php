<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-tasks"></i>
        <span>Admin Activities</span>
        </a>
        <div class="dropdown-menu bgstyle" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('users.index') }}">Admins</a>
            <a class="dropdown-item" href="{{ route('faculty.index') }}">Faculty</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('course.index') }}">
        <i class="fas fa-fw fa-map"></i>
        <span>Course</span></a>
    </li>
    <li class="nav-item">        
        <a class="nav-link" href="{{ route('timeslot.index') }}">
        <i class="fas fa-fw fa-tags"></i>
        <span>Time Slot</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('semester.index') }}">
        <i class="fas fa-bullhorn"></i>
        <span>Semester</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('classroom.index') }}">
        <i class="fas fa-bullhorn"></i>
        <span>Class Room</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('weekday.index') }}">
        <i class="fas fa-bullhorn"></i>
        <span>Week Day</span></a>
    </li>
</ul>