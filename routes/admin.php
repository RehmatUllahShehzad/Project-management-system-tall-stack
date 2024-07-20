<?php

use App\Http\Livewire\Admin\Dashboard\DashboardController;
use App\Http\Livewire\Admin\System\Role\RoleCreateController;
use App\Http\Livewire\Admin\System\Role\RoleIndexController;
use App\Http\Livewire\Admin\System\Role\RoleShowController;
use App\Http\Livewire\Admin\System\Staff\StaffCreateController;
use App\Http\Livewire\Admin\System\Staff\StaffIndexController;
use App\Http\Livewire\Admin\System\Staff\StaffShowController;
use App\Http\Livewire\Admin\System\Team\TeamCreateController;
use App\Http\Livewire\Admin\System\Team\TeamIndexController;
use App\Http\Livewire\Admin\System\Team\TeamShowController;
use App\Http\Livewire\Admin\System\User\UserCreateController;
use App\Http\Livewire\Admin\System\User\UserIndexController;
use App\Http\Livewire\Admin\System\User\UserShowController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.admin:admin')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('system')->middleware('permission:system')->as('system.')->group(function () {

            Route::middleware('permission:system:manage-staff')->group(function () {
                Route::get('staff', StaffIndexController::class)->name('staff.index');
                Route::get('staff/create', StaffCreateController::class)->name('staff.create');
                Route::get('staff/{staff}', StaffShowController::class)->name('staff.show');
            });

            Route::middleware('permission:system:manage-roles')->group(function () {
                Route::get('role', RoleIndexController::class)->name('role.index');
                Route::get('role/create', RoleCreateController::class)->name('role.create');
                Route::get('role/{role}', RoleShowController::class)->name('role.show');
            });

            Route::middleware('permission:system:manage-teams')->group(function () {
                Route::get('team', TeamIndexController::class)->name('team.index');
                Route::get('team/create', TeamCreateController::class)->name('team.create');
                Route::get('team/{team}', TeamShowController::class)->name('team.show');
            });

            Route::middleware('permission:system:manage-roles')->group(function () {
                Route::get('user', UserIndexController::class)->name('user.index');
                Route::get('user/create', UserCreateController::class)->name('user.create');
                Route::get('user/{user}', UserShowController::class)->name('user.show');
            });
    });
});
