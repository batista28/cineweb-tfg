<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\PlataformaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Define Custom User Registration & Login Routes
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/home', 'home')->name('home');
    Route::post('/logout', 'logout')->name('logout');
});

// Define Custom Verification Routes
Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

Route::get('/peliculas', [PeliculaController::class, 'index'])->name('peliculas.index');
Route::get('/peliculas/create', [PeliculaController::class, 'create'])->name('peliculas.create');
Route::post('/peliculas', [PeliculaController::class, 'store'])->name('peliculas.store');
Route::get('/peliculas/{pelicula}', [PeliculaController::class, 'show'])->name('peliculas.show');
Route::get('/peliculas/{pelicula}/edit', [PeliculaController::class, 'edit'])->name('peliculas.edit');
Route::put('/peliculas/{pelicula}', [PeliculaController::class, 'update'])->name('peliculas.update');
Route::delete('/peliculas/{pelicula}', [PeliculaController::class, 'destroy'])->name('peliculas.destroy');

Route::get('/series', [SerieController::class, 'index'])->name('series.index');
Route::get('/series/{id}', [SerieController::class, 'show'])->name('series.show');
Route::get('/series/create', [SerieController::class, 'create'])->name('series.create');
Route::post('/series', [SerieController::class, 'store'])->name('series.store');
Route::get('/series/{serie}/edit', [SerieController::class, 'edit'])->name('series.edit');
Route::put('/series/{serie}', [SerieController::class, 'update'])->name('series.update');
Route::delete('/series/{serie}', [SerieController::class, 'destroy'])->name('series.destroy');
Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');
Route::post('/listas/addPelicula', [ListaController::class, 'addPelicula'])->name('listas.addPelicula');
Route::post('/listas/addSerie', [ListaController::class, 'addSerie'])->name('listas.addSerie');
Route::post('/listas/agregarVista/{tipo}/{id}', [ListaController::class, 'agregarVista'])->name('listas.agregarVista');

Route::get('/lista-pendientes', [SerieController::class, 'mostrarListaPendientes'])->name('lista_pendientes');
Route::post('/peliculas/{pelicula}/calificar', [PeliculaController::class, 'calificar'])->name('peliculas.calificar');
Route::post('/series/{serie}/agregar-a-pendientes', [SerieController::class, 'agregarAPendientes'])->name('series.agregar_a_pendientes');
Route::post('/series/{serie}/agregar-a-vistas', [SerieController::class, 'agregarAVistas'])->name('series.agregar_a_vistas');
Route::get('/series/ordenar/ano_asc', [SerieController::class, 'ordenarAnoAsc'])->name('series.ordenar.ano_asc');
Route::get('/series/ordenar/ano_desc', [SerieController::class, 'ordenarAnoDesc'])->name('series.ordenar.ano_desc');
Route::get('/series/ordenar/{criterio}', [SerieController::class, 'ordenar'])->name('series.ordenar');
Route::post('/series/{serie}/calificar', [SerieController::class, 'calificar'])->name('series.calificar');

Route::get('/contacto', [ContactoController::class, 'showContactForm'])->name('contacto.form');
Route::post('/contacto', [ContactoController::class, 'submitContactForm'])->name('contacto.submit');

Route::get('/plataformas', [PlataformaController::class, 'index'])->name('plataformas.index');
Route::get('/plataformas/{id}', [PlataformaController::class, 'show'])->name('plataformas.show');
Route::get('/politicaprivacidad', 'App\Http\Controllers\PrivacyController@politicaprivacidad')->name('politicaprivacidad');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');