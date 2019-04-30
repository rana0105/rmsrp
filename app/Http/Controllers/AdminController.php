<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Models\Backend\Course;
use App\Models\Semester;
use App\Models\ClassRoom;
use Auth;
class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $faculties = User::count();
      $course = Course::count();
      $semester = Semester::count();
      $rooms = ClassRoom::count();

      return view('backend.dashboard', compact('faculties','course','semester','rooms'));
    }

}
