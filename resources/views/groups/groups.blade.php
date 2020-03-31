@extends('layouts.app')

@section('title','User Groups')

@section('content')


    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Groups</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                               href="{{route('dashboard')}}">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Groups</li>
                    </ol>
                </div>
            </div>
            <div class="row groups">
                <div class="col-lg-12 mb-3">
                    <a href="{{route('create_group')}}" class="float-right btn btn-sm btn-primary">Create New</a>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <?php $groups->each(function($group){?>
                        <div class="col-lg-3 p-2 groups-card">
                            <div class="card p-2 ">
                                <div class="card-body bg-light border">
                                    <div class="row">
                                        <div class="col-3 p-2">
                                            <img src="{{$group->image->url}}" class="group-icon">
                                        </div>
                                        <div class="col-9 p-2">
                                            <strong>{{$group->name}}</strong>
                                            <p>{{$group->players->count()}} Members in group</p>
                                        </div>
                                    </div>
                                    <div class=" float-right">
                                        <a href="{{url('admin/group/edit/'.$group->id)}}"
                                           class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="delete/group"
                                           params="{id: {{$group->id}}}"
                                           class="btn btn-tbl-delete btn-xs smooth-submit delete-group">
                                            <i class="fa fa-trash-o "></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php })?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
