<?php

use Illuminate\Support\Facades\Cookie;

/**
 * Created by PhpStorm.
 * User: Shubham
 * Date: 26-10-2018
 * Time: 15:47
 */

function service_url($url) {
    return url("services/$url");
}

function set_timezone($timezone) {
    $cookie = Cookie::forever('timezone', $timezone);
    Cookie::queue($cookie);
}

function get_timezone() {
    return Cookie::get("timezone") ?: 'UTC';
}
