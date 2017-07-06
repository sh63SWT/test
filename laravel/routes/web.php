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

Route::get('/', function () {
    return view('welcome');
});
Route::get('nav',function () {
    return view('home.header');
});

//前台用户登录
Route::get('/home/login', 'Home\UserController@loginForm');//登录页面
Route::get('/home/logintel','Home\UserController@logintel');//登录时手机验证
Route::post('/home/tologin', 'Home\UserController@tologin');//开始登录过程

//前台用户注册
Route::get('/home/register', 'Home\UserController@registerForm');//注册页面
Route::get('/home/sendSms', 'Home\UserController@sendSms');//手机验证码
Route::post('/home/regval', 'Home\UserController@regval');//开始注册

Route::get('/home/forgetpass','Home\ProblemController@forgetPass');//跳转忘记密码页面
Route::get('/home/getpass/{id}','Home\AnswerController@getPass');//找回密码
Route::post('/home/getanswer','Home\ProblemController@getAnswer');//提交密码
Route::get('/home/gettel','Home\ProblemController@gettel');//提交手机验证
Route::get('/home/getproblem','Home\ProblemController@getproblem');//提交答案验证

//前台模块(防止恶意登录)
Route::group(['middleware' => 'user.login'],function () {
    Route::get('/home/logout', 'Home\UserController@logout');//退出登录
    Route::get('/home/vipUpdate','Home\UserController@vipUpdate');//个人资料修改
    Route::post('/home/vipUpdate','Home\UserController@tovipUpdate');
    Route::get('/logincap','Home\UserController@logincap');

    Route::get('/vipCare','Home\CareController@careList');
    Route::get('/vipVer','Home\VerController@verList');
    Route::get('/home/delver/{id}','Home\VerController@delver');
    Route::get('/home/addver/{id}','Home\VerController@addver');
    Route::get('/home/addcare/{id}','Home\CareController@addcare');
    Route::get('/home/delcare/{id}','Home\CareController@delcare');
    Route::get('/care/catList/{id}','Home\CatController@catList');
    Route::post('/home/sendcat','Home\CatController@catAdd');
    Route::get('/home/delcat/{id}','Home\CatController@catDel');
});

//后台登录
Route::get('/admin/login', 'Admin\AdminController@loginForm');//登录
Route::any('/admin/doLogin', 'Admin\AdminController@doLogin');//去登录
Route::any('/admin/emails', 'Admin\AdminController@emails');//去登录
Route::get('/user/phones', 'Admin\UserController@phones');//ajax验证手机号码
Route::get('/user/emails', 'Admin\UserController@emails');//ajax验证手机号码
//后台模块(防止恶意登录)
Route::group(['middleware' => 'check.login'],function () {
    Route::get('/admin/logout', 'Admin\AdminController@logout');//退出登录

    //管理员管理
    Route::get('/admin-list','Admin\AdminController@adminList');
    Route::get('/admin-toAdd','Admin\AdminController@adminToAdd');
    Route::post('/admin-add','Admin\AdminController@adminAdd');
    Route::get('/admin-Update/{id}','Admin\AdminController@adminToUpdate');
    Route::post('/admin-Update/{id}','Admin\AdminController@adminUpdate');
    Route::get('/emails','Admin\AdminController@adminEmails');
//    Route::get('/emailss','Admin\AdminController@adminUser');
    Route::get('/admin-delete/{id}','Admin\AdminController@adminDelete');
    //用户管理
    Route::get('/user-list','Admin\UserController@userList');
    Route::get('/answer-list','Admin\AnswerController@answerList');
    Route::get('/answer-toAdd','Admin\AnswerController@answerAdd');
    Route::post('/answer-add','Admin\AnswerController@answertoAdd');
    Route::get('/answer-upd/{id}','Admin\AnswerController@answerUpd');
    Route::post('/answer-upd','Admin\AnswerController@answertoUpd');
    Route::get('/answer-del/{id}','Admin\AnswerController@answerDel');
    Route::get('/user-toAdd','Admin\UserController@userToAdd');
    Route::post('/user-add','Admin\UserController@userAdd');


    Route::get('/user-status/{id}/{status}','Admin\UserController@status');
    Route::get('/user-update/{id}','Admin\UserController@update');
    Route::post('/user-update/{id}','Admin\UserController@toUpdate');
    Route::get('/user-delete/{id}','Admin\UserController@userDel');
    Route::get('/user-care/{id}/{sta}','Admin\CareController@userCare');
    Route::get('/user-delcare/{id}','Admin\CareController@delcare');
    Route::get('/user-ver/{id}/{sta}','Admin\VerController@userVer');
    Route::get('/user-delver/{id}','Admin\VerController@delVer');

});