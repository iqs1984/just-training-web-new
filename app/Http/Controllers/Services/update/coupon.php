<?php

use App\Model\Coupon;
use App\Model\Admin;

Admin::loggedInOrFail();

$coupon = Coupon::findOrFail($this->id);

$this->validate_request([
    'discount' => 'required',
    'name' => 'required',
    //'position' => 'required|numeric'
]);


$coupon->discount = $this->discount;
$coupon->name = $this->name;
$coupon->description = $this->description;
$coupon->long_description = $this->long_description;
//$coupon->position = $this->position;

if ($this->file("icon")) {
    $coupon->image->uploadImage($this->icon);
}

if ($this->file("inner_icon")) {
    $coupon->inner_image->uploadImage($this->inner_icon);
}

$coupon->save();

$this->success('Details updated...');
