@extends('layouts.app')

@section('title','Events')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Events</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item"
                                                           href="{{route('dashboard')}}">Home</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Events</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{route('create_event')}}" class="btn btn-md btn-primary float-right">Create
                    Event</a>
            </div>
            @foreach($events as $event)
            <div class="col-lg-3 col-md-3  p-2">
                <div class="card">
                    <div class="embed-responsive-16by9 embed-responsive">
                        <img src="{{$event->image->url}}" class="embed-responsive-item">
                    </div>
                    <div class="card-body">
                        <p class="text-center font-weight-bold">{{$event->title}}</p>
                        <p class="text-justify small">
                            {{substr($event->description,0,200)}}
                        </p>
                    </div>
                    <div class="row m-0">
                        <div class="col-8 p-2 small">
                            <div>
                                <a href="{{url('admin/event/details/'.$event->id)}}"
                                   class="tooltips font-weight-bold" data-placement="top"
                                   data-original-title="Players Confirmed Training"> Confirmed
                                    : </a> {{$event->confirmed_players()->count()}}
                            </div>
                            <div>
                                <a href="{{url('admin/event/details/'.$event->id)}}"
                                   class="tooltips font-weight-bold" data-placement="top"
                                   data-original-title="Players Confirmed Training">Donot Confirmed
                                    : </a> {{$event->do_not_confirmed_players()->count()}}
                            </div>

                            <div>
                                <a href="{{url('admin/event/details/'.$event->id)}}"> Remaining Players
                                    : </a> {{$event->unconfirmed_players()->count()}}
                            </div>
                            <div>
                                {{$event->date_time->setTimezone(get_timezone())}}
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="text-right">
                                <a href="{{url('admin/event/edit/'.$event->id)}}"
                                   class="btn btn-tbl-edit btn-xs">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="delete/event"
                                   params="{id: {{$event->id}}}"
                                   class="btn btn-tbl-delete btn-xs smooth-submit delete-event">
                                    <i class="fa fa-trash-o "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
