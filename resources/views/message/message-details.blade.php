@extends('layouts.app')

@section('title','Message Details')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Message Details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('dashboard')}}">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Details</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 p-2">
                <div class="card" style="min-height: 241px;">
                    <div class="card-body">
                        <div><h4 class="text-primary">{{$message->title}}</h4></div>
                        <strong>Description : </strong>
                        <div class="small text-justify">
                            {{$message->description}}
                        </div>
                    </div>
                </div>
            </div>
            @if($message->read_messages_player->count())
            <div class="col-lg-12 p-2">
                <div class="card">
                    <div class="card-header bg-success row m-0">
                        <div class="col-8">
                            <strong>Read Message Players</strong>
                        </div>
                        <div class="col-4 text-right">
                            <strong>Total : </strong> {{$message->read_messages_player->count()}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover training-player-table m-0">
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($message->read_messages_player as $key=>$player)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class="player-image"><img src="{{$player->image->url}}"></td>
                                <td>{{$player->name}}</td>
                                <td>{{$player->gender}}</td>
                                <td>{{$player->mobile}}</td>
                                <td>{{$player->mobile}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            @if($message->unread_messages_player->count())
            <div class="col-lg-12 p-2">
                <div class="card">
                    <div class="card-header bg-danger row m-0">
                        <div class="col-8">
                            <strong>Unread Message Players List</strong>
                        </div>
                        <div class="col-4 text-right">
                            <strong>Total : </strong> {{$message->unread_messages_player->count()}}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover training-player-table m-0">
                            <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Mobile</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($message->unread_messages_player as $key=>$player)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td class="player-image"><img src="{{$player->image->url}}"></td>
                                <td>{{$player->name}}</td>
                                <td>{{$player->gender}}</td>
                                <td>{{$player->mobile}}</td>
                                <td>{{$player->mobile}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
