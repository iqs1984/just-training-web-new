@extends('layouts.app')

@section('title','App Users')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Edit Group</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                               href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Edit Group</li>
                    </ol>
                </div>
            </div>
            <div class="row ">
                <form class="col-lg-5 p-2 mx-auto smooth-submit" id="create-group"
                      action="update/group" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <strong>Create Group</strong>
                        </div>
                        <div class="row m-0 justify-content-center">
                            <div class="col-3 mx-auto p-2 text-center">
                                <label class="m-0">
                                    <img src="{{$group->image->url? $group->image->url: 'assets/img/dp.jpg'}}"
                                         id="icon_preview" class="rounded-circle w-100">
                                    <input type="file" name="icon" class="hidden"
                                           onchange="$('#icon_preview').attr('src',window.URL.createObjectURL(this.files[0]))">
                                </label>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-12 p-2">
                                <div class="form-group mt-3">
                                    <label for="name">Group Name</label>
                                    <input type="text" name="id" class="hidden" value="{{$group->id}}">
                                    <input type="text" name="name" class="form-control" value="{{$group->name}}">
                                </div>
                            </div>
                            <div class="col-12 p-2">
                                <select name="sport_id" class="form-control">
                                    <option value="">--Select Sports Category--</option>
                                    <?php $sports->each(function ($sport) use ($group) { ?>
                                    <option <?php if ($group->sport_id === $sport->id) {
                                        echo 'selected';
                                    }?> value="{{$sport->id}}">{{$sport->name}}</option>
                                    <?php });?>
                                </select>
                            </div>
                            <div class="col-12 p-2">
                                <button class="btn btn-primary btn-md float-right">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
