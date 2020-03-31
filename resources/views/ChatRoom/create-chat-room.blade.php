@extends('layouts.app')

@section('title','Create Chat Room')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Create Chat Room</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('dashboard')}}">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Create Chat Room</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <form class="col-lg-5 p-2 mx-auto smooth-submit" id="create-chat-rooms"
                  action="create/chat-room" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <strong>Create Chat Room</strong>
                    </div>

                    <div class="row m-0 justify-content-center">
                        <div class="col-3 p-2 text-center mx-auto">
                            <label class="m-0">
                                <img src="assets/img/dp.jpg"
                                     id="icon_preview" class="rounded-circle" style="height: 90px; width: 90px">
                                <input type="file" name="icon" class="hidden"
                                       onchange="$('#icon_preview').attr('src',window.URL.createObjectURL(this.files[0]))">
                            </label>
                        </div>
                    </div>

                    <div class="row m-0">
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>


                        <div class="col-12 p-2 mb-2">
                            <button class="btn btn-primary btn-md float-right">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
