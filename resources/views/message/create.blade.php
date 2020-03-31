@extends('layouts.app')

@section('title','Create Message')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Messages</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Messages</li>
                    </ol>
                </div>
            </div>
            <!-- start widget -->
            <form class="row smooth-submit" id="create-message" method="POST" action="create/message">
                <div class="col-lg-7 p-2">
                    <div class="card">
                        <div class="card-header">
                            <strong>Create Message</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>



                            <div class="form-group">
                                <label for="title">Message</label>
                                <textarea name="description" class="form-control" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="title">Link ( Youtube,Vimeo, facebook )</label>
                                <input type="text" class="form-control" name="link" id="link">
                            </div>



                            <div class="p-2">
                                <button class="btn btn-md float-right btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 p-2">
                    <div class="card">
                        <div class="card-header">
                            <strong>Select Group(s)</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="form-control" name="group_ids[]" multiple style="height: 270px;">
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12 mx-auto mt-3">
                                <p class="font-weight-bold">Image</p>
                                <label class="embed-responsive embed-responsive-16by9">
                                    <img src="img/default-image.png" class="embed-responsive-item" id="header_image">
                                    <input type="file" id="upload_images" class="hide m-0" name="image"
                                           onchange="$('#header_image').attr('src', window.URL.createObjectURL(this.files[0]))">
                                </label>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
