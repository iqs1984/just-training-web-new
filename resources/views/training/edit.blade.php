@extends('layouts.app')

@section('title','Trainings')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Edit Training</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                               href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Trainings</li>
                    </ol>
                </div>
            </div>
            <form class="row smooth-submit" id="update-training" action="update/training" enctype="multipart/form-data">
                <div class="col-lg-8 p-2">
                    <div class="card">
                        <div class="card-header">
                            <strong>Create Trainings</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-12 p-2 ">
                                    <div class="row p-2">
                                        <div class="col-lg-6 p-2">
                                            <label>Date & Time</label>
                                            <input class="form-control" size="16" type="datetime-local"
                                                   name="date_time"
                                                   value="{{$training->date_time->setTimezone(get_timezone())->format('Y-m-d\TH:i')}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input name="title" type="text" class="form-control" id="title"
                                               value="{{$training->title}}">
                                        <input name="id" type="text" class="form-control hidden" id="title"
                                               value="{{$training->id}}">
                                    </div>




                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"
                                                  rows="7">{{$training->description}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Link ( YouTube, Vimeo, Facebook )</label>
                                        <input name="link" type="text" class="form-control" id="link"
                                               value="{{$training->link}}">
                                    </div>

                                    <div class="row m-0">
                                        <div class="col-6 p-2">
                                            <div class="form-group">
                                                <div class="checkbox checkbox-aqua">
                                                    <input
                                                        {{$training->confirmed?'checked':'null'}} id="training-confirm"
                                                        type="checkbox" value="true" name="training_confirm">
                                                    <label class="m-0" for="training-confirm">
                                                        Training Pre-Confirm
                                                    </label>
                                                </div>
                                            </div>
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
                                <p class="font-weight-bold">Training Header Image</p>
                                <label class="embed-responsive embed-responsive-16by9">
                                    <img
                                        src="{{$training->header_image->exists()? $training->header_image->url:'img/default-image.png'}}"
                                        class="embed-responsive-item" id="header_image">
                                    <input type="file" id="upload_images" class="hide m-0" name="header_image"
                                           onchange="$('#header_image').attr('src', window.URL.createObjectURL(this.files[0]))">
                                </label>
                            </div>
                            <hr>
                            <div class="col-lg-12 mx-auto mt-3">
                                <p class="font-weight-bold">Training Image</p>
                                <label class="embed-responsive embed-responsive-16by9">
                                    <img
                                        src="{{$training->image->exists()? $training->image->url:'img/default-image.png'}}"
                                        class="embed-responsive-item" id="image">
                                    <input type="file" id="upload_images" class="hide m-0" name="image"
                                           onchange="$('#image').attr('src', window.URL.createObjectURL(this.files[0]))">
                                </label>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Groups</label>
                                <select class="form-control" name="group_ids[]" multiple>
                                    @foreach($groups as $group)
                                        <option
                                            {{$training->inGroup($group->id) ? 'selected' : null}} value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sport">Sports</label>
                                <ul class="list-group sortable">
                                    @foreach($sports as $sport)
                                        {{--                                        <li {{$training->sports()->where('id',$sport->id)->count()? 'selected':null}}  value="{{$sport->id}}">{{$sport->name}}</li>--}}
                                        <label class="list-group-item m-0">
                                            <input
                                                {{$training->sports()->where('id',$sport->id)->count()? 'checked':null}}  name="sport_ids[]"
                                                type="checkbox" value="{{$sport->id}}">
                                            {{$sport->name}}
                                        </label>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
