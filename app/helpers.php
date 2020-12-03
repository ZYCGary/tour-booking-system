<?php

use Illuminate\Support\Facades\Route;

/**
 *  Convert route name into CSS class name.
 *
 *  Used to customize CSS for specific view page.
 *
 * @return string
 */
function route_class(): string
{
    return str_replace('.', '-', Route::currentRouteName());
}
