<?php

if (!function_exists('setActive')) {
    function setActive($route)
    {
        return request()->routeIs($route) ? 'text-white bg-blue-800' : 'text-blue-800 hover:bg-gray-200';
    }
}
