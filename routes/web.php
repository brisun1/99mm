<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//   return view('welcome');
// });
Route::get('/', 'PagesController@index');
Route::get('/massage', 'PagesController@massage');
Route::get('/baoyang', 'PagesController@baoyang');
Route::get('/ptmiss', 'PagesController@ptmiss');
Route::get('/contract', 'PagesController@contract');
Route::get('/more', 'PagesController@more');
Route::get('/help', 'PagesController@help')->name('help');
//Route::resource('posts', 'PostsController');
Route::resource('misss', 'MisssController');
Route::resource('ptmisss', 'PtmisssController');
Route::resource('massages', 'MassagesController');
Route::resource('contracts', 'ContractsController');
//Route::resource('mores', 'MoresController');
//Route::get('/baoyangs/edit', function () {
 // return view('posts.baoyang_edit');
 // });
Route::resource('baoyangs', 'BaoyangsController');
Route::resource('escorths', 'EscorthsController');
Route::resource('escortbs', 'EscortbsController');

Auth::routes();

Route::get('/initprice', 'AdminController@initprice');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/gmap', function () {
     return view('gmap');
   });
Route::get('/geo', function () {
return view('posts.geocode');
});
Route::get('/geot', function () {
  return view('posts.geocodet');
  });
Route::get('/geog', function () {
  return view('posts.geocodeg');
  });
Route::get('/createTbl', 'CreateTblController@createTbl');
/*App::bind('App\Billing\Stripe', function(){
  return new \App\Billing\Stripe(config('services.stripe.secret'));
});
**/
//$stripe=App::;
//dd(resolve('App\Billing\Stripe'));
Route::get('/dook', 'TestController@doAwesome');
Route::post('/email', 'HelpsController@email');
//Route::get('/email', 'HelpsController@email')->name('sendEmail');


Auth::routes();
Route::group(['middleware' => 'auth'], function() {
  
  //Route::post('/pay/{amt}', 'DashboardController@pay')->name('pay');
    Route::get('/plans', 'PlanController@index')->name('plans.index');
    Route::get('/plans/{plan}', 'PlanController@show')->name('plans.show');
    Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');
});



Route::get('/listprice/{amt}/{period}', 'PayController@listprice');
//Route::get('/customerPay/{cus_type}/{user_id}', 'PayController@customerPay');
Route::get('/customerPay/{user_id}/{cus_type}', 'PayController@customerPay');

Route::post('/webhook', 'PayController@webhook');
Route::get('/webhook', 'PayController@webhook');
Route::post('/onceoff_hook', 'PayController@onceoff_hook');
Route::get('/onceoff_hook', 'PayController@onceoff_hook');

//Route::get('/checkout', 'PayController@checkout_server');





