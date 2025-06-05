<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReloadlyController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\TopUpRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/recharge', function () {
    return view('recharge');
})->name('recharge');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::prefix('api')->group(function () {
    Route::get('/reloadly/operators/country/{countryCode}', [ReloadlyController::class, 'getOperatorsByCountry']);
    Route::get('/reloadly/countries', [ReloadlyController::class, 'getCountries']);
    Route::get('/reloadly/auto-detect', [ReloadlyController::class, 'autoDetectOperator']);
    

    Route::get('/reloadly/token', function () {
    $clientId = env('RELOADLY_CLIENT_ID');
    $clientSecret = env('RELOADLY_CLIENT_SECRET');

    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ])->post('https://auth.reloadly.com/oauth/token', [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'grant_type' => 'client_credentials',
        'audience' => 'https://topups-sandbox.reloadly.com',
    ]);

    return $response->json();
});

});


Route::middleware(['auth'])->group(function () {
    Route::get('/topup', [TopUpController::class, 'index'])->name('topup.index');
    Route::post('/topup/detect', [TopUpController::class, 'detectOperator'])->name('topup.detect');
    Route::get('/api/operator-detect', [TopUpController::class, 'detectOperator'])->name('operator.detect');
    Route::post('/topup/submit', [TopUpController::class, 'submitAmount'])->name('topup.submit');
    Route::get('/topup/payment', [TopUpController::class, 'showPaymentPage'])->name('payment.show');
    Route::post('/topup/payment/upload', [PaymentController::class, 'uploadReceipt'])->name('payment.upload');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/topups', [TopUpRequestController::class, 'index'])->name('topups.index');
    Route::post('/topups/{id}/approve', [TopUpRequestController::class, 'approve'])->name('topups.approve');
    Route::post('/topups/{id}/reject', [TopUpRequestController::class, 'reject'])->name('topups.reject');
});




require __DIR__.'/auth.php';
