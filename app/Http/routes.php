<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
//Listen to queery
Event::listen('illuminate.query', function($sql)
{
   print_r("\n". $sql . "\n");
});
*/

/** 
* cache test
*/ 

/* 
Route::get('/cache'	, function(){
	$users = Cache::remember('users', 1, function()
	{
	    return App\Models\User::all();
	});
	return $users;
});
*/

/** 
* patterns
*/
Route::pattern('id', '[0-9]+'); //general

Route::get('/', function () {
    //return view('backend.home');
    $user = App\User::where('id', 1)->first();
    return $user->name();
});

//Add something
Route::get('/home', function () 
{
	return view('backend.home');
});

Route::get('/auth/register' , 'Auth\AuthController@getRegister');
Route::get('/auth/login' 	, 'Auth\AuthController@getLogin');
Route::get('/auth/logout' 	, 'Auth\AuthController@getLogout');
Route::post('/auth/register', 'Auth\AuthController@postRegister');
Route::post('/auth/login' 	, 'Auth\AuthController@postLogin');


//if Logged in
Route::group(['middleware' => 'auth'], function () 
{	
	// for testing
	//Route::get('/test', 'TestController@index' );

	/*
	* USER *
	*/
	//Show view
	Route::get('/user', 'UserController@index' );
	Route::get('/user/{id}', 'UserController@show');	
	//ajax
	Route::get('/api/v1/user', 'UserController@indexAjax' );
	Route::post('/api/v1/user', 'UserController@store');
	Route::put('/api/v1/user/{id}', 'UserController@update');
	Route::delete('/api/v1/user/{id}', 'UserController@destroy');

	/*
	* ITEM *
	*/
	Route::get('/item', 'ItemController@index' );
	Route::get('/item/{id}', 'ItemController@show');
	//ajax
	Route::get('/api/v1/item', 'ItemController@indexAjax' );
	Route::post('/api/v1/item', 'ItemController@store');
	Route::put('/api/v1/item/{id}', 'ItemController@update');
	Route::delete('/api/v1/item/{id}', 'ItemController@destroy');


	/*
	* POST
	*/
	Route::get('/post', 'PostController@index' );
	Route::get('/post/{id}', 'PostController@show');
	//ajax
	Route::get('/api/v1/post', 'PostController@indexAjax' );
	Route::post('/api/v1/post', 'PostController@store');
	Route::put('/api/v1/post/{id}', 'PostController@update');
	Route::delete('/api/v1/post/{id}', 'PostController@destroy');



	/*
	* WALL
	*/
	Route::get('/wall', 'WallController@index' );
	Route::get('/wall/{id}', 'PostController@show');
	//ajax
	Route::get('/api/v1/wall', 'WallController@indexAjax' );
	Route::post('/api/v1/wall', 'WallController@store');
	Route::put('/api/v1/wall/{id}', 'WallController@update');
	Route::delete('/api/v1/wall/{id}', 'WallController@destroy');


});