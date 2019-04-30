@extends('backend.layouts.app')
@section('content')

<!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{url('/admin')}}">Dashboard</a>
        </li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$faculties}} Experienced Faculties</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('faculty.index')}}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                <i class="fas fa-angle-right"></i>
                </span>
            </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">Total {{ $course }} Courses!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('course.index')}}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                <i class="fas fa-angle-right"></i>
                </span>
            </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">{{$semester}} Semesters!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{route('semester.index')}}">
                <span class="float-left">View Details</span>
                <span class="float-right">
                <i class="fas fa-angle-right"></i>
                </span>
            </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                    </div>
                    <div class="mr-5">{{$rooms}} Digital Class Rooms!</div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('classroom.index')}}">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
@endsection
