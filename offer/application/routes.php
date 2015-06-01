<?php


/*******************************************************************************************************/

// Whatmobile
Route::get('whatmobile/(:any?)', array('uses' => 'whatmobile@index'));
Route::post('whatmobile/(:any?)', array('uses' => 'whatmobile@index'));
Route::get('whatmobile/thanks', array('uses' => 'whatmobile@thanks'));
Route::get('whatmobile/download', array('uses' => 'whatmobile@download'));
/*******************************************************************************************************/
// Vfcb
Route::get('vfcb/(:any?)', array('uses' => 'vfcb@index'));
Route::post('vfcb/(:any?)', array('uses' => 'vfcb@index'));
Route::get('vfcb/form', array('uses' => 'vfcb@form'));
Route::post('vfcb/form', array('uses' => 'vfcb@form'));
Route::get('vfcb/thanks', array('uses' => 'vfcb@thanks'));
/*******************************************************************************************************/
//Ipraynow
Route::get('ipraynow/(:any?)', array('uses' => 'ipraynow@index'));
Route::post('ipraynow/(:any?)', array('uses' => 'ipraynow@index'));
Route::get('ipraynow/thanks', array('uses' => 'ipraynow@thanks'));
Route::post('ipraynow/thanks', array('uses' => 'ipraynow@thanks'));
/*******************************************************************************************************/
Route::controller(Controller::detect());


Route::get('/', 'hellomobiles@index');

Route::get('/(:any)', 'hellomobiles@index');


/*Route::get('/askmegan', array('users' => 'askmegan@index'));
Route::get('/askmegan/(:any)', array('users' => 'askmegan@index'));
Route::get('/askmegan/thanks', array('users' => 'askmegan@thanks'));*/




/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('laravel.query', function($sql, $bindings, $time) 
{
	//echo $sql,  '</br>';
	//return ;
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});