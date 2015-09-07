<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Validator;
use Request;
use Auth;
use App\User;
use App\Course;
use App\Category;
use Mail;
use App\CourseStudent;

class CoursesController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$courses=Course::all();
      // var_dump($courses[0]->user->id); exit();
		return view('courses.index',compact('courses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$presenters=User::where('type','teacher')->get();
		$categories=Category::all();
		return view('courses.create',compact('presenters','categories'));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$v = Validator::make(Request::all(), [
        'title' => 'required|max:30',
        'control_category_id'=>'required',
        'presenter_id'=>'required',
       
        ]);
       
	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())
	        						 ->withInput();
	    }else{
			$course = new Course;

		    $course->title = Request::get('title');
            $course->desc = Request::get('desc');
		    $course->start_time = Request::get('start_time');
		    $course->duration = Request::get('duration');
		    $course->attendee_limit = Request::get('attendee_limit');
		    $course->language_culture_name = Request::get('language_culture_name');
		    $course->user_id = Request::get('presenter_id');
		    $course->category_id = Request::get('control_category_id');

			$course->save();
			return redirect('courses');
	    }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//

		$course=Course::find($id);
		return view('courses.show',compact('course'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		if($this->adminAuth()){
			$presenters=User::where('type','teacher')->get();
			$categories=Category::all();
			$course=Course::find($id);
			$teacherOfCourse=$course->user->id;
			return view('courses.edit',compact('course','presenters','categories','teacherOfCourse'));
		}else{
			return view('errors.404');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		$v = Validator::make(Request::all(), [
        'title' => 'required|max:50',
        'control_category_id'=>'required',
        'presenter_id'=>'required',
       
        ]);
       
	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())
	        						 ->withInput();
	    }else{

			$id=Request::get('id');
			$course=Course::find($id);
			$course->title = Request::get('title');
            $course->desc = Request::get('desc');
		    $course->start_time = Request::get('start_time');
		    $course->duration = Request::get('duration');
		    $course->attendee_limit = Request::get('attendee_limit');
		    $course->language_culture_name = Request::get('language_culture_name');
		    $course->user_id = Request::get('presenter_id');
		    $course->category_id = Request::get('control_category_id');
			$course->save();
			return redirect('courses/'.$id);
	    }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$courseId = Request::get('id');
	    Course::where('id',$courseId)->delete();
	    return redirect("courses");
	}

	public function invite($id){

           $courseId=$id;
           $students=User::where('type','student')->get();

           return view('courses.invite',compact('courseId','students'));


	}

	public function sendinvitation(){

		$studentId= Request::get('studentId');
		$courseId= Request::get('courseId');

		$student=User::find($studentId);
		$course=Course::find($courseId);

		$data=json_decode(json_encode($course), true);
		$data=json_decode(json_encode($student), true);
		
	 	$data['course_teacher_name']=$course->user->name;
	    $data['course_teacher_email']=$course->user->email;
	    $data['course_title']=$course->title;
	    $data['course_desc']=$course->desc;
	    $data['course_start_time']=$course->start_time;
	    $data['course_duration']=$course->duration;
		
		Mail::send('emails.invitation', $data, function($message) use ($data)
            {
                $message->from('yoyo80884@gmail.com', "RSB");
                $message->subject("invitation for attende ");
                $message->to($data['email']);
            });
        $join=new CourseStudent;
		$join->user_id=$studentId;
		$join->course_id=$courseId;
		$join->save();

		//echo var_dump($join); 

	}


	public function inviteAll(){

		$courseId= Request::get('courseId');

		$course=Course::find($courseId);

		

        $students=User::where('type','student')->get();
        foreach ($students as $student) {
        	# code...
        
			$data=json_decode(json_encode($student), true);
			$data['course_teacher_name']=$course->user->name;
		    $data['course_teacher_email']=$course->user->email;
		    $data['course_title']=$course->title;
		    $data['course_desc']=$course->desc;
		    $data['course_start_time']=$course->start_time;
		    $data['course_duration']=$course->duration;
				 	
			
            $join=new CourseStudent;
			$join->user_id=$student->id;
			$join->course_id=$courseId;
			$join->save();
			Mail::send('emails.invitation', $data, function($message) use ($data)
	            {
	                $message->from('yoyo80884@gmail.com', "invitation");
	                $message->subject("invitation for attende ");
	                $message->to($data['email']);
	            });

		

         }

          echo var_dump($data); 
	//	echo $courseId;

	}

	public function outsideInvitation($id){
		//echo $id; exit();
		return view('courses.outsideInvitation',compact('id'));
	}

	public function inviteOutsideStudent(){
		$courseId=Request::get('courseId');
        $course=Course::find($courseId);
        $data=json_decode(json_encode($course), true);
        $data['course_teacher_name']=$course->user->name;
	    $data['course_teacher_email']=$course->user->email;

        $emails=Request::get('emails');

        $studentEmails = explode(",", $emails);

        foreach ($studentEmails as $studentEmail) {


          $data['email']=$studentEmail;

			Mail::send('emails.outsideInvitation', $data, function($message) use ($data)
	            {
	                $message->from('yoyo80884@gmail.com', "invitation");
	                $message->subject("invitation for attende ");
	                $message->to($data['email']);
	            });
        }
	}

	public function searchStudent(){
        $name = Request::get('name');

		$users = User::where('type','student')->where('name' ,'LIKE', '%'.$name.'%')->get();
        return json_encode($users);

		echo var_dump($users);
	}

	public function listByCategories($id){
		$courses=Course::where('category_id',$id)->get();
		return view('courses.listByCategories',compact('courses'));
	}

	public function listTeachers(){
		$users=User::where('type','teacher')->get();
		return view('courses.listTeachers',compact('users'));
		//echo "string"; exit();
	}

	public function searchCourses(){
		$title=Request::get('searchCourses');
		if (!empty($title)) {
			# code...
			$courses = Course::where('title' ,'LIKE', '%'.$title.'%')->get();

		}else{
			$courses = Course::all();

		}
		return view('courses.index',compact('courses'));

	}

	public function searchTeachers(){

		$name=Request::get('searchTeachers');
		if (!empty($name)) {
			# code...
			$users = User::where('type','teacher')->where('name' ,'LIKE', '%'.$name.'%')->get();
		}else{
			$users = User::all();
		}
		
		return view('courses.listTeachers',compact('users'));

	}

	

}
