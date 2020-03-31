@extends('layouts.app')

@section('title','Coupon')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Coupon</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Coupons</li>
                </ol>
            </div>
        </div>
        <div class="row m-0 mb-3 justify-content-between">
            <div class="col-3 col-lg-1 p-2"><a href="{{route('create_coupon')}}" class="btn btn-primary btn-md">Add
                    New</a></div>
            <div class="col-md-6 p-2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card  card-box">
                    <div class="card-head">
                        <header>Coupon details Details</header>
                        <div class="tools">
                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display product-overview mb-30" id="support_table5">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Discount</th>
                                        <th>Status</th>
<!--                                        <th>Position</th>-->
                                        <th>Coupon</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($coupons as $coupon){
                                        ?>
                                        <tr id="player-{{$coupon->id}}">
                                            <td>{{$i++}}</td>
                                            <td>{{$coupon->name}}</td>
                                            <td>{{$coupon->discount}}</td>
                                            <td id="player-status-{{$coupon->id}}">
                                                @if($coupon->status)
                                                <span class="label label-sm label-success">Active</span>
                                                @else
                                                <span class="label label-sm label-danger">Inactive</span>
                                                @endif
                                            </td>
<!--                                            <td>{{ $coupon->position }}</td>-->
                                            <td>
                                                <label class="switchToggle  tooltips" data-placement="top"
                                                       data-original-title="Coupon Status">
                                                    <input {{$coupon->status ? 'checked' : null}} type="checkbox"
                                                    class="couponSwitchToggle" data-coupon-id="{{$coupon->id}}">
                                                    <span class="slider green round"></span>
                                                </label>
                                            </td>
                                            <td>

                                                <a href="{{url('admin/coupon/edit/'.$coupon->id)}}"
                                                   class="btn btn-tbl-edit btn-xs">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="delete/coupon"
                                                   params="{id: {{$coupon->id}}}"
                                                   class="btn btn-tbl-delete btn-xs smooth-submit delete-coupon">
                                                    <i class="fa fa-trash-o "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <nav class="ml-auto float-right" aria-label="...">
                            <ul class="pagination">
                                <li class="page-item {{($coupons->currentPage()==1)?'disabled':''}}">
                                    <a class="page-link"
                                       href='{{($coupons->previousPageUrl())?$coupons->previousPageUrl():url()->current()}}'
                                       tabindex="-1">Previous</a>
                                </li>
                                @if($coupons->lastPage())
                                @for($i=$coupons->currentPage() > 3 ? $coupons->currentPage() - 2 : 1; $i <=  $coupons->currentPage() + 2 && $i <= $coupons->lastPage() ; $i++)
                                <li class="page-item {{($coupons->currentPage()==$i)?'active':''}}"><a
                                        class="page-link"
                                        href="{{$coupons->url($i)}}">{{$i}}</a></li>
                                @endfor
                                @endif
                                <li class="page-item {{($coupons->lastPage()==$coupons->currentPage())?'disabled':''}}">
                                    <a class="page-link" href="{{$coupons->nextPageUrl()}}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
