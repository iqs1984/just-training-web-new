@extends('layouts.app')

@section('title','User Create')


@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Create User</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Create User</li>
                    </ol>
                </div>
            </div>
            <form class="smooth-submit row m-0 mb-3" id="edit_player" method="post"
                  action="update/player">
                <div class="col-lg-3 col-12 p-2">
                    <div class="card">
                        <div class="card-header row m-0">
                            <div class="col-6 p-0">
                                <strong>Profile Image</strong>
                            </div>
                            <div class="col-6 p-0">
                                <label class="m-0 pull-right btn btn-sm">
                                    <input type="file" id="upload_images" class="hide m-0" name="image"
                                           onchange="$('#image').attr('src', window.URL.createObjectURL(this.files[0]))">
                                    Choose file
                                </label>
                            </div>
                        </div>
                        <label class="card-body p-2">
                            <img src="{{!$player->image->url?'assets/img/dp.jpg':$player->image->url}}"
                                 class="w-100"
                                 id="image">
                        </label>
                    </div>
                </div>
                <div class="col-lg-9 col-12 mx-auto p-2">
                    <div class="card">
                        <div class="card-header">
                            <strong>Add User Details</strong>
                        </div>
                        <div class="card-body row">
                            <div class="col-4 p-2">
                                <div class="form-group">
                                    <input type="text" name="id" id="id" class="hidden" value="{{$player->id}}">
                                    <input placeholder="Name" type="text" name="name" id="name"
                                           value="{{$player->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-4 p-2">
                                <div class="form-group">
                                    <input type="text" name="mobile" class="form-control" placeholder="mobile"
                                           value="{{$player->mobile}}">
                                </div>
                            </div>
                            <div class="col-4 p-2">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="email"
                                           value="{{$player->email}}">
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control" placeholder="username"
                                           value="{{$username}}">
                                </div>
                            </div>
                            <div class="col-6 p-2">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-6 p-2 pl-3">
                                <div class="form-check p-2 d-inline-block">
                                    <input class="form-check-input" type="radio" name="gender"
                                           id="male" value="male" @if($player->gender==='male') checked @endif>
                                    <label class="form-check-label" for="male">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check p-2 d-inline-block pl-5">
                                    <input class="form-check-input" type="radio" name="gender"
                                           id="female" value="female"
                                           @if($player->gender==='female') checked @endif>
                                    <label class="form-check-label" for="female">
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 white text-right">
                            <button class="btn btn-md btn-primary">Submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection

