<?php

use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskAttachmentController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rotas públicas da API - Sanctum
Route::post('/sanctum/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/sanctum/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

// Rotas públicas da API - JWT (mantidas para compatibilidade)
Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'apiLogin']);
Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'apiStore']);

// Rota de teste pública
Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando!',
        'timestamp' => now(),
        'status' => 'success',
    ]);
});

// Rotas protegidas da API (requerem Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Usuário autenticado - Sanctum
    Route::get('/sanctum/user', [App\Http\Controllers\Api\AuthController::class, 'user']);
    Route::post('/sanctum/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::post('/sanctum/revoke-all-tokens', [App\Http\Controllers\Api\AuthController::class, 'revokeAllTokens']);

    // Usuário autenticado - JWT (mantido para compatibilidade)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout - JWT (mantido para compatibilidade)
    Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'apiDestroy']);

    // Refresh token
    Route::post('/refresh', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'refresh']);

    // Perfil
    Route::get('/profile', [ProfileController::class, 'apiShow']);
    Route::put('/profile', [ProfileController::class, 'apiUpdate']);

    // Tarefas
    Route::get('/tasks', [TaskController::class, 'apiIndex']);
    Route::post('/tasks', [TaskController::class, 'apiStore']);
    Route::get('/tasks/{task}', [TaskController::class, 'apiShow']);
    Route::put('/tasks/{task}', [TaskController::class, 'apiUpdate']);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'apiUpdateStatus']);
    Route::delete('/tasks/{task}', [TaskController::class, 'apiDestroy']);

    // Dashboard
    Route::get('/dashboard', [TaskController::class, 'apiDashboard']);

    // Relatórios
    Route::get('/reports', [ReportController::class, 'apiIndex']);

    // Anexos
    Route::get('/tasks/{task}/attachments', [TaskAttachmentController::class, 'apiIndex']);
    Route::post('/tasks/{task}/attachments', [TaskAttachmentController::class, 'apiStore']);
    Route::delete('/attachments/{attachment}', [TaskAttachmentController::class, 'apiDestroy']);

    // Comentários
    Route::get('/tasks/{task}/comments', [TaskCommentController::class, 'apiIndex']);
    Route::post('/tasks/{task}/comments', [TaskCommentController::class, 'apiStore']);
    Route::put('/comments/{comment}', [TaskCommentController::class, 'apiUpdate']);
    Route::delete('/comments/{comment}', [TaskCommentController::class, 'apiDestroy']);

    // Notificações (movidas para routes/web.php com locale)
});

// API para internacionalização (Vue.js) - SEM middleware de autenticação
use App\Http\Controllers\LanguageController;

Route::post('/language/{locale}', [LanguageController::class, 'switch'])->name('api.lang.switch');
Route::get('/language/current', [LanguageController::class, 'current'])->name('api.lang.current');
Route::get('/language/translations/{locale}', [LanguageController::class, 'translations'])->name('api.lang.translations');

// Verificação de feriados (pública)
Route::get('/holidays/check', [HolidayController::class, 'check'])
    ->name('api.holidays.check');
