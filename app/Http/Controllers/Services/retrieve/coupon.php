<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dell
 * Date: 6/7/2019
 * Time: 11:14 AM
 */

use \App\Model\Training;
use App\Model\Coupon;
use App\Model\User;

$coupon = Coupon::whereStatus(1)->inRandomOrder()->get();


$this->setData('coupon', $coupon);
