@extends('layouts.app')

@section('title','App Users')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Change Password</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                               href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Change Password</li>
                    </ol>
                </div>
            </div>
            <div class="row ">
                <form id="update-password" class="col-lg-5 mx-auto smooth-submit" enctype="multipart/form-data" method="post" action="update/password">
                    <div class="card">
                        <div class="card-header">
                            <strong>Change Password</strong>
                        </div>
                        <div class="card-body no-padding height-9">
                            <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" id="currentPassword" class="form-control"
                            name="password"/>
                            </div>
                            <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" id="newPassword" class="form-control" name="new_password"/>
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
