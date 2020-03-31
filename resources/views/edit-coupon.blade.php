@extends('layouts.app')

@section('title','Coupon')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Coupon</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('dashboard')}}">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Edit Coupon</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <form class="col-lg-5 p-2 mx-auto smooth-submit" id="edit-coupon"
                  action="update/coupon" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit Coupon</strong>
                    </div>
                    <div class="">
                        

                        <div class="row m-0 justify-content-center">
                            <div class="col-6 p-2 text-center justify-content-center">
                                <h4>Icon Image</h4>
                                <label class="m-0">
                                    <img src="{{$coupon->image->url? $coupon->image->url: 'assets/img/dp.jpg'}}"
                                         id="icon_preview" class="rounded-circle"
                                         style="width:120px;height: 120px;object-fit: cover">
                                    <input type="file" name="icon" class="hidden"
                                           onchange="$('#icon_preview').attr('src',window.URL.createObjectURL(this.files[0]))">
                                </label>
                            </div>

                            <div class="col-6 p-2 text-center justify-content-center">
                                <h4>Inner Image</h4>
                                <label class="m-0">
                                    <img src="{{$coupon->inner_image->url? $coupon->inner_image->url: 'assets/img/dp.jpg'}}"
                                         id="icon_previews" class="rounded-circle"
                                         style="width:120px;height: 120px;object-fit: cover">
                                    <input type="file" name="inner_icon" class="hidden"
                                           onchange="$('#icon_previews').attr('src',window.URL.createObjectURL(this.files[0]))">
                                </label>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="form-group mt-3">
                                <label for="name">Title</label>
                                <input type="text" name="name" class="form-control" value="{{$coupon->name}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Discount</label>
                                <input type="text" name="id" class="hidden" value="{{$coupon->id}}">
                                <input type="text" name="discount" class="form-control" value="{{$coupon->discount}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Short Description</label>
                                <textarea name="description" rows="4" class="form-control">{{$coupon->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Long Description</label>
                                <textarea name="long_description" rows="4" class="form-control">{{$coupon->long_description}}</textarea>
                            </div>
                        </div>

<!--                        <div class="col-12">-->
<!--                            <div class="form-group">-->
<!--                                <label for="name">Position</label>-->
<!--                                <input type="number" name="position"  value="{{$coupon->position}}" class="form-control" />-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="col-12 p-2">
                            <button class="btn btn-primary btn-md float-right">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

