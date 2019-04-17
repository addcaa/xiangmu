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
Route::get('/aa','GoodsController@aa');
Route::get('/', function () {
    return view('welcome');
});
//登录
Route::any('Login/login_do','LoginContoller@login_do');

//管理员添加
Route::get('User/index','UserController@index');
Route::get('User/create','UserController@create');
Route::post('User/store','UserController@store');
Route::get('User/show','UserController@show');
Route::any('User/destroy','UserController@destroy');
Route::any('User/edit','UserController@edit');
Route::any('User/update','UserController@update');

// 公告
Route::any('Ads/add','AdsController@add');
Route::post('Ads/add_do','AdsController@add_do');
Route::any('Ads/index','AdsController@index');
Route::any('Ads/destroy{id}','AdsController@destroy');
Route::any('Ads/edit{id}','AdsController@edit');
Route::any('Ads/update','AdsController@update');

//友情链接
Route::any('Link/add','LinkController@add');
Route::any('Link/add_do','LinkController@add_do');
Route::any('Link/index','LinkController@index');
Route::any('Link/destroy','LinkController@destroy');
Route::any('Link/edit{l_id}','LinkController@edit');
Route::any('Link/update','LinkController@update');
Route::any('Link/only','LinkController@only');

// Route::get('goods','showController@goods');
// Route::get('dome','showController@goods');

//前台商品

Route::any('/','GoodsController@index');
Route::any('goods/proinfo{id}','GoodsController@proinfo');
Route::any('goods/prolist','GoodsController@prolist');
Route::any('goods/typeid','GoodsController@typeid');
Route::any('goods/div','GoodsController@div');
Route::any('goods/caradd','GoodsController@caradd');
Route::any('goods/car','GoodsController@car');
Route::any('goods/ace','GoodsController@ace');
Route::any('goods/gercarPrice','GoodsController@gercarPrice');
Route::any('goods/callect','GoodsController@callect');
Route::any('goods/shoucang','GoodsController@shoucang');
Route::any('goods/shoucangdel','GoodsController@shoucangdel');
Route::any('goods/browse','GoodsController@browse');
Route::any('goods/liul','GoodsController@liul');
Route::any('goods/pay','GoodsController@pay');
Route::any('goods/pays','GoodsController@pays');
Route::any('goods/success','GoodsController@success');
Route::any('goods/jiesuan','GoodsController@jiesuan');
Route::any('goods/orrder/{id}','GoodsController@orrder');
Route::any('goods/alipay','GoodsController@alipay');
Route::any('goods/tell','GoodsController@tell');




Route::any('login/register','LoginContoller@register');
Route::any('login/reg','LoginContoller@reg');
Route::any('login/user','LoginContoller@user');
Route::any('login/login','LoginContoller@login');
Route::any('login/tui','LoginContoller@tui');
Route::any('login/users','LoginContoller@users');
Route::any('login/add_address','LoginContoller@add_address');
Route::any('login/address','LoginContoller@address');
Route::any('login/getArea','LoginContoller@getArea');
Route::any('login/addressDo','LoginContoller@addressDo');
Route::any('login/email','LoginContoller@email');
Route::any('login/order','LoginContoller@order');
Route::any('login/orders','LoginContoller@orders');


Route::any('Show/index','ShowController@index');
Route::any('Show/dome','ShowController@dome');
Route::any('Show/login','ShowController@login');
Route::any('Show/submit','ShowController@submit');
Route::any('Show/wj','ShowController@wj');
Route::any('Show/do','ShowController@do');
Route::any('Show/a','ShowController@do');

Route::any('blog/index','BlogController@index');
Route::any('blog/email','BlogController@email');

//路由参数
// Route::get('/show/{id}',function($id){
//     echo 'id是:'.$id;
// })->where('id','[0-9]+');
// Route::get('show',function(){
//     return view('show.show',['name'=>'连世杰']);
// });
// Route::match(['get','post'],'goods',function(){
//     return 'Hello, hello';
// });
// Route::get('show',function(){
//     return'<form method="POST" action="goods">'.csrf_field().'<button type="submit">链接</button></form>';
// });

// Route::redirect('/show','/dome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
