@extends('layouts.app')

@section('title','Assign Players to Chat Room')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Assign Players to Chat Room</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('dashboard')}}">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Assign Player to Chat Room</li>
                </ol>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12" id="assign-chatroom">

            </div>
        </div>
    </div>
</div>
@endsection
