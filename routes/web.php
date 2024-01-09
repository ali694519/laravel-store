<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(HomeController::class)
    ->group(function () {
        Route::get('/',  'index')->name('home');
        Route::get('/about',  'about')->name('about');
        Route::get('/contact',  'contact')->name('contact');
        Route::get('/blogGridSidebar',  'blogGridSidebar')->name('blogGridSidebar');
        Route::get('/BlogSingle','BlogSingle')->name('BlogSingle');
        Route::get('/BlogSingleSidebar','BlogSingleSidebar')->name('BlogSingleSidebar');
        Route::get('/faq','faq')->name('faq');
    });

Route::get('/products', [ProductController::class,'index'])
->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class,'show'])
->name('products.show');
Route::get('/categories', [CategoryController::class,'index'])
->name('categories.index');

Route::resource('/carts', CartController::class);
Route::get('/checkout', [CheckoutController::class,'create'])
->name('checkout.create');
Route::post('/checkout', [CheckoutController::class,'store'])
->name('checkout.store');


Route::get('auth/user/2fa',[TwoFactorAuthentcationController::class,'index'])
->name('front.2xfa');

 Route::post('currency', [CurrencyConverterController::class, 'store'])
        ->name('currency.store');

Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
    ->name('auth.socilaite.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])
    ->name('auth.socilaite.callback');
Route::get('auth/{provider}/user', [SocialController::class, 'index']);

Route::get('orders/{order}/pay', [PaymentsController::class, 'create'])
    ->name('orders.payments.create');

Route::post('orders/{order}/stripe/payment-intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.paymentIntent.create');
Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');
Route::get('/orders/{order}', [OrdersController::class, 'show'])
    ->name('orders.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
