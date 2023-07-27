<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Correos;
use App\Http\Controllers\documentocontroller;
use App\Http\Controllers\EvaluadorController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PanelController;
use App\Models\Panel;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'registrar']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);
    Route::get('obtneremail/{codigo}',[CorreoController::class,'datosusuario']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');

});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('add-pandel-escuela',[PanelController::class,'add_panel']);
     // all users
    Route::get('all-users',[PersonaController::class,'get_personas']);

    //add_users 
    Route::post('add-users',[PersonaController::class,'add_user']);


    //FUNCIONES DE ESCUELA
    Route::post('agregar-docente',[EscuelaController::class,'agregar_docente']);
    Route::post('editar-docente',[EscuelaController::class,'editar_docente']);
    Route::get('obtener-docentes',[EscuelaController::class,'get_docentes']);
    Route::get('obtener-cursos',[EscuelaController::class,'get_cursos']);
    Route::post('editar-curso',[PanelController::class,'editar_panel']);



    //RUTA PARA MATRICULAS A LOS CURSOS
    Route::post('matricularse',[MatriculaController::class,'matricularse']);
    Route::post('salir-curso',[MatriculaController::class,'salir_curso']);

    //RUTAS PARA LOS ALUMNOS Y DOCENTES
    Route::post('agregar-tablero',[PanelController::class,'agregar_tablero']);
    Route::get('get-paneles-user',[PanelController::class,'get_paneles_user']);

    Route::get('get-info-panel/{id}',[PanelController::class,'get_info_panel']);

    Route::post('add-grupo-panel',[PanelController::class,'add_grupo_panel']);
    Route::get('cambiar-estado-panel/{id}', [PanelController::class,'cambiarEstadoPanel']);

    Route::post('add-subtarea-grupo',[PanelController::class,'add_subtarea_grupo']);

    Route::post('editar-subtarea-grupo',[PanelController::class,'editar_subtarea_grupo']);

    Route::post('agregar-recurso-tarea',[PanelController::class,'agregar_recurso_tarea']);
    Route::post('eliminar-recurso',[PanelController::class,'del_recurso']);
    
    Route::post('archivar-subtarea',[PanelController::class,'archivar_subtarea_grupo']);
    Route::post('enviar-tarea',[PanelController::class,'enviar_tarea']);

    Route::post('del-tarea',[PanelController::class,'eliminar_tarea']);

    Route::post('revisar-tareas',[PanelController::class,'revisar_tarea']);
});
