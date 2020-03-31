@extends('layouts.app')

@section('title','Create video')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Create Video</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('dashboard')}}">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Video</li>
                </ol>
            </div>
        </div>
        <form class="row smooth-submit" id="create-video" action="create/video" enctype="multipart/form-data">
            <div class="col-lg-8 p-2">
                <div class="card">
                    <div class="card-header">
                        <strong>Create Video</strong>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-12 p-2 ">
                                <div class="row p-2">
                                    <div class="col-lg-6 p-2">
                                        <label>Date & Time</label>
                                        <input class="form-control" size="16" type="datetime-local"
                                               name="date_time">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input name="title" type="text" class="form-control" id="title">
                                </div>




                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="7"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="title">Link ( YouTube, Vimeo )</label>
                                    <input name="link" type="text" class="form-control" id="link">
                                </div>


                                <div class="row m-0">
                                    <div class="col-6 p-2">

                                    </div>
                                    <div class="col-6 p-2">
                                        <button class="btn btn-primary float-right">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-2">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="col-lg-12 mx-auto mt-3">
                            <p class="font-weight-bold">Icon Image</p>
                            <label class="embed-responsive embed-responsive-16by9">
                                <img src="img/default-image.png" class="embed-responsive-item" id="header_image">
                                <input type="file" id="upload_images" class="hide m-0" name="icon_image"
                                       onchange="$('#header_image').attr('src', window.URL.createObjectURL(this.files[0]))">
                            </label>
                        </div>
                        <hr>
                        <div class="col-lg-12 mx-auto mt-3">
                            <p class="font-weight-bold">Video Image</p>
                            <label class="embed-responsive embed-responsive-16by9">
                                <img src="img/default-image.png" class="embed-responsive-item" id="image">
                                <input type="file" id="upload_images" class="hide m-0" name="image"
                                       onchange="$('#image').attr('src', window.URL.createObjectURL(this.files[0]))">
                            </label>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label>Groups</label>
                            <select class="form-control" name="group_ids[]" multiple>
                                <?php $groups->each(function ($group) { ?>
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                <?php });?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sport">Sports</label>
                            <select name="sport_ids[]" class="form-control" multiple>
                                <?php $sports->each(function ($sport) { ?>
                                    <option value="{{$sport->id}}">{{$sport->name}}</option>
                                <?php });?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
