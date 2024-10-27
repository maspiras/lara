<?php

namespace App\Http\Controllers;

/* abstract class Controller
{
    //
} */

use Carbon\Carbon;
abstract class Controller
{
    function __construct(){
        $GLOBALS['USER_DATA'] = auth()->user(); //global user data to avoid calling authenticated user data multiple times
        $GLOBALS['APP_URL'] =  url('/');
        $GLOBALS['DATE_LIB'] =  new Carbon;
        $GLOBALS['DATE_NOW'] =  $GLOBALS['DATE_LIB']::now();
    }
}