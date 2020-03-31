<?php

use App\Model\Coupon;
use App\Model\Admin;

Admin::loggedInOrFail();

$coupon = Coupon::findOrFail($this->coupon_id);


if($coupon->status == 0){
    $coupon->status = true;
}else{
    $coupon->status = false;
}

$coupon->save();

$this->success('Coupon status changed');
