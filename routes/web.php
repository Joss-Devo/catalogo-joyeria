<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CondicionesController;
use App\Http\Controllers\PoliticasController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/shop/{product_slug}',[ShopController::class,'product_details'])->name('shop.product.details');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::delete('/cart/remove/{rowId}',[CartController::class,'remove_item'])->name('cart.item.remove');
Route::delete('/cart/clear',[CartController::class,'empty_cart'])->name('cart.empty');

Route::post('/cart/apply-coupon',[CartController::class,'apply_coupon_code'])->name('cart.coupon.apply');
Route::delete('/cart/remove-coupon',[CartController::class,'remove_coupon_code'])->name('cart.coupon.remove');

Route::post('/wishlist/add',[WishlistController::class,'add_to_wishlist'])->name('wishlist.add');
Route::get('/wishlist',[WishlistController::class,'index'])->name('wishlist.index');
Route::delete('/wishlist/remove/{rowId}',[WishlistController::class,'remove_item_from_wishlist'])->name('wishlist.remove'); 
Route::delete('/wishlist/clear',[WishlistController::class,'empty_wishlist'])->name('wishlist.empty');
Route::post('/wishlist/move-to-cart/{rowId}',[WishlistController::class,'move_to_cart'])->name('wishlist.move.to.cart'); 

Route::get('/checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::post('/place-an-order',[CartController::class,'place_an_order'])->name('cart.place.an.order');
Route::get('/order-confirmation',[CartController::class,'order_confirmation'])->name('cart.order.confirmation');

Route::get('/contacto', [ContactoController::class, 'mostrar'])->name('contacto');
Route::get('/nosotros', [AboutController::class, 'About'])->name('about');

Route::get('/politicas', [PoliticasController::class, 'poli'])->name('condiciones');
Route::get('/condiciones', [CondicionesController::class, 'terminos'])->name('terminos');

Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard',[UserController::class,'index'])->name('user.index');
    Route::get('/account-orders',[UserController::class,'orders'])->name('user.orders');
    Route::get('/account-order/{order_id}/details',[UserController::class,'order_details'])->name('user.order.details');
    Route::put('/account-order/cancel-order',[UserController::class,'order_cancel'])->name('user.order.cancel');

    Route::get('/direccion-envio', [UserController::class, 'direccionEnvio'])->name('user.direccion');
    Route::get('/user/create-dir', [UserController::class, 'create'])->name('user.account.addresses.create');
    Route::post('/user/direcciones', [UserController::class, 'store'])->name('user.account.addresses.store');
    Route::get('/user/direcciones/{id}/editar', [UserController::class, 'edit'])->name('addresses.edit');
    Route::put('/user/direccion/envio/{id}', [UserController::class, 'update'])->name('addresses.update');
    Route::delete('/user/addresses/{id}', [UserController::class, 'destroy'])->name('user.account.addresses.destroy');

    Route::get('/ped-recientes',[UserController::class,'order_reciente'])->name('user.order_recientes');
    
});

Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/brands',[AdminController::class,'brands'])->name('admin.brands');
    Route::get('/admin/brand/add',[AdminController::class,'add_brand'])->name('admin.brand.add');
    Route::post('/admin/brand/store',[AdminController::class,'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brand/edit/{id}',[AdminController::class,'brand_edit'])->name('admin.brand.edit');
    Route::put('/admin/brand/update',[AdminController::class,'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brand/{id}/delete',[AdminController::class,'brand_delete'])->name('admin.brand.delete');
    
    Route::get('/admin/categories',[AdminController::class,'categories'])->name('admin.categories');
    Route::get('/admin/category/add',[AdminController::class,'category_add'])->name('admin.category.add');
    Route::post('/admin/category/store',[AdminController::class,'category_store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit',[AdminController::class,'category_edit'])->name('admin.category.edit');
    Route::put('/admin/Category/update',[AdminController::class,'category_update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete',[AdminController::class,'category_delete'])->name('admin.category.delete');

    Route::get('/admin/products',[AdminController::class,'products'])->name('admin.products');
    Route::get('/admin/product/add',[AdminController::class,'product_add'])->name('admin.product.add');
    Route::post('/admin/product/store',[AdminController::class,'product_store'])->name('admin.product.store');
    Route::get('/admin/product/{id}/edit',[AdminController::class,'product_edit'])->name('admin.product.edit');
    Route::put('/admin/product/update',[AdminController::class,'product_update'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete',[AdminController::class,'product_delete'])->name('admin.product.delete');

    Route::get('/admin/coupons',[AdminController::class,'coupons'])->name('admin.coupons');
    Route::get('/admin/coupon/add',[AdminController::class,'add_coupon'])->name('admin.coupon.add');
    Route::post('/admin/coupon/store',[AdminController::class,'coupon_store'])->name('admin.coupon.store');
    Route::get('/admin/coupon/{id}/edit',[AdminController::class,'coupon_edit'])->name('admin.coupon.edit'); 
    Route::put('/admin/coupon/update',[AdminController::class,'update_coupon'])->name('admin.coupon.update');
    Route::delete('/admin/coupon/{id}/delete',[AdminController::class,'delete_coupon'])->name('admin.coupon.delete');

    Route::get('/admin/orders',[AdminController::class,'orders'])->name('admin.orders');
    Route::get('/admin/order/{order_id}/details',[AdminController::class,'order_details'])->name('admin.order.details');
    Route::put('/admin/order/update-status',[AdminController::class,'update_order_status'])->name('admin.order.status.update');
    
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/user/{id}/delete', [AdminController::class, 'user_delete'])->name('admin.user.delete');
    Route::put('/admin/user/{id}/utype', [AdminController::class, 'updateUtype'])->name('admin.user.update.utype');


    Route::get('/admin/create', [AdminController::class, 'add_user'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.user.update');
    
   

});

