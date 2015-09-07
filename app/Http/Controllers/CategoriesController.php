<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Validator;
use Request;
use Auth;
use App\Category;

class CategoriesController extends Controller {

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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		if($this->adminAuth()){
		$categories=Category::all();
		return view('categories.index',compact('categories'));
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
		return view('categories.create');

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
        'name' => 'required|max:30|unique:categories',
       
        ]);
       
	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())
	        						 ->withInput();
	    }else{
			$category = new Category;
		    $category->name = Request::get('name');
			$category->save();
			return redirect('categories');
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
		$category=Category::find($id);
		return view('categories.edit',compact('category'));
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
        'name' => 'required|max:50',
       
        ]);
       
	    if ($v->fails())
	    {
	        return redirect()->back()->withErrors($v->errors())
	        						 ->withInput();
	    }else{

			$id=Request::get('id');
			$category=Category::find($id);
			$category->name=Request::get('name');
			$category->save();
			return redirect('categories');
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
		$categoryId = Request::get('id');
	    Category::where('id',$categoryId)->delete();
	    return redirect("categories");
	}

	public function searchCategories(){

		$name = Request::get('searchCategories');
		if (!empty($name)) {
			# code...
			$categories = Category::where('name' ,'LIKE', '%'.$name.'%')->get();
		}else{
			$categories=Category::all();
		}

		return view('categories.index',compact('categories'));
	}

}
