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

        /* $current_timezone = config('app.timezone');    
        echo($current_timezone).'<br>';
        config(['app.timezone' => 'America/Chicago']);
        $current_timezone = config('app.timezone');  
        print_r($current_timezone); 
        parent::__construct();
        */
    }
}