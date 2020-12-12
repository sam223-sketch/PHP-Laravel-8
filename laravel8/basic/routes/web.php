<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
//use App\Models\User; //FOR Eloquent ORM READ DATA
use Illuminate\Support\Facades\DB; //FOR QUERY Builder READ DATA

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

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [ContactController::class, 'index']);

// Category Controllers
Route::get('/category/all', [CategoryController::class, 'AllCategory'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/firstdelete/category/{id}', [CategoryController::class, 'FirstDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/finaldelete/{id}', [CategoryController::class, 'FinalDelete']);




/// Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // From User.php in models: This passes user data from database to be display o dashbord

    // $users = User::all();  // Using Eloquent ORM Read Data

    $users = DB::table('users')->get(); // Using Query Builder to Read Data
    return view('dashboard',compact('users'));
})->name('dashboard');
