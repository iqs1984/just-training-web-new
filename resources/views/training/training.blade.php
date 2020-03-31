@extends('layouts.app')

@section('title','Trainings')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Trainings</div>
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
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{route('create_training')}}" class="btn btn-md btn-primary float-right">Create
                        Training</a>
                </div>
                @foreach($trainings as $training)
                    <div class="col-lg-3 col-md-3  p-2">
                        <div class="card">
                            <div class="embed-responsive-16by9 embed-responsive">
                                <img src="{{$training->image->url}}" class="embed-responsive-item">
                            </div>
                            <div class="card-body">
                                <p class="text-center font-weight-bold">{{$training->title}}</p>
                                <p class="text-justify small">
                                    {{substr($training->description,0,200)}}
                                </p>
                            </div>
                            <div class="row m-0">
                                <div class="col-8 p-2 small">
                                    <div>
                                        <a href="{{url('admin/training/details/'.$training->id)}}"
                                           class="tooltips font-weight-bold" data-placement="top"
                                           data-original-title="Players Confirmed Training"> Confirmed
                                            : </a> {{$training->confirmed_players()->count()}}
                                    </div>
                                    <div>
                                        <a href="{{url('admin/training/details/'.$training->id)}}"
                                           class="tooltips font-weight-bold" data-placement="top"
                                           data-original-title="Players Confirmed Training">Donot Confirmed
                                            : </a> {{$training->do_not_confirmed_players()->count()}}
                                    </div>

                                    <div>
                                        <a href="{{url('admin/training/details/'.$training->id)}}"> Remaining Players
                                            : </a> {{$training->unconfirmed_players()->count()}}
                                    </div>
                                    <div>
                                        {{$training->date_time->setTimezone(get_timezone())}}
                                    </div>
                                </div>
                                <div class="col-4 p-2">
                                    <div class="text-right">
                                        <a href="{{url('admin/training/edit/'.$training->id)}}"
                                           class="btn btn-tbl-edit btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="delete/training"
                                           params="{id: {{$training->id}}}"
                                           class="btn btn-tbl-delete btn-xs smooth-submit delete-training">
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
