@extends('layouts.app')

@section('title','Create Group')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Create Group</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                               href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Create Group</li>
                    </ol>
                </div>
            </div>
            <div class="row ">
                <form class="col-lg-5 p-2 mx-auto smooth-submit" id="create-group"
                      action="create/group" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <strong>Create Group</strong>
                        </div>
                        <div class="row m-0 justify-content-center">
                            <div class="col-3 p-2 text-center mx-auto">
                                <label class="m-0">
                                    <img src="assets/img/dp.jpg"
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
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 p-2">
                                <select name="sport_id" class="form-control">
                                    <option value="">--Select Sports Category--</option>
                                    <?php $sports->each(function ($sport) { ?>
                                    <option value="{{$sport->id}}">{{$sport->name}}</option>
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
