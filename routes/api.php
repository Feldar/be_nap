<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\AvatarController;
use App\Http\Controllers\API\LugarController;
use App\Http\Controllers\API\RutinaController;
use App\Http\Controllers\API\EjercicioController;
use App\Http\Controllers\API\EntrenadorController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user();
    $user->fullName = $user->name;
    return $user;
});

Route::apiResource('customers', CustomerController::class)->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);
Route::apiResource('lugares', LugarController::class)->parameters([
    'lugares' => 'lugar'
]);

Route::apiResource('ejercicios', EjercicioController::class)->parameters([
    'ejercicios' => 'ejercicio'
]);

Route::apiResource('entrenadores', EntrenadorController::class)->parameters([
    'entrenadores' => 'entrenador'
]);

Route::apiResource('rutinas', RutinaController::class)->parameters([
    'rutinas' => 'rutina'
]);

Route::apiResource('orders', OrderController::class)->middleware('auth:sanctum');

Route::post('/avatars', [AvatarController::class, 'store'])->middleware('auth:sanctum');
Route::get('/avatars', [AvatarController::class, 'getAvatar'])->middleware('auth:sanctum');
Route::get('/avatars/{user_id}', [AvatarController::class, 'getAvatars']);

Route::get('recipes', [RecipeController::class, 'index']);
Route::apiResource('tvshows', EntrenadorController::class)->parameters([
    'entrenadores' => 'entrenador'
]);

Route::post('tokens', [TokenController::class, 'store']);
Route::delete('tokens', [TokenController::class, 'destroy'])->middleware('auth:sanctum');

Route::any('/{any}', function (ServerRequestInterface $request) {
    $config = new Config([
        'address' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'basePath' => '/api',
    ]);
    $api = new Api($config);
    $response = $api->handle($request);
    try {
        $records = json_decode($response->getBody()->getContents())->records;
        $response = response()->json($records, 200, $headers = ['X-Total-Count' => count($records)]);
    } catch (\Throwable $th) {

    }
    return $response;
})->where('any', '.*');
