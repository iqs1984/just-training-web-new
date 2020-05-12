@extends('layouts.app')

@section('title','Messages')

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
            <div class="row m-0 ">
                <div class="col-lg-12 p-2">
                    <a class="btn btn-primary btn-md float-right" href="{{route('create_message')}}">Create Message</a>
                </div>
                <div class="col-lg-12 p-2">
                    <div class="card table-responsive">
                        <table class="table table-striped table-hover m-0">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Read Message</th>
                                <th>Unread Message</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sr_no=1;
                            @endphp
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{$sr_no++}}</td>
                                    <td class="font-weight-bold">{{$message->title}}</td>
                                    <td>{{substr($message->description,0, 100)?substr($message->description,0, 100)."...":substr($message->description,0, 100)}}</td>
<!--                                    <td>{{$message->groups->pluck('name')->implode(', ')}}</td>-->
                                    <td> <a href="{{url('admin/messages/details/'.$message->id)}}"
                                            class="tooltips font-weight-bold" data-placement="top"
                                            data-original-title="Read Messages"> {{ $message->read_messages_player()->count()  }} </a></td>
                                    <td> <a href="{{url('admin/messages/details/'.$message->id)}}"
                                            class="tooltips font-weight-bold" data-placement="top"
                                            data-original-title="Unread Messages">{{ $message->unread_messages_player()->count()  }}</a></td>
                                    <td>
                                        <a href="{{url('admin/message/edit/'.$message->id)}}"
                                           class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="delete/message" method="POST"
                                           params="{id: {{$message->id}}}"
                                           class="btn btn-tbl-delete btn-xs smooth-submit delete-message">
                                            <i class="fa fa-trash-o "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
