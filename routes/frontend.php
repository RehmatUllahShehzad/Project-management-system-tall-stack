<?php

use App\Http\Livewire\Frontend\Dashboard\DashboardController;
use App\Http\Livewire\Frontend\Design\DesignCreateController;
use App\Http\Livewire\Frontend\Design\DesignFeedbackController;
use App\Http\Livewire\Frontend\Design\DesignIndexController;
use App\Http\Livewire\Frontend\Design\DesignShowController;
use App\Http\Livewire\Frontend\Project\ProjectIndexController;
use App\Http\Livewire\Frontend\Project\ProjectCreateController;
use App\Http\Livewire\Frontend\Project\ProjectShowController;
use App\Http\Livewire\Frontend\Revision\RevisionCreateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    //project routes 
    Route::middleware('permission:manage-projects')->group(function () {
        Route::get('project', ProjectIndexController::class)->name('project.index');
        Route::get('project/create', ProjectCreateController::class)->name('project.create')->middleware('permission:create-projects');
        Route::get('project/{project}', ProjectShowController::class)->name('project.show');
    });

    //design routes
    Route::middleware('permission:manage-designs')->group(function () {
        Route::get('design/{project}', DesignIndexController::class)->name('design.index');
        Route::get('design/{project}/create', DesignCreateController::class)->name('design.create')->middleware('permission:create-designs');
        Route::get('design/{project}/{design}', DesignShowController::class)->name('design.show');
        Route::get('design/{project}/{design}/{revision}/feedback', DesignFeedbackController::class)->name('design.feedback');
    });

    //revision routes
    Route::middleware('permission:manage-projects')->group(function () {
        Route::get('revision/{design}/create', RevisionCreateController::class)->name('revision.create');
    });
});
