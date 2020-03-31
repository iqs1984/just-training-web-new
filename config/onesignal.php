<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shridhar
 * Date: 02-02-2019
 * Time: 16:02
 */
return [
    "debug" => env("APP_DEBUG") === true,
    "app_id" => env("ONE_SIGNAL_APP_ID"),
    "auth_key" => env("ONE_SIGNAL_AUTH_KEY")
];
