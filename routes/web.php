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



Route::get('/','HomeController@Welcome')->name('Welcome');
Route::get('/login/page', 'HomeController@LoginPage')->name('LoginPage');
Route::get('/register/page', 'HomeController@RegisterPage')->name('RegisterPage');
Route::get('login', 'HomeController@Login')->name('Login');
Route::get('logout','HomeController@Logout')->name('Logout');
Route::get('create','HomeController@Create')->name('Create');
Route::get('reset/pass/','HomeController@ResetPass')->name('ResetPass');
Route::get('send/pass','HomeController@SendPass')->name('SendPass');
Route::get('test','HomeController@Test')->name('Test');
Route::get('pass/edit/{id?}','HomeController@EditPass')->name('EditPass');
Route::get('pass/confirm','HomeController@PassConfirm')->name('PassConfirm');



Route::middleware(['userCheck'])->group(function () {
    Route::get('question/page','HomeController@QuestionPage')->name('QuestionPage');
    Route::get('question/create','HomeController@QuestionCreate')->name('QuestionCreate');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('partner','HomeController@Partner')->name('Partner');
    Route::get('courses', 'HomeController@Courses')->name('Courses');
    Route::get('profile', 'HomeController@Profile')->name('Profile');
    Route::get('bonus','HomeController@Bonus')->name('Bonus');
    Route::get('account/Create','HomeController@AccountCreate')->name('AccountCreate');
    Route::get('withdraws','HomeController@Withdraws')->name('Withdraws');
    Route::get('withdraws/create','HomeController@WithdrawCreate')->name('WithdrawCreate');
    Route::get('refill/balance','HomeController@RefillBalance')->name('RefillBalance');
    Route::get('fail/payment','HomeController@FailPayment')->name('FailPayment');
    Route::get('success/refill','HomeController@SuccessRefill')->name('SuccessRefill');

    Route::get('Instadesign','HomeController@InstaDesign')->name('InstaDesign');
    Route::get('success/acc','HomeController@SuccessAcc')->name('SuccessAcc');

    Route::get('course/{id?}','HomeController@Course')->name('Course');

});

Route::get('admin','AdminController@Admin')->name('Admin');

Route::get('admin/login','AdminController@AdminLogin')->name('AdminLogin');
Route::name('admin.')->prefix('admin')->middleware(['adminCheck'])->group(function () {
    Route::get('accept/withdraw/{id}','AdminController@AcceptWithdraw')->name('AcceptWithdraw');
    Route::get('users','AdminController@Users')->name('Users');
    Route::get('courses','AdminController@Courses')->name('Courses');
    Route::post('/create/courses','AdminController@CreateCourse')->name('CreateCourse');
    Route::get('user/{id?}','AdminController@User')->name('User');
    Route::get('home','AdminController@Home')->name('Home');
    Route::get('create/cat','AdminController@CreateCat')->name('CreateCat');
    Route::get('answer','AdminController@Answer')->name('Answer');
    Route::get('answer/create','AdminController@AnswerCreate')->name('AnswerCreate');
    Route::get('withdraws','AdminController@Withdraws')->name('Withdraws');
    Route::get('user/accept/{id}','AdminController@UserAccept')->name('UserAccept');
});
