<?php

use App\Http\Controllers\ReportingController;
use App\Http\Livewire\RTL;
use GuzzleHttp\Middleware;
use App\Http\Livewire\Order;
use App\Http\Livewire\Twins;
use App\Http\Livewire\Tables;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\ShowLogs;
use function PHPSTORM_META\map;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\MessageLogs;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Notifications;
use App\Http\Livewire\OrderDatatable;
use App\Http\Livewire\VirtualReality;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;

use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Package\PackageForm;
use App\Http\Livewire\ExampleLaravel\UserForm;
use App\Http\Livewire\Package\PackageFormEdit;
use App\Http\Livewire\Package\PackageFormShow;
use App\Http\Livewire\Package\PackageDateTable;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\ExampleLaravel\UserFormEdit;
use App\Http\Livewire\ExampleLaravel\UserManagement;
use App\Http\Controllers\Admin\Pakedeg\pakedegController;
use App\Http\Livewire\MessageManager;
use App\Http\Controllers\chanelConnectorsController;

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
    return redirect('sign-in');
});

Route::get('profile', function () {
    return redirect('sign-in');
});

Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');



Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');


Route::group(['middleware' => 'auth'], function () {    
    Route::get('user-management', UserManagement::class)->name('user-management');
    Route::get('add-users', UserForm::class)->name('add-users');
    Route::get('edit-user/{id}', UserFormEdit::class)->name('edit-user');
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('billing', Billing::class)->name('billing');
    Route::get('twins', Twins::class)->name('twins');
    Route::get('twin/{id}', Twins::class)->name('twin');
    Route::get('twin/{id}/callback', [Twins::class,'showFacebookMessengerAuthPages'])->name('twin-callback');
    //Route::get('show-logs', MessageLogs::class)->name('show-logs');
    Route::get('show-logs/{id}', MessageLogs::class)->name('show-logs');
    Route::get('show-logs/{id}/{conversationId}', MessageLogs::class)->name('show-conversation');


    Route::get('packages', PackageDateTable::class)->name('packages');
    Route::get('packages/create', PackageForm::class)->name('addpackage');
    Route::get('packages/edit/{id}', PackageFormEdit::class)->name('editpackage');
    Route::get('packages/show/{id}', PackageFormShow::class)->name('showpackage');
    Route::post('package/billing', [OrderController::class, 'store'])->name('store.order');
    Route::get('orders', OrderDatatable::class)->name('order');
    Route::get('reports/customers/wallet',[ ReportingController::class,'customersWallet']);

    Route::get('connectorCallback', [chanelConnectorsController::class,'connectorCallback'])->name('connectorCallback');
    Route::get('successConnection', [chanelConnectorsController::class,'successConnection'])->name('successConnection');
});
