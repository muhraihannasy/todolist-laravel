<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(
    [

        'prefix' => 'auth'

    ],
    function ($router) {
        $router->post('login', action: [AuthController::class, 'login']);
        $router->post('register', action: [AuthController::class, 'register']);
        $router->post('logout', [AuthController::class, 'logout']);
        $router->post('refresh', [AuthController::class, 'refresh']);
        $router->post('me', [AuthController::class, 'refresh']);
    }
);

Route::group(
    [

        'prefix' => 'checklists'

    ],
    function ($router) {
        $router->get('/', action: [ChecklistController::class, 'index']);
        $router->get('/{uuid}', action: [
            ChecklistController::class,
            'detail'
        ]);
        $router->post('/', action: [ChecklistController::class, 'create']);
        $router->patch('/{uuid}', action: [ChecklistController::class, 'update']);
    }
);
