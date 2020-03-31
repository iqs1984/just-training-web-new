<?php
/**
 * Created by PhpStorm.
 * User: Shubham
 * Date: 26-10-2018
 * Time: 12:26
 */

namespace App\Http\Controllers;


use Shridhar\Webservices\Webservice;

class Services {

    use Webservice;

    public function __invoke($path) {
        // TODO: Implement __invoke() method.

        return $this->perform($path);

    }

    function __get($name) {
        // TODO: Implement __get() method.
        return $this->file($name) ?: $this->input($name);
    }
}