<?php
use Illuminate\Support\Facades\Route;

function currentRouteName()
{
    $string = Route::currentRouteName();
    $pos = strrpos($string, ".");
    return substr($string,0,$pos);
}

