<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use App\Models\ChecklistItem;
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
        $router->patch(
            '/{uuid}',
            action: [ChecklistController::class, 'update']
        );
        $router->delete('/{uuid}', action: [ChecklistController::class, 'delete']);
    }
);

Route::group(
    [

        'prefix' => 'checklist-items'

    ],
    function ($router) {
        $router->get('/', action: [ChecklistItemController::class, 'index']);
        $router->get('/{uuid}', action: [
            ChecklistItemController::class,
            'detail'
        ]);
        $router->post('/', action: [ChecklistItemController::class, 'create']);
        $router->patch(
            '/{uuid}',
            action: [ChecklistItemController::class, 'update']
        );
        $router->patch(
            '/{uuid}/change-status',
            action: [ChecklistItemController::class, 'changeStatus']
        );
        $router->delete('/{uuid}', action: [ChecklistItemController::class, 'delete']);
    }
);
