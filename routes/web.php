<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ChampionshipController;
use App\Http\Controllers\Admin\GamesController;
use App\Http\Controllers\Admin\RefereeController;
use App\Http\Controllers\Admin\ScorerController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModalityController;
use App\Http\Controllers\Admin\AthleteController;
use App\Http\Controllers\Admin\ClubController
    ;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    Route::resource('clubs', ClubController::class);
    Route::resource('athletes', AthleteController::class);
    Route::resource('referees', RefereeController::class);
    Route::resource('scorers', ScorerController::class);
    Route::resource('modalities', ModalityController::class);
    Route::resource('championships', ChampionshipController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('games', GamesController::class);

    //Home
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //My User
    Route::get('/editar-usuario', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/editando-usuario', [UserController::class, 'update'])->name('user.update');

    //Championship
    Route::get('/championship/details/{id}', [ChampionshipController::class, 'details'])->name('championships.details');

    //Category
    Route::get('/categories/create/{championship_id}', [CategoriesController::class, 'create'])->name('categories.create');
    Route::get('/categories/details/{id}', [CategoriesController::class, 'details'])->name('categories.details');

    //Games
    Route::get('/game/create/{category_id}', [GamesController::class, 'create'])->name('game.create');
    Route::get('/game/details/{id}', [GamesController::class, 'details'])->name('game.details');
    Route::put('/game/details/{id}', [GamesController::class, 'save_details'])->name('game_details.update');


});

Route::namespace('Site')->group(function () {

    //Pagina inicial
    Route::get('/', [SiteController::class, 'index'])->name('site_home');
    Route::get('/campeonatos/{id}', [SiteController::class, 'championship_details'])->name('site_championship_details');
    Route::get('/campeonato/{championship_id}/categoria/{category_id}/jogos', [SiteController::class, 'championship_category_all_games'])->name('site_championship_category_all_games');
    Route::get('/campeonato/{championship_id}/categoria/{category_id}/estastisticas', [SiteController::class, 'championship_category_statistcs'])->name('site_championship_category_statistcs');
    Route::get('/modalidades/{id}', [SiteController::class, 'modality_details'])->name('site_modality_details');
    Route::get('/contato', [SiteController::class, 'contact'])->name('contact');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
