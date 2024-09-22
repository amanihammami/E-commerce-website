<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\controllers\AdminController;

Route::get('/', [HomeController::class,'home']);
Route::get('/dashboard', [HomeController::class,'login_home'])
->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/myorders', [HomeController::class,'myorders'])
->middleware(['auth', 'verified']);

//Route::get('/dashboard', function () {
    //if(Auth::user()->usertype!='user')
    //return redirect('admin/dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/dashboard', function () {
    //if(Auth::user()->usertype==='user')
    //return view('home/index');
    //else return redirect('admin/dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    route::get('admin/dashboard',[HomeController::class,'index']);
    route::get('view_category',[AdminController::class,'view_category']);
    route::post('add_category',[AdminController::class,'add_category']);
    route::get('delete_category/{id}',[AdminController::class,'delete_category']);
    route::get('edit_category/{id}',[AdminController::class,'edit_category']);
    route::post('update_category/{id}',[AdminController::class,'update_category']);
    route::get('add_product',[AdminController::class,'add_product']);
    route::post('upload_product',[AdminController::class,'upload_product']);
    route::get('view_product',[AdminController::class,'view_product']);
    route::get('delete_product/{id}',[AdminController::class,'delete_product']);
    route::get('update_product/{slug}',[AdminController::class,'update_product']);
    route::post('edit_product/{id}',[AdminController::class,'edit_product']);
    route::get('product_search',[AdminController::class,'product_search']);
    route::get('add_cart/{id}',[HomeController::class,'add_cart']);
    route::get('view_order',[AdminController::class,'view_order']);
    route::get('On_the_way/{id}',[AdminController::class,'On_the_way']);
    route::get('Delivered/{id}',[AdminController::class,'Delivered']);
    route::get('print_pdf/{id}',[AdminController::class,'print_pdf']);
    route::get('mycart',[HomeController::class,'mycart']);

    
    
    
    
});

require __DIR__.'/auth.php';

route::get('product_details/{id}',[HomeController::class,'product_details']);
route::get('mycart',[HomeController::class,'mycart'])
->middleware(['auth', 'verified']);
    

Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});
    
route::post('confirm_order',[HomeController::class,'confirm_order'])
->middleware(['auth', 'verified']);
route::get('shop',[HomeController::class,'shop']);
route::get('why',[HomeController::class,'why']);
route::get('testimonial',[HomeController::class,'testimonial']);
route::get('contact',[HomeController::class,'contact']);