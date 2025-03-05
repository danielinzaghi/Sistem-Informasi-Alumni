<?php

if (!function_exists('setActive')) {
    function setActive($route)
    {
        return request()->routeIs($route) ? 'text-white bg-[#00593b]' : 'text-[#00593b] hover:bg-gray-200';
    }
}
