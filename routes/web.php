<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\userController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/filter-chart-by-year', [HomeController::class, 'filterChartByYear'])->name('filter_chart_by_year');
    Route::get('/teams', [TeamsController::class, 'teams']) -> name('teams')->middleware('auth');
    Route::post('/projects/filter', [projectController::class, 'filter'])->name('projects.filter')->middleware('auth');
    Route::post('/save-subtask', [ProjectController::class, 'saveSubtask'])->name('save-subtask');
    // project route
    Route::get('/project-management', [projectController::class, 'index']) -> name('project-index');
    Route::get('/project-completed', [projectController::class, 'completed']) -> name('project-completed');
    Route::post('/projects/{id}/complete', [projectController::class, 'statusComplete']) -> name('status-complete');
    Route::get('/project/create', [projectController::class, 'create']) -> name('project-create');
    Route::get('/projects/{id}/edit', [projectController::class, 'edit'])->name('project-edit');
    Route::put('/projects/{id}', [projectController::class, 'update'])->name('project-update');
    Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('project-destroy');
    Route::post('/project/store', [projectController::class, 'store']) -> name('project-store');
    Route::get('/project-management/{$id}/project-detail', [projectController::class, 'detail']) -> name('project-detail');
    Route::get('/completed-projects', [ProjectController::class, 'completedProjects'])->name('completed-projects');
    // Notification route
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
