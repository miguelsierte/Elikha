<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ArtworkController;

 
 
Route::get('/', function () {
    return view('admin.login');
});
 
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/userslogin', [AuthController::class, 'userslogin'])->name('userslogin');
    Route::post('/userslogin', [AuthController::class, 'usersloginPost'])->name('userslogin');
    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signupPost'])->name('signup');
    
    
});
 

Route::middleware(['auth', 'role:Assistant admin'])->group(function()
{
    Route::get('/assistant', [HomeController::class, 'assistant']);
    Route::get('/assistsubscribers', [HomeController::class, 'assistsubscribers']);
    Route::get('/assistsupport', [HomeController::class, 'assistsupport']);
    Route::get('/assistaccountsetting', [HomeController::class, 'assistaccountsetting'])->name('assistaccountsetting');
    Route::post('/assistaccountsetting', [HomeController::class, 'updateSetting'])->name('assistaccountsetting');
    Route::get('/assistposts', [HomeController::class, 'assistposts']);
    Route::post('/assistapprove/{id}', [HomeController::class, 'approve'])->name('assistapprove');
    Route::post('/assistreject', [HomeController::class, 'reject'])->name('assistreject');
    Route::get('/assistapprovePosts', [HomeController::class, 'assistapprovePosts'])->name('assistapprovePosts');
    Route::delete('/assistLogout', [AuthController::class, 'logout'])->name('assistLogout');
    
});

Route::middleware(['auth', 'role:Artist'])->group(function()
{
    Route::get('/artistHome', [UsersController::class, 'artistHome'])->name('artistHome');
    Route::get('/artistAuction', [UsersController::class, 'artistAuction'])->name('artistAuction');
    Route::get('/artistMessage', [UsersController::class, 'artistMessage'])->name('artistMessage');
    Route::get('/artistSettings', [UsersController::class, 'artistSettings'])->name('artistSettings');
    Route::post('/artistSettings', [UsersController::class, 'updateartistSetting'])->name('updateartistSetting');
    Route::get('/editprofile', [UsersController::class, 'editprofile']);
    Route::post('/update', [UsersController::class, 'update'])->name('update');
    Route::get('/forsale', [ArtworkController::class, 'forsale']);
    Route::post('/forsale', [ArtworkController::class, 'forsalePost'])->name('forsale');
    Route::get('/postitem', [ArtworkController::class, 'postitem']);
    Route::post('/postitem', [ArtworkController::class, 'store'])->name('postitem');
    Route::get('/profile', [UsersController::class, 'profile']);
    Route::post('popup', [UsersController::class,'store'])->name('popup');
    Route::delete('/artistLogout', [AuthController::class, 'logouts'])->name('artistLogout');
    
});

Route::middleware(['auth', 'role:Admin'])->group(function()
{
    Route::get('/home', [HomeController::class, 'home']);
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/subscribers', [HomeController::class, 'subscribers']);
    Route::get('/posts', [HomeController::class, 'posts']);
    Route::post('//approve/{id}', [HomeController::class, 'approve'])->name('approve');
    Route::post('/reject', [HomeController::class, 'reject'])->name('reject');
    Route::get('/approvePosts', [HomeController::class, 'approvePosts'])->name('approvePosts');
    Route::get('/support', [HomeController::class, 'support']);
    Route::post('/close/{id}', [HomeController::class, 'close'])->name('close');
    Route::get('/supportClosed', [HomeController::class, 'supportClosed'])->name('supportClosed');
    Route::get('/accountsetting', [HomeController::class, 'accountsetting'])->name('accountsetting');
    Route::post('/accountsetting', [HomeController::class, 'updateSetting'])->name('updateSetting');
    Route::get('/usermanagement', [UserManagement::class, 'usermanagement'])->name('usermanagement');
    Route::get('/create', [UserManagement::class, 'create']);
    Route::post('/usermanagement', [UserManagement::class, 'createPost'])->name('create');
    Route::get('/usermanagement/search', [UserManagement::class, 'search'])->name('search');
    Route::get('/show/{id}', [UserManagement::class, 'show'])->name('show');;
    Route::delete('/usermanagement/{id}', [UserManagement::class, 'destroy'])->name('destroy');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    
});

Route::middleware(['auth', 'role:Buyer'])->group(function()
{
    Route::get('/buyer', [UsersController::class, 'buyer']);
    Route::delete('/logouts', [AuthController::class, 'logouts'])->name('logouts');
});