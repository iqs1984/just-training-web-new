@inject('sports','App\Model\Sport')

@extends('layouts.app')

@section('title','Add Sports')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Sports</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                               href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Add Sport</li>
                    </ol>
                </div>
            </div>
            <div class="row sports">
                <div class="col-12">
                    <button class="btn btn-sm float-right btn-primary" data-toggle="modal" data-target="#create-sport">
                        Add New
                    </button>
                </div>
                <div class="col-lg-5 p-2 mx-auto">
                    <ul class="list-group ">
                        <?php $sports->each(function($sport){?>
                        <li class="list-group-item w-100 p-2">
                            <div class="row m-0 align-items-center sports-list">
                                <div class="col-2 p-2">
                                    <img src="{{$sport->icon->url?$sport->icon->url:'assets/img/sport.png'}}"
                                         class="sport-icon">
                                </div>
                                <div class="col-8 p-2">
                                    {{$sport->name}}
                                </div>
                                <div class="col-2 pr-0">
                                    <a class="get-sport" sport_id="{{$sport->id}}" data-toggle="modal" data-target="#update-sport"><i class="fa fa-pencil text-primary"></i></a>
                                    <a class="smooth-submit delete-sport" href="delete/sport"
                                       params="{id: {{$sport->id}} }"><i
                                                class="fa fa-trash text-danger"></i></a>
                                </div>
                            </div>
                        </li>
                        <?php });?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Sport Modal -->
    <div class="modal fade" id="create-sport" tabindex="-1" role="dialog" aria-labelledby="Create Sport"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="smooth-submit" id="add-sport" action="create/sport" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Sport</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-4 mx-auto p-2">
                                <img src="img/sport.png" class="w-100" id="icon_preview">
                                <input type="file" class="hidden" name="image"
                                       onchange="$('#icon_preview').attr('src',window.URL.createObjectURL(this.files[0]))">
                            </label>
                            <div class="col-12 p-2">
                                <div class="form-group">
                                    <label for="sport_name">Sport Name</label>
                                    <input type="text" class="form-control" name="name" id="sport_name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--create Sport Modal--}}

    {{--update sport modal--}}
    <div class="modal fade" id="update-sport" tabindex="-1" role="dialog" aria-labelledby="Create Sport"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="smooth-submit" id="update-sport" action="update/sport" method="post"
                  enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Sport</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-4 mx-auto p-2">
                                <img src="img/sport.png" class="w-100" id="get_icon_preview">
                                <input type="file" class="hidden" name="image"
                                       onchange="$('#get_icon_preview').attr('src',window.URL.createObjectURL(this.files[0]))">
                            </label>
                            <div class="col-12 p-2">
                                <div class="form-group">
                                    <label for="sport_name">Sport Name</label>
                                    <input type="text" class="hidden" name="id" id="get_sport_id">
                                    <input type="text" class="form-control" name="name" id="get_sport_name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{--update sport modal--}}

@endsection
