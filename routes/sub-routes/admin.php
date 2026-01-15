<?php


use App\Helpers\Roles;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:api']], function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\UserController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\UserController::class, 'store']);
        Route::put('/{user}', [App\Http\Controllers\Api\v1\UserController::class, 'update'])->whereNumber('user');
        Route::get('/{user}', [App\Http\Controllers\Api\v1\UserController::class, 'show'])->whereNumber('user');
        Route::delete('/{user}', [App\Http\Controllers\Api\v1\UserController::class, 'destroy'])->whereNumber('user');
        Route::post('/{user}/assign-role', [App\Http\Controllers\Api\v1\UserController::class, 'assignRole'])->whereNumber('user');
        Route::post('/{user}/sync-permissions', [App\Http\Controllers\Api\v1\UserController::class, 'syncPermissions'])->whereNumber('user');
    });
    Route::prefix('categories')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\CategoryController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\CategoryController::class, 'store']);
        Route::put('/{category}', [App\Http\Controllers\Api\v1\CategoryController::class, 'update'])->whereNumber('category');
        Route::get('/{category}', [App\Http\Controllers\Api\v1\CategoryController::class, 'show'])->whereNumber('category');
        Route::delete('/{category}', [App\Http\Controllers\Api\v1\CategoryController::class, 'destroy'])->whereNumber('category');
    });
    Route::prefix('levels')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\LevelController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\LevelController::class, 'store']);
        Route::put('/{level}', [App\Http\Controllers\Api\v1\LevelController::class, 'update'])->whereNumber('level');
        Route::get('/{level}', [App\Http\Controllers\Api\v1\LevelController::class, 'show'])->whereNumber('level');
        Route::delete('/{level}', [App\Http\Controllers\Api\v1\LevelController::class, 'destroy'])->whereNumber('level');
    });
    Route::prefix('questions')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\QuestionController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\QuestionController::class, 'store']);
        Route::put('/{question}', [App\Http\Controllers\Api\v1\QuestionController::class, 'update'])->whereNumber('question');
        Route::get('/{question}', [App\Http\Controllers\Api\v1\QuestionController::class, 'show'])->whereNumber('question');
        Route::delete('/{question}', [App\Http\Controllers\Api\v1\QuestionController::class, 'destroy'])->whereNumber('question');
    });

    Route::prefix('answers')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\AnswerController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\AnswerController::class, 'store']);
        Route::put('/{answer}', [App\Http\Controllers\Api\v1\AnswerController::class, 'update'])->whereNumber('answer');
        Route::get('/{answer}', [App\Http\Controllers\Api\v1\AnswerController::class, 'show'])->whereNumber('answer');
        Route::delete('/{answer}', [App\Http\Controllers\Api\v1\AnswerController::class, 'destroy'])->whereNumber('answer');
    });

    Route::prefix('tests')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\TestController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\TestController::class, 'store']);
        Route::put('/{test}', [App\Http\Controllers\Api\v1\TestController::class, 'update'])->whereNumber('test');
        Route::get('/{test}', [App\Http\Controllers\Api\v1\TestController::class, 'show'])->whereNumber('test');
        Route::delete('/{test}', [App\Http\Controllers\Api\v1\TestController::class, 'destroy'])->whereNumber('test');
    });
    Route::prefix('specialities')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\SpecialityController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\SpecialityController::class, 'store']);
        Route::put('/{speciality}', [App\Http\Controllers\Api\v1\SpecialityController::class, 'update'])->whereNumber('speciality');
        Route::get('/{speciality}', [App\Http\Controllers\Api\v1\SpecialityController::class, 'show'])->whereNumber('speciality');
        Route::delete('/{speciality}', [App\Http\Controllers\Api\v1\SpecialityController::class, 'destroy'])->whereNumber('speciality');
    });
    Route::prefix('usertestsessions')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\UserTestSessionController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\UserTestSessionController::class, 'store']);
        Route::put('/{usertestsession}', [App\Http\Controllers\Api\v1\UserTestSessionController::class, 'update'])->whereNumber('usertestsession');
        Route::get('/{usertestsession}', [App\Http\Controllers\Api\v1\UserTestSessionController::class, 'show'])->whereNumber('usertestsession');
        Route::delete('/{usertestsession}', [App\Http\Controllers\Api\v1\UserTestSessionController::class, 'destroy'])->whereNumber('usertestsession');
    });
    Route::prefix('usertestanswers')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\UserTestAnswerController::class, 'adminIndex']);
        Route::post('/', [App\Http\Controllers\Api\v1\UserTestAnswerController::class, 'store']);
        Route::put('/{usertestanswer}', [App\Http\Controllers\Api\v1\UserTestAnswerController::class, 'update'])->whereNumber('usertestanswer');
        Route::get('/{usertestanswer}', [App\Http\Controllers\Api\v1\UserTestAnswerController::class, 'show'])->whereNumber('usertestanswer');
        Route::delete('/{usertestanswer}', [App\Http\Controllers\Api\v1\UserTestAnswerController::class, 'destroy'])->whereNumber('usertestanswer');
    });

    // Roles & Permissions Management
    Route::prefix('roles')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\RoleController::class, 'index']);
        Route::post('/', [App\Http\Controllers\Api\v1\RoleController::class, 'store']);
        Route::get('/{role}', [App\Http\Controllers\Api\v1\RoleController::class, 'show'])->whereNumber('role');
        Route::put('/{role}', [App\Http\Controllers\Api\v1\RoleController::class, 'update'])->whereNumber('role');
        Route::delete('/{role}', [App\Http\Controllers\Api\v1\RoleController::class, 'destroy'])->whereNumber('role');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [App\Http\Controllers\Api\v1\PermissionController::class, 'index']);
        Route::get('/{permission}', [App\Http\Controllers\Api\v1\PermissionController::class, 'show'])->whereNumber('permission');
    });
});
