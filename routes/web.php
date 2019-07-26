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

use App\SanPham;
use App\ProductType;
Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function(){
    return view('admincp.index1');
});

Route::get('admin/dangnhap','DangnhapController@getDangnhapAdmin');
Route::post('admin/dangnhap', 'DangnhapController@postDangnhapAdmin')->name('postDangnhap');
Route::get('admin/logout', 'DangnhapController@logout')->name('logout');

Route::prefix('admincp')->group(function () {
    Route::get('/', 'Auth\admin\AdminController@index')->name('admin.index')->middleware('adminLogin');

    //SAN PHAM
    // Route::prefix('sanpham')->group(function () {
    //     Route::get('danhsach', 'SanPhamController@getDanhSach')->name('admin.danhsach');

    //     Route::get('them', 'SanPhamController@getThem')->name('admin.getThem');
    //     Route::post('them', 'SanPhamController@postThem')->name('admin.postThem');

    //     Route::get('sua/{id}', 'SanPhamController@getSua')->name('admin.getSua');
    //     Route::post('sua/{id}', 'SanPhamController@postSua')->name('admin.postSua');

    //     Route::get('edit', 'SanPhamController@edit')->name('admin.edit');

    //     Route::get('xoa/{id}', 'SanPhamController@getXoa')->name('admin.getXoa');
    // });

    //Auth
    // Route::get('login', function(){
    //     return view('admincp.login');
    // });

    // Route::post('dangnhap', 'LoginController@login')->name('login');

    Route::resource('product', 'ProductController');

    Route::resource('sanpham', 'SanPhamController')->middleware('adminLogin');

    Route::resource('loaisanpham', 'LoaiSanPhamController')->middleware('adminLogin');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::resource('hocsinh', 'HocSinhController');


Route::resource('posts','PostsController');
Route::post('posts/changeStatus', array('as' => 'changeStatus', 'uses' => 'PostsController@changeStatus'));

// Route::resource('sanpham', 'SanPhamController');

Route::get('thu', function(){
    $sanpham = SanPham::find(2)->producttype->toArray();
    var_dump($sanpham);

    $productType = ProductType::find(2)->sanpham->toArray();
    var_dump($productType);
});




