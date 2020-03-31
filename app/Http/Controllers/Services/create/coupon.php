<?php

use App\Model\Coupon;
use App\Model\Admin;

Admin::loggedInOrFail();

$coupon = Coupon::make();

$this->validate_request([
    'discount' => 'required',
    'name' => 'required',
    'icon'  => 'required',
    //'position'  => 'required|numeric'
]);

$coupon->name = $this->name;
$coupon->discount = $this->discount;
$coupon->description = $this->description;
$coupon->long_description = $this->long_description;
//$coupon->position = $this->position;
$coupon->status = true;

if ($this->file("icon")) {
    $coupon->image->uploadImage($this->icon);
}

if ($this->file("inner_icon")) {
    $coupon->inner_image->uploadImage($this->inner_icon);
}

$coupon->save();

$this->success('Coupon Created..');
