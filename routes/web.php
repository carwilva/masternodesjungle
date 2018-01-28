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

// Route::group(
// 	array('domain' => '127.0.0.1:8000'), function () {

	//Route::get('login', 'LoginController@showLoginPage');
	/*Route::get('dashboard', 'LoginController@login')
		 ->middleware(['auth']);

	Route::get('logout', 'LoginController@logout');*/

	/*Route::get('login/{provider}', 'LoginController@auth')
		 ->where(['provider' => 'twitter|slack']);

	Route::get('login/{provider}/callback', 'LoginController@login')
		 ->where(['provider' => 'twitter|slack']);*/


	Route::get('/', array('uses' => 'coin@index'))->middleware('throttle:6');
	Route::get('/btc', array('uses' => 'coin@indexBTC'))->middleware('throttle:6');
	Route::get('/usd', array('uses' => 'coin@indexUSD'))->middleware('throttle:6');
	Route::post('/grid_detail', array('uses' => 'coin@griddetail'))->middleware('throttle:6');
	Route::get('/registernode', array('uses' => 'coin@registernode'));
	Route::get('/readmore', array('uses' => 'coin@readmore'));
	Route::get('/sortActiveView', array('uses' => 'coin@sortActiveView'))->middleware('throttle:6');
	Route::get('/active', array('uses' => 'coin@active'))->middleware('throttle:6');
	Route::get('/active/{coin}', array('uses' => 'coin@activeCoin'))->middleware('throttle:6');
	Route::get('/soon', array('uses' => 'coin@soon'))->middleware('throttle:6');
	Route::get('/soon/{coin}', array('uses' => 'coin@soonCoin'))->middleware('throttle:6');
	Route::get('/donate', array('uses' => 'coin@donate'))->middleware('throttle:6');
	Route::get('/donate/{coin}', array('uses' => 'coin@donateCoin'))->middleware('throttle:6');
	Route::get('/callCoinAPIS', array('uses' => 'coin@callCoinAPIS'))->middleware('throttle:2');
	Route::get('/CallCoinMarketCap', array('uses' => 'coin@CallCoinMarketCap'));
	Route::get('/getPrice/{coin}', array('uses' => 'coin@GetPrice'));
	Route::get('/donateAPI', array('uses' => 'coin@donateCoinList'));
	Route::get('/vote', array('uses' => 'coin@vote'))->middleware(['auth']);
	Route::get('/register', array('uses'=>'coin@register'))->middleware(['auth']);
	Route::get('/login', array('uses'=>'coin@login'))->middleware(['auth']);
	Route::get('/addvote', array('uses'=>'coin@addvote'))->middleware(['auth']);
	Route::get('/removevote', array('uses'=>'coin@removevote'))->middleware(['auth']);
	

	/*	*/
	Route::get('admin', [
        'uses' => 'AdminController@index',
        'as'   => 'admin',
    ])->middleware(['auth']);
	Route::get('/usermanage', [
		'uses' => 'AdminController@usermanage',
		'as'   => 'adminmanage',
	]);
	Route::get('/applicant', [
		'uses' => 'AdminController@applicant',
		'as'   => 'applicant',
	]);
	Route::get('/preview', [
		'uses' => 'AdminController@preview',
		'as'	 => 'preview',
	]);
	Route::get('/savepreview', [
		'uses' => 'AdminController@savepreview',
		'as'	 => 'savepreview',
	]);
	Route::get('/addvotecoin', [
		'uses' => 'AdminController@addvotecoin',
		'as'	 => 'addvotecoin',
	]);
	Route::get('/addmaincoin', [
		'uses' => 'AdminController@addmaincoin',
		'as'	 => 'addmaincoin',
	]);
	Route::get('/removeapplicant', [
		'uses' => 'AdminController@removeapplicant',
		'as'	 => 'removeapplicant',
	]);
	Route::get('/votemanage', [
		'uses' => 'AdminController@votemanage',
		'as'	 => 'removeapplicant',
	]);
	Route::get('/delete_vote', [
		'uses' => 'AdminController@votedelete',
		'as'	 => 'removeapplicant',
	]);

	Route::get('/update_banner', [
		'uses' => 'AdminController@update_banner',
		'as'	 => 'removeapplicant',
	]);




	Route::get('update_node','AdminController@update_node');
	Route::get('delete_node','AdminController@delete_node');

	Route::get('update_user','AdminController@update_user');
	Route::get('delete_user','AdminController@delete_user');
	
	Route::get('/detail','coin@detailinfo');

	Route::post('/currencybtc','coin@btclist');
	
	/*  Stats Pages */
	Route::group(
		['prefix' => '/stats/{coin}/api', 'middleware' => 'throttle:2'], function () {
		Route::get('/datapack', array('uses' => 'stats@DataPack'));
	}
	);
	Route::get('/stats/{coin}', array('as' => 'statsIndex', 'uses' => 'stats@index'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/list', array('as' => 'advlist', 'uses' => 'stats@moreList'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/stats', array('as' => 'advstats', 'uses' => 'stats@moreStats'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/map', array('as' => 'advmap', 'uses' => 'stats@moreMap'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/graph', array('as' => 'advgraph', 'uses' => 'stats@moreLineGraphs'))->middleware('throttle:6');
	Route::get('/stats/{coin}/advanced/graph/data/', array('as' => 'mlgdata', 'uses' => 'stats@moreLineGraphsData'))->middleware('throttle:6');
	Route::get('/stats/{coin}/nodedetails/', array('as' => 'nodedetails', 'uses' => 'stats@nodeDetails'))->middleware('throttle:6');
	Route::get('/stats/{coin}/guides/', array('as' => 'guides', 'uses' => 'stats@guides'))->middleware('throttle:6');
// }
// );

// Route::group(
// 	array('domain' => '{account}.127.0.0.1:8000'), function () {
// 	Route::get(
// 		'/', function ($account) {
// 		if ($account === 'www') {
// 			return Redirect::to('http://127.0.0.1:8000/');
// 		} else {
// 			return Redirect::to('http://127.0.0.1:8000/stats/' . $account);
// 		}
// 	}
// 	);
// }
// );
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
