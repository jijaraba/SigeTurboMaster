<?php

/**
 * Get Current Route
 * @return mixed
 */
function getCurrentRoute()
{
    $route = explode(".", Route::currentRouteName());
    if ($route[0] === 'home') {
        $route[0] = 'dashboard';
    }
    return $route[0];
}

/**
 * Set Current Module
 * @param $route
 * @param string $class
 * @return string
 */
function setCurrentModule($route, $class = 'current')
{
    $name = explode(".", Route::currentRouteName());
    return ($name[0] == $route && $route !== 'dashboard') ? $class : '';
}

/**
 * Identified Current App
 * @param $route
 * @param string $class
 * @return string
 */
function setCurrentApp($route, $class = 'current')
{
    $name = explode(".", Route::currentRouteName());
    if (count($name) > 1) {
        return ($name[1] == $route) ? $class : '';
    } else {
        return $class;
    }
}
