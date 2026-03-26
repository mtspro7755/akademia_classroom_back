<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CohorteController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ParcourFormationController;
use App\Http\Controllers\PenaliteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueteController;
use App\Http\Controllers\ThematiqueController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('register',[RegisterController::class, 'register']);
Route::post('login',[LoginController::class, 'login']);
Route::post('forgot-password',[ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('reset-password',[ResetPasswordController::class, 'reset'])->name('password.reset');


Route::middleware('auth:api')->group(function () {

    Route::post('logout',[LoginController::class, 'logout']);
    Route::middleware('can:manage-users')->group(function() {

        Route::post('/users/{user}/block', [UserController::class, 'block']);
        Route::post('/users/{user}/unblock', [UserController::class, 'unblock']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);

        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::get('/users',[UserController::class, 'index']);

        Route::post('/formateurs',[FormateurController::class, 'storeFormateur']);
        Route::put('/formateurs/{formateur}',[FormateurController::class, 'updateFormateur']);
        Route::delete('/formateurs/{formateur}',[FormateurController::class, 'deleteFormateur']);
        Route::get('/formateurs',[FormateurController::class, 'indexFormateur']);
        Route::get('/formateurs/{formateur}',[FormateurController::class, 'showFormateur']);

    });

    Route::put('/profile/info',[ProfileController::class, 'updateInfo']);
    Route::put('/profile/password',[ProfileController::class, 'changePassword']);

    Route::get('/parcoursFormation',[ParcourFormationController::class, 'indexParcoursFormation']);
    Route::post('/parcoursFormation', [ParcourFormationController::class, 'storeParcoursFormation']);
    Route::get('/parcoursFormation/{parcoursFormation}', [ParcourFormationController::class, 'showParcoursFormation']);
    Route::put('/parcoursFormation/{parcoursFormation}', [ParcourFormationController::class, 'updateParcoursFormation']);
    Route::delete('/parcoursFormation/{parcoursFormation}', [ParcourFormationController::class, 'deleteParcoursFormation']);

    Route::get('/parcoursFormation/{parcoursFormation}/quetes', [ParcourFormationController::class, 'getQuetes']);
    Route::get('/my-parcours', [ParcourFormationController::class, 'getMyParcoursFormation']);

    Route::post('/cohortes/{cohorte}/formateur', [CohorteController::class, 'attribuerFormateur']);

    Route::post('/cohortes/{cohorte}/ajouter', [CohorteController::class, 'ajouterEtudiant']);
    Route::post('/cohortes/{cohorte}/retirer', [CohorteController::class, 'retirerEtudiant']);

    Route::get('/cohortes/{cohorte}/utilisateurs', [CohorteController::class, 'utilisateurs']);

    Route::post('/cohortes/{cohorte}/lancer', [CohorteController::class, 'lancer']);
    Route::post('/cohortes/{cohorte}/archiver', [CohorteController::class, 'archiver']);
    Route::post('/cohortes/{cohorte}/parcours', [CohorteController::class, 'associerParcours']);

    Route::post('/cohortes', [CohorteController::class, 'store']);
    Route::put('/cohortes/{cohorte}', [CohorteController::class, 'update']);
    Route::delete('/cohortes/{cohorte}', [CohorteController::class, 'destroy']);
    Route::get('/cohortes/{cohorte}', [CohorteController::class, 'show']);
    Route::get('/cohortes', [CohorteController::class, 'index']);

    Route::post('/quetes', [QueteController::class, 'store']);
    Route::put('/quetes/{quete}', [QueteController::class, 'update']);
    Route::delete('/quetes/{quete}', [QueteController::class, 'destroy']);
    Route::get('/quetes/{quete}', [QueteController::class, 'show']);
    Route::get('/quetes', [QueteController::class, 'index']);
    Route::get('/quetes/etudiants', [QueteController::class, 'getQuetesByEtudiant']);

    Route::post('/thematiques', [ThematiqueController::class, 'store']);
    Route::put('/thematiques/{thematique}', [ThematiqueController::class, 'update']);
    Route::delete('/thematiques/{thematique}', [ThematiqueController::class, 'destroy']);
    Route::get('/thematiques/{thematique}', [ThematiqueController::class, 'show']);
    Route::get('/thematiques', [ThematiqueController::class, 'index']);

    Route::apiResource('penalites', PenaliteController::class);
    Route::get('apprenants/penalites', [PenaliteController::class, 'apprenantsAvecPenalites']);

    Route::apiResource('posts', PostController::class);
    Route::post('posts/{post}/repondre', [PostController::class, 'repondre']);
    Route::get('thematiques/{id}/posts', [PostController::class, 'postsByThematique']);
    Route::get('mes-posts', [PostController::class, 'postsByUser']);

    Route::apiResource('posts', PostController::class);
    Route::post('posts/{post}/repondre', [PostController::class, 'repondre']);
    Route::get('thematiques/{id}/posts', [PostController::class, 'postsByThematique']);
    Route::get('mes-posts', [PostController::class, 'postsByUser']);

});
