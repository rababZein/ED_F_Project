<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Request;
use Validator;
use Auth;
use App\User;

class UsersController extends Controller {

	
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
		if($this->adminAuth()){
			$users=User::all();
			return view('users.index',compact('users'));
		}else{
			return view('errors.404');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
       if($this->adminAuth()){

		   return view('users.create');
	   }else{
			return view('errors.404');
	   }

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
        'name' => 'required|max:255',
		'email' => 'required|email|max:255|unique:users',
		'password' => 'required|confirmed|min:6',
       
        ]);
       
	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())
	        						 ->withInput();
	    }else{
			$user = new User;

		    $user->name = Request::get('name');
            $user->email = Request::get('email');
		    $user->password = bcrypt(Request::get('password'));
		    $user->type = Request::get('type');
			$user->save();
			return redirect('users');
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

		$user=User::find($id);
		return view('users.show',compact('user'));
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
		if($this->adminAuth() || $this->userAuth($id)){

			$user=User::find($id);
			return view('users.edit',compact('user'));
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
		//echo "string"; exit();
		$v = Validator::make(Request::all(), [
        'name' => 'required|max:255',
		'email' => 'required|email|max:255',
		//'password' => 'required|confirmed|min:6',
       
        ]);
       
	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())
	        						 ->withInput();
	    }else{

			$id=Request::get('id');
			$user=User::find($id);
			$user->name = Request::get('name');
			$user->type = Request::get('type');

           // $user->email = Request::get('email');
		  //  $user->password = bcrypt(Request::get('password'));
		   
			$user->save();
			return redirect('users');
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
		$userId = Request::get('id');
	    User::where('id',$userId)->delete();
	    return redirect("users");
	}

	public function searchStudents(){

		$name=Request::get('searchStudents');
		if (!empty($name)) {
			# code...
			$users = User::where('type','student')->where('name' ,'LIKE', '%'.$name.'%')->get();
		}else{
			$users = User::all();
		}
		
		return view('users.listStudents',compact('users'));

	}


}
