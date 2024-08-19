<?php 

namespace Routes;

use Core\Route;
use Core\Utils;

Route::group('/Db', function () {
    Route::get('', "DBControllers@home");
    Route::get('/', "DBControllers@home");

});