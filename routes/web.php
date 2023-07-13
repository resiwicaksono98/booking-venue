<?php

use Inertia\Inertia;
use App\Models\Venue;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\User\HomepageController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
use App\Http\Controllers\User\VenueController as UserVenueController;

// Auth
Route::get('/login', [UserAuthController::class, 'login'])->name('user-login');
Route::post('/login', [UserAuthController::class, 'doLogin']);
Route::post('/logout', [UserAuthController::class, 'logout']);
Route::get('/register', [UserAuthController::class, 'register'])->name('user-register');
Route::post('/register', [UserAuthController::class, 'doRegister']);

// Homepage
Route::get('/',[UserVenueController::class, 'index'])->name('homepage');

//  Detail Venue
Route::get('/{slug}/detail', [UserVenueController::class, 'detailVenue'])->name('user-detail-venue');
// Order
Route::post('/{slug}/order', [UserTransactionController::class, 'order']);
// Payment
Route::get('/{id_transaction}/payment', [UserTransactionController::class, 'payment'])->name('user-payment');
Route::post('/{id_transaction}/payment', [UserTransactionController::class, 'doPayment']);
// Dashboard
Route::get('/dashboard', [DashboardController::class, '__invoke'])->name('user-dashboard');
// Transaction Detail
Route::get('/transaction/{id_transaction}/detail', [UserTransactionController::class, 'detail'])->name('user-detail-transaction');



// Admin
Route::prefix('admin')->group(function () {
  // Auth
  Route::get('/login', [AuthController::class, 'login']);
  Route::post('/login', [AuthController::class, 'doLogin']);
  Route::post('/logout', [AuthController::class, 'doLogout']);

  Route::middleware(['admin.only'])->group(function () {
    Route::get('/', function () {
      return Inertia('Admin/Dashboard');
    });

    // Venue
    Route::prefix('venue')->group(function () {
      Route::get('/', [VenueController::class, 'index'])->name('venue-index');
      Route::get('/create', [VenueController::class, 'create']);
      Route::post('/create', [VenueController::class, 'store']);
      Route::get('/{slug}', [VenueController::class, 'show']);
      Route::get('/{slug}/edit', [VenueController::class, 'edit']);
      Route::post('/{slug}/update', [VenueController::class, 'update']);
      Route::delete('/{slug}/delete', [VenueController::class, 'destroy']);
    });

    // Transaction
    Route::prefix('transaction')->group((function () {
      Route::get('/', [TransactionController::class, 'index'])->name('transaction-index');
      Route::get('/create', [TransactionController::class, 'create']);
      Route::post('/create', [TransactionController::class, 'store']);
      Route::get('/{id_transaction}', [TransactionController::class, 'detail']);
      Route::get('/{id_transaction}/edit', [TransactionController::class, 'edit']);
      Route::put('/{id_transaction}/update', [TransactionController::class, 'update']);
      Route::get('/{id_transaction}/proof-payment', [TransactionController::class, 'proofPayment'])->name('proof-index');
      Route::put('/{id_proofPayment}/proof-payment', [TransactionController::class, 'updateStatusProofPayment']);
      Route::delete('/{id_transaction}/delete', [TransactionController::class, 'destroy']);
    }));
  });
});
