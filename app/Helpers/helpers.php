<?php

if (!function_exists('setActive')) {
    function setActive($route)
    {
        return request()->routeIs($route) ? 'text-white bg-[#1e40af]' : 'text-[#1e40af] hover:bg-gray-200';
    }
}
