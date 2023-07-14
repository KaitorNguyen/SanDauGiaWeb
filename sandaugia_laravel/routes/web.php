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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/search', ['as'=>'searchProducts', 'uses'=>'ProductController@showSearchProduct']);

//Customer_Routes
Route::get('home/products/details/{ProductID}', ['as'=>'detailProduct', 'uses'=>'ProductController@getProductDetail']);
Route::post('home/products/details/{ProductID}', ['as'=>'insertAuction', 'uses'=>'AuctionController@insertAuction'])->middleware(['auth']);

Route::get('home/categories/All Product', ['as'=>'allProduct', 'uses'=>'HomeController@index']);
Route::get('home/categories/{CategoryName}', ['as'=>'getCategoryProduct', 'uses'=>'CategoryController@getCategoryProduct']);

Route::get('home/carts', ['as'=>'getCarts', 'uses'=>'BillController@showProductAuction']);

Route::get('home/carts/payment/{ProductID}', ['as'=>'addBill', 'uses'=>'BillController@addBill']);
Route::post('home/carts/payment/{ProductID}', ['as'=>'insertBill', 'uses'=>'BillController@insertBill']);



//ADMIN_ROUTES
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('categories', ['as' =>'listCategory', 'uses'=>'CategoryController@index']);

    // Route::get('/admin/categories/add', ['as'=>'addCategory', 'uses'=>'CategoryController@addCategory'])->middleware(['auth']);
    Route::post('/categories', ['as'=>'insertCategory', 'uses'=>'CategoryController@insertCategory']);
    Route::get('/categories/edit/{CategoryID}', ['as'=>'editCategory', 'uses'=>'CategoryController@editCategory']);
    Route::put('/categories/edit/{CategoryID}', ['as'=>'updateCategory', 'uses'=>'CategoryController@updateCategory']);
    Route::get('/categories/delete/{CategoryID}', ['as'=>'deleteCategory', 'uses'=>'CategoryController@deleteCategory']);
    
    Route::get('/products', ['as'=>'listProduct', 'uses'=>'ProductController@index']);
    Route::get('/products/add', ['as'=>'addProduct', 'uses'=>'ProductController@addProduct']);
    Route::post('/products/add', ['as'=>'insertProduct', 'uses'=>'ProductController@insertProduct']);
    Route::get('/products/edit/{ProductID}', ['as'=>'editProduct', 'uses'=>'ProductController@editProduct']);
    Route::put('/products/edit/{ProductID}', ['as'=>'updateProduct', 'uses'=>'ProductController@updateProduct']);
    Route::get('/products/delete/{ProductID}', ['as'=>'deleteProduct', 'uses'=>'ProductController@deleteProduct']);
    
    Route::get('/users', ['as'=>'listUser', 'uses'=>'UserController@index']);
    Route::get('/users/lockUser/{UserID}', ['as'=>'lockUser', 'uses'=>'UserController@lockUser']);
});

Route::get('/home/dashboard', ['as'=>'errorMessage', 'uses'=>'HomeController@dashboard']);


// Route::get('/admin/categories', ['as' =>'listCategory', 'uses'=>'CategoryController@index']);

// // Route::get('/admin/categories/add', ['as'=>'addCategory', 'uses'=>'CategoryController@addCategory'])->middleware(['auth']);
// Route::post('/admin/categories', ['as'=>'insertCategory', 'uses'=>'CategoryController@insertCategory']);
// Route::get('/admin/categories/edit/{CategoryID}', ['as'=>'editCategory', 'uses'=>'CategoryController@editCategory']);
// Route::put('/admin/categories/edit/{CategoryID}', ['as'=>'updateCategory', 'uses'=>'CategoryController@updateCategory']);
// Route::get('/admin/categories/delete/{CategoryID}', ['as'=>'deleteCategory', 'uses'=>'CategoryController@deleteCategory']);

// Route::get('/admin/products', ['as'=>'listProduct', 'uses'=>'ProductController@index']);
// Route::get('/admin/products/add', ['as'=>'addProduct', 'uses'=>'ProductController@addProduct']);
// Route::post('/admin/products/add', ['as'=>'insertProduct', 'uses'=>'ProductController@insertProduct']);
// Route::get('/admin/products/edit/{ProductID}', ['as'=>'editProduct', 'uses'=>'ProductController@editProduct']);
// Route::put('/admin/products/edit/{ProductID}', ['as'=>'updateProduct', 'uses'=>'ProductController@updateProduct']);
// Route::get('/admin/products/delete/{ProductID}', ['as'=>'deleteProduct', 'uses'=>'ProductController@deleteProduct']);

// Route::get('/admin/users', ['as'=>'listUser', 'uses'=>'UserController@index']);
// Route::get('/admin/users/lockUser/{UserID}', ['as'=>'lockUser', 'uses'=>'UserController@lockUser']);


