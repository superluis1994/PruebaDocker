<?php

namespace Routes;

use Core\Route;
use Core\Utils;

Route::get('', "SignInControllers@sign_in");
Route::get('/', "SignInControllers@sign_in");
Route::group('/Auth', function () {
    Route::get('', "SignInControllers@sign_in");
    Route::get('/', "SignInControllers@sign_in");
    Route::get('/sign-up', "SignUpControllers@sign_up");
    Route::get('/inscribirse', "SignUpControllers@Inscribirse");
    Route::get('/acceder', "SignInControllers@Acceder");
    // Route::get('/', "EjemploControllers@index");
});
// Route::group('/SignUp', function () {
//     // Route::get('{id}', "SignUpControllers@home");
//     Route::get('/{id}', "SignUpControllers@home");
//     Route::get("/op/".$_ENV["RG"], "SignUpControllers@Rg_hermano");
//     // Route::get('/Rg-hermano', "SignUpControllers@Rg_hermano");
//     // Route::get('/Rg-directivo2024', "SignUpControllers@Rg_hermano");
// });
