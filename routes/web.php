<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RatingController;

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

// Landing Page
Route::get('/', function () {
    return view('login');
});

// Login dan Register User
Route::get('/userLogin', [UserController::class, 'relog'])->name('login');
Route::post('/doLogin', [UserController::class, 'login'])->name('doLogin');
Route::post('/buatAkun', [UserController::class, 'store'])->name('buatAkun');

// Update Data User
Route::post('/update', [UserController::class, 'update'])->name('updateAkun');
Route::post('/updateSupplier', [UserController::class, 'updateSupplier'])->name('updateAkunSupplier');
//Route::post('/updateSupplier', [UserController::class, 'updateSupplier'])->name('updateAkun');
Route::post('/updatePassword', [UserController::class, 'changePassword'])->name('updatePassword');
Route::post('/updatePasswordSupplier', [UserController::class, 'changePasswordSupplier'])->name('updatePasswordSupplier');

// View Page User
Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/akun', [UserController::class, 'toAccount'])->name('akun');
Route::get('/akunSupplier', [UserController::class, 'toAccountSupplier'])->name('akunSupplier');


// Logout User
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//add data
Route::post('/create', [ProductController::class, 'store'])->name('create');

// Page Supplier
Route::get('/supplierProduct', [ProductController::class, 'index'])->name('supplier');
Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('editProduct');

Route::get('/getProducts', [ProductController::class, 'getProducts'])->name('getProducts');
Route::post('/updateProduct/{id}', [ProductController::class, 'update'])->name('updateProduct');
Route::get('/deleteProduct/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');


Route::get('/product', [ProductController::class, 'allProduk'])->name('product');
Route::get('/productElpiji3kg', [ProductController::class, 'gas3Kg'])->name('productGas3Kg');
Route::get('/productElpiji12kg', [ProductController::class, 'gas12Kg'])->name('productGas12Kg');
Route::get('/productBrightGas5Kg', [ProductController::class, 'brightGas5Kg'])->name('productBrightGas5Kg');
Route::get('/productBrightGas12Kg', [ProductController::class, 'brightGas12Kg'])->name('productBrightGas12Kg');

//----TRANSAKSI

Route::get('/transaksi/{id}', [TransactionController::class, 'transaction'])->name('transaction');
Route::get('/getAllTransaction', [TransactionController::class, 'getAllTransactionsAgen'])->name('allTransactions');
Route::get('/allTransactionsSupplier', [TransactionController::class, 'getAllTransactionsSupplier'])->name('allTransactionsSupplier');
Route::get('/getTransactionData/{id}', [TransactionController::class, 'getTransactionData'])->name('getTransactionData');
Route::get('/uploadBuktiPembayaran/{id}', [TransactionController::class, 'upload_bukti_pembayaran'])->name('uploadBuktiPembayaran');
Route::get('/viewBuktiPembayaran/{id}', [TransactionController::class, 'view_bukti_pembayaran'])->name('viewBuktiPembayaran');
Route::post('/storeBuktiPembayaran/{id}', [TransactionController::class, 'uploadBuktiPembayaran'])->name('storeBuktiPembayaran');
Route::post('/tambahTransaksi/{id}', [TransactionController::class, 'store'])->name('tambahTransaksi');

Route::get('/test', [TransactionController::class, 'index'])->name('test');
Route::get('/test3', [TransactionController::class, 'index2'])->name('test3');
Route::get('/test4', [TransactionController::class, 'index3'])->name('test4');
Route::get('/test2', [TransactionController::class, 'getAllTransactionsSupplier'])->name('test2');


Route::get('/updateTransaction/{id}', [TransactionController::class, 'editTransactionBySupplier'])->name('updateTransaction');

Route::get('/deleteTransactions/{id}', [TransactionController::class, 'destroy'])->name('deleteTransactions');

Route::post('/updateBySupplier/{id}', [TransactionController::class, 'updateBySupplier'])->name('updateBySupplier');

Route::get('/pembayaranValid/{id}', [TransactionController::class, 'buktiPembayaranValid'])->name('pembayaranValid');
Route::get('/pembayaranTidakValid/{id}', [TransactionController::class, 'buktiPembayaranTidakValid'])->name('pembayaranTidakValid');

Route::get('/viewBuktiPembayaranNew/{id}', [TransactionController::class, 'upload_bukti_pembayaran_new'])->name('viewBuktiPembayaranNew');

Route::post('/uploadUlangBuktiPembayaran/{id}', [TransactionController::class, 'uploadUlangBuktiPembayaran'])->name('uploadUlangBuktiPembayaran');

//Route::get('/supplierProduct', [ProductController::class, 'show'])->name('getData');
//Route::get('/supplierProduct', [ProductController::class, 'index'])->name('supplier');
Route::get('/orderRating/{id}', [RatingController::class, 'orderRating'])->name('orderRating');
Route::post('/storeRating/{id}', [RatingController::class, 'store'])->name('storeRating');


// Route::get('/test', function(){
//     return view('test');
// });
