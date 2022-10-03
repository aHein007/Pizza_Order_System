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

Route::get('/', function () {
    return view('welcome');
});

Route::group(["prefix"=>"admin","namespace"=>"Admin"],function(){
    //admin logout
    Route::get("adminLogout","adminLogOutController@adminLogout")->name("admin#Logout");
    //admin Page
    Route::get("adminPage","adminController@adminPage")->name("admin#page");
    //admin update Data
    Route::post("updateData/{id}","adminController@updateData")->name("admin#update");
    //admin change passoword
    Route::get("changePasswordPage","adminController@changePasswordPage")->name("admin#changePasswordPage");
    //admin change password process
    Route::post("changePassword/{id}","adminController@changePassword")->name("admin#changePassword");


    //Category Page
    Route::get("categoryPage","CategoryController@categoryPage")->name("admin#categoryPage");

    //Category count Page
    Route::get("userCount/{id}","CategoryController@countItemsPage")->name("admin#countItemsPage");

    //Add Category Page
    Route::get("addCategoryPage","CategoryController@addCategoryPage")->name("admin#addCategoryPage");

    //Add Category Process
    Route::post("addCategoryProcess","CategoryController@addCategoryProcess")->name("admin#addCategoryProcess");

    //category Delete
    Route::get("categoryDelete/{id}","CategoryController@categoryDelete")->name("admin#categoryDelete");

    //category Update
    Route::get("categoryUpdatePage/{id}","CategoryController@categoryUpdatePage")->name("admin#categoryUpdatePage");

    //category Update
    Route::post("categoryUpdate/{id}","CategoryController@categoryUpdate")->name("admin#categoryUpdate");

    //category Search
    Route::get("categoryPage/search","CategoryController@categorySearch")->name("admin#categorySearch");

    //PizzaPage
    Route::get("pizzaPage","PizzaController@pizzaPage")->name("admin#pizzaPage");

    //addPizza page
    Route::get("addPizzaPage","PizzaController@addPizzaPage")->name("admin#addPizzaPage");

    //add pizza process
    Route::post("addPizzaProcess","PizzaController@addPizzaProcess")->name("admin#addPizzaProcess");

    //seemore page
    Route::get("seeMorePage/{id}","PizzaController@seeMorePage")->name("admin#seeMorePage");

    //Pizza Delete
    Route::get("delete/{id}","PizzaController@deletePizza")->name("admin#deletePizza");

    //Pizza Update
    Route::get("updatePizzaPage/{id}","PizzaController@updatePizzaPage")->name("admin#updatePizzaPage");

    //pizza Update Process
    Route::post("updatePizza/{id}","Pizzacontroller@updatePizza")->name("admin#updatePizza");

    //pizza search
    Route::get("pizzaPage/search","PizzaController@pizzaSearch")->name("admin#pizzaSearch");

    //User Page
    Route::get("userPage","UserPageController@userPage")->name("admin#userPage");

    //for admin role page
    Route::get("adminRolePage","UserPageController@adminRole")->name("admin#adminRole");

    //for user Role page
    Route::get("userRolePage","UserPageController@userRole")->name("admin#userRole");

    //user page - admin role search
    Route::get("adminRole/search","UserPageController@adminSearch")->name("admin#adminSearch");

    //user page - user role search
    Route::get("userRole/search","UserPageController@userSearch")->name("admin#userSearch");

    //user account delete
    Route::get("userDelete/{id}","UserPageController@userDelete")->name("admin#userDelete");

    //contact Page
    Route::get("contactPage","ContactController@contactPage")->name("admin#contactPage");

    //contact Delete
    Route::get("contactDelete/{id}","ContactController@contactDelete")->name("admin#contactDelete");

    //contact Search
    Route::get("contactPage/search","ContactController@contactSearch")->name("admin#contactSearch");
});

Route::group(["prefix"=>"user","namespace"=>"User"],function(){
    //UserLog out
    Route::get("userLogout","userController@userLogout")->name("user#Logout");

    //User Page
    Route::get("userPageSite","ContactController@userPageSite")->name("user#userPageSite");

    //user contact
    Route::post("userContact","ContactController@userContact")->name("user#userContact");

    //user orderNow Card Detail
    Route::get("OrderDetailPage/{id}","OrderDetailController@orderDetailPage")->name("user#orderDetailPage");

    //user order Page
    Route::get("orderBuy/{id}","OrderDetailController@orderBuy")->name("user#orderBuy");

    //user order process
    Route::post("orderProcess","OrderDetailController@orderProcess")->name("user#orderProcess");

    //serarch bar
    Route::get("userPageSite/search","ContactController@searchBar")->name("user#userSearchBar");

    //click category process
    Route::get("userPageSite/search/{id}","ContactController@clickSearch")->name("user#clickSearch");

    //min & mix price
    Route::get("minPrice","ContactController@minPrice")->name("user#minPrice");
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role == "admin"){
                return redirect()->route("admin#page");
            }else{
                return redirect()->route("user#userPageSite");
            }
        }
    })->name('dashboard');


});
