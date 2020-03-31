@extends('layouts.app')

@section('title','App Users')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Admin Profile</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                               href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Profile</li>
                    </ol>
                </div>
            </div>
            <div class="row ">
                <form id="update-profile" class="col-lg-5 mx-auto smooth-submit" enctype="multipart/form-data" method="post" action="update/profile">
                    <div class="card">
                        <div class="card-header">
                            <strong>Change User Name</strong>
                        </div>
                        <div class="card-body no-padding height-9">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control hidden" name="user_id" value="{{$user->username}}"/>
                                <input type="text" id="name" class="form-control" name="username" value="{{$user->username}}"/>
                            </div>
                        </div>
                        <div class="text-right">
                            <button  class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-primary"
                                    data-upgraded=",MaterialButton,MaterialRipple">Save<span
                                        class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
