@extends('layouts.app')

@section('title','Chat Room')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Chat Room</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Chat Room</li>
                </ol>
            </div>
        </div>
        <div class="row m-0 mb-3 justify-content-between">
            <div class="col-3 col-lg-1 p-2"><a href="{{route('create_chat_room')}}" class="btn btn-primary btn-md">Add
                    New Chat Room</a></div>
            <div class="col-md-6 p-2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="card  card-box">
                    <div class="card-head">
                        <header>Chat Room Details</header>
<!--                        <div class="tools">-->
<!--                            <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>-->
<!--                            <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>-->
<!--                            <a class="t-close btn-color fa fa-times" href="javascript:;"></a>-->
<!--                        </div>-->
                    </div>
                    <div class="card-body ">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table class="table display product-overview mb-30" id="support_table5">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Total player</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($chat_room as $chat_rooms){
                                        ?>
                                        <tr id="player-{{$chat_rooms->id}}">
                                            <td>{{$i++}}</td>
                                            <td>{{$chat_rooms->name}}</td>
                                            <td> {{ $chat_rooms->players->count() }} </td>

                                            <td>

                                                <a href="{{url('admin/chat-room/edit/'.$chat_rooms->id)}}"
                                                   class="btn btn-tbl-edit btn-xs">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="delete/chat-room"
                                                   params="{id: {{$chat_rooms->id}}}"
                                                   class="btn btn-tbl-delete btn-xs smooth-submit delete-chat-rooms">
                                                    <i class="fa fa-trash-o "></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <nav class="ml-auto float-right" aria-label="...">
                            <ul class="pagination">
                                <li class="page-item {{($chat_room->currentPage()==1)?'disabled':''}}">
                                    <a class="page-link"
                                       href='{{($chat_room->previousPageUrl())?$chat_room->previousPageUrl():url()->current()}}'
                                       tabindex="-1">Previous</a>
                                </li>
                                @if($chat_room->lastPage())
                                @for($i=$chat_room->currentPage() > 3 ? $chat_room->currentPage() - 2 : 1; $i <=  $chat_room->currentPage() + 2 && $i <= $chat_room->lastPage() ; $i++)
                                <li class="page-item {{($chat_room->currentPage()==$i)?'active':''}}"><a
                                        class="page-link"
                                        href="{{$chat_room->url($i)}}">{{$i}}</a></li>
                                @endfor
                                @endif
                                <li class="page-item {{($chat_room->lastPage()==$chat_room->currentPage())?'disabled':''}}">
                                    <a class="page-link" href="{{$chat_room->nextPageUrl()}}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
