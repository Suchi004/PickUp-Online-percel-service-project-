<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','Frontend\PagesController@index')->name('index');
Route::get('/contact','Frontend\PagesController@contact')->name('contact');

//Product routes.. All the products are here for frontend....


//post routes
   Route::group(['prefix' => '/posts'],function(){
    Route::get('/','Frontend\PostController@index')->name('posts');
    Route::get('/myPost','Frontend\PostController@my')->name('Myposts');
    Route::get('/create','Frontend\PostController@create')->name('post.create');
    Route::get('/{slug}','Frontend\PostController@show')->name('post.show');
    Route::get('/edit/{id}','Frontend\PostController@edit')->name('post.edit');
    Route::get('/new/search','Frontend\PagesController@search')->name('search');
    //above get request changing to post for test

    // below post request
    Route::post('/store','Frontend\PostController@store')->name('post.store');
    Route::post('/edit/{id}','Frontend\PostController@update')->name('post.update');
    Route::post('/delete/{id}','Frontend\PostController@delete')->name('post.delete');

    Route::get('/categories','Frontend\CategoriesController@index')->name('categories.index');
    Route::get('/category/{id}','Frontend\CategoriesController@show')->name('categories.show');
});

//User routes
  Route::group(['prefix'=>'/user'],function(){
    Route::get('/token/{token}','Frontend\VerificationController@verify')->name('user.verify');
    Route::get('/dashboard','Frontend\UserController@dashboard')->name('user.dashboard');
    Route::get('/profile','Frontend\UserController@profile')->name('user.profile');
    Route::get('/show/{id}','Frontend\UserController@show')->name('user.show');
    Route::post('/profile/update','Frontend\UserController@update')->name('user.profile.update');
    Route::post('/profile/review','Frontend\UserReviewController@store')->name('review.store');

  //  Route::get('/order','Frontend\UserOrderController@order')->name('user.order');
  //  Route::get('/view/{id}','Frontend\UserOrdersController@show')->name('user.order.show');
  //  Route::post('/completed/{id}','Frontend\UserOrdersController@completed')->name('user.order.completed');
  //  Route::post('/paid/{id}','Frontend\UserOrdersController@paid')->name('user.order.paid');
  });

  //carts routes
  Route::group(['prefix'=>'/cart'],function(){
    Route::get('/','Frontend\CartsController@index')->name('carts');
    Route::post('/store','Frontend\CartsController@store')->name('carts.store');
    Route::post('/update/{id}','Frontend\CartsController@update')->name('carts.update');
    Route::post('/delete/{id}','Frontend\CartsController@destroy')->name('carts.delete');
  });
  //checkout routes

   Route::group(['prefix'=>'checkout'],function(){
    Route::get('/','Frontend\CheckoutsController@index')->name('checkouts');
    Route::post('/store','Frontend\CheckoutsController@store')->name('checkout.store');
  });



   //admin routes
   Route::group(['prefix'=>'/admin'],function(){

   //admin log in route
  Route::get('/login','Auth\Admin\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login/submit','Auth\Admin\LoginController@login')->name('admin.login.submit');
  Route::get('/','Backend\PagesController@index')->name('admin.index');
  Route::post('/logout','Auth\Admin\LoginController@logout')->name('admin.logout');
  //password email send
  Route::get('/password/reset/req','Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/resetPost','Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

  //password Reset
  Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
  Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('admin.password.update');

   //Admin product routes
   Route::group(['prefix'=>'/products'],function(){
   Route::get('/','Backend\ProductController@manage')->name('admin.products');
   Route::get('/create','Backend\ProductController@create')->name('admin.product.create');
   Route::get('/edit/{id}','Backend\ProductController@edit')->name('admin.product.edit');
   Route::post('/store','Backend\ProductController@store')->name('admin.product.store');
   Route::post('/update/{id}','Backend\ProductController@update')->name('admin.product.update');
    Route::post('/delete/{id}','Backend\ProductController@delete')->name('admin.product.delete');
    });
    //order routes
    Route::group(['prefix'=>'/orders'],function(){
    Route::get('/','Backend\OrdersController@index')->name('admin.orders');
    Route::get('/view/{id}','Backend\OrdersController@show')->name('admin.order.show');
    Route::post('/delete/{id}','Backend\OrdersController@delete')->name('admin.order.delete');
    Route::post('/completed/{id}','Backend\OrdersController@completed')->name('admin.order.completed');
    Route::post('/paid/{id}','Backend\OrdersController@paid')->name('admin.order.paid');
     });

   //Category routes
   Route::group(['prefix'=>'/categories'],function(){
   Route::get('/','Backend\CategoryController@index')->name('admin.categories');
   Route::get('/create','Backend\CategoryController@create')->name('admin.category.create');
   Route::post('/store','Backend\CategoryController@store')->name('admin.category.store');
   Route::get('/edit/{id}','Backend\CategoryController@edit')->name('admin.category.edit');
   Route::post('/update/{id}','Backend\CategoryController@update')->name('admin.category.update');
   Route::post('/delete/{id}','Backend\CategoryController@delete')->name('admin.category.delete');
    });

   Route::group(['prefix'=>'/divisions'],function(){
   Route::get('/','Backend\DivisionController@index')->name('admin.divisions');
   Route::get('/create','Backend\DivisionController@create')->name('admin.division.create');
   Route::post('/store','Backend\DivisionController@store')->name('admin.division.store');
   Route::get('/edit/{id}','Backend\DivisionController@edit')->name('admin.division.edit');
   Route::post('/update/{id}','Backend\DivisionController@update')->name('admin.division.update');
   Route::post('/delete/{id}','Backend\DivisionController@delete')->name('admin.division.delete');
    });
    //post RouteServiceProvider
    Route::group(['prefix'=>'/posts'],function(){
    Route::get('/','Backend\PostController@index')->name('admin.posts');
    Route::get('/{slug}','Backend\PostController@show')->name('admin.posts.show');
    Route::post('/delete/{id}','Backend\PostController@delete')->name('admin.posts.delete');
  });
  //user RouteServiceProvider
  Route::group(['prefix'=>'/users'],function(){
  Route::get('/','Backend\UserController@index')->name('admin.users');
  Route::get('/{slug}','Backend\UserController@show')->name('admin.users.show');
  Route::post('/delete/{id}','Backend\UserController@delete')->name('admin.users.delete');
});
   Route::group(['prefix'=>'/districts'],function(){
   Route::get('/','Backend\DistrictController@index')->name('admin.districts');
   Route::get('/create','Backend\DistrictController@create')->name('admin.district.create');
   Route::post('/store','Backend\DistrictController@store')->name('admin.district.store');
   Route::get('/edit/{id}','Backend\DistrictController@edit')->name('admin.district.edit');
   Route::post('/update/{id}','Backend\DistrictController@update')->name('admin.district.update');
   Route::post('/delete/{id}','Backend\DistrictController@delete')->name('admin.district.delete');
    });

    Route::group(['prefix'=>'/sliders'],function(){
    Route::get('/','Backend\SliderController@index')->name('admin.sliders');
    Route::post('/store','Backend\SliderController@store')->name('admin.slider.store');
    Route::post('/update/{id}','Backend\SliderController@update')->name('admin.slider.update');
    Route::post('/delete/{id}','Backend\SliderController@delete')->name('admin.slider.delete');
     });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//API Route
Route::get('/get-dictricts/{id}',function($id)
{
  return json_encode( App\Models\District::where('division_id',$id)->get());
});
