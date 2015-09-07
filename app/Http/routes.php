<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('home');
// });

Route::get('/charts', function()
{
	return View::make('mcharts');
});

Route::get('/tables', function()
{
	return View::make('table');
});

Route::get('/forms', function()
{
	return View::make('form');
});

Route::get('/grid', function()
{
	return View::make('grid');
});

Route::get('/buttons', function()
{
	return View::make('buttons');
});


Route::get('/icons', function()
{
	return View::make('icons');
});

Route::get('/panels', function()
{
	return View::make('panel');
});

Route::get('/typography', function()
{
	return View::make('typography');
});

Route::get('/notifications', function()
{
	return View::make('notifications');
});

Route::get('/blank', function()
{
	return View::make('blank');
});

// Route::get('/login', function()
// {
// 	return View::make('login');
// });

Route::get('/documentation', function()
{
	return View::make('documentation');
});



/*******************************************************/

Route::post('/courses/searchTeachers','CoursesController@searchTeachers');

Route::get('/courses/searchTeachers','CoursesController@searchTeachers');

Route::post('/courses/searchCourses','CoursesController@searchCourses');

Route::get('/courses/searchCourses','CoursesController@searchCourses');

Route::post('/users/searchStudents','UsersController@searchStudents');

Route::get('/users/searchStudents','UsersController@searchStudents');

Route::post('/categories/searchCategories','CategoriesController@searchCategories');

Route::get('/categories/searchCategories','CategoriesController@searchCategories');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/home', 'HomeController@index');

Route::resource('/users','UsersController');

Route::resource('/categories','CategoriesController');

Route::resource('/courses','CoursesController');

Route::get('/courses/invite/{id}','CoursesController@invite');

Route::post('/courses/sendinvitation','CoursesController@sendinvitation');

Route::post('/courses/inviteAll','CoursesController@inviteAll');

Route::get('/courses/outsideInvitation/{id}','CoursesController@outsideInvitation');

Route::post('/courses/inviteOutsideStudent','CoursesController@inviteOutsideStudent');

Route::post('/courses/searchStudent','CoursesController@searchStudent');

Route::get('/courses/listByCategories/{id}','CoursesController@listByCategories');

Route::get('/courses/listTeachers','CoursesController@listTeachers');



