<?php namespace App\Http\Controllers;

use Auth;
use App\Course;
use App\User;
use App\Category;
use App\CourseStudent;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Authorize admin && super admin
	 * @param 
	 * @return Response
	 */
	private function adminAuth()
	{		
		if (Auth::User()->type !="admin" && Auth::User()->type !="super admin"){
			return false;
		}
		return true;
	}

	/**
	 * Authorize teacher
	 * @param  
	 * @return Response
	 */
	private function teacherAuth()
	{		
		if (Auth::User()->type !="teacher"){
			return false;
		}
		return true;
	}

	/**
	 * Authorize student
	 * @param  
	 * @return Response
	 */
	private function studentAuth()
	{		
		if (Auth::User()->type !="student"){
			return false;
		}
		return true;
	}


	/**
	 * Authorize user can view the page
	 * @param  integer $user_id
	 * @return Response
	 */
	private function userAuth($id)
	{		
		if (Auth::User()->id !=$id ){
			return false;
		}
		return true;
	}




	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if($this->adminAuth()){
            $categories=Category::take(10)->get();
			$users=User::where('type','teacher')->take(5)->get();
			$courses=Course::take(10)->get();
			return view('adminHome',compact('courses','users','categories'));

		}elseif ($this->teacherAuth()) {

		    $courses=Course::where('user_id',Auth::User()->id)->take(10)->get();
			return view('teacherHome',compact('courses'));

		}elseif ($this->studentAuth()) {
		    $courseStudents=CourseStudent::where('user_id',Auth::User()->id)->take(10)->get();
			return view('studentHome',compact('courseStudents'));
		}
		//return view('home');
	}

}
