<?php

use App\Model\Coupon;
use App\Model\Admin;

Admin::loggedInOrFail();


$coupon = Coupon::findOrFail($this->id)->delete();

$this->success('Coupon Deleted..');
