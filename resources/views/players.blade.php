@extends('layouts.app')

@section('title','Players')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Players</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Players</li>
                    </ol>
                </div>
            </div>
            <div class="row m-0 mb-3 justify-content-between">
                <div class="col-3 col-lg-1 p-2"><a href="{{route('create_player')}}" class="btn btn-primary btn-md">Add
                        New</a></div>
                <div class="col-md-6 p-2">
                    <form class="input-group mb-3">
                        <input type="text" name="search" class="form-control" value="{{$search}}"
                               placeholder="Search..">
                        <div class="input-group-append">
                            <button class="input-group-text bg-primary" id="search">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card  card-box">
                        <div class="card-head">
                            <header>Players Details</header>
                            <div class="tools">
                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table display product-overview mb-30" id="support_table5">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>User Name</th>
                                            <th>Mobile</th>
                                            <th>Gender</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Payment</th>
                                            <th>Edit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($players as $player){
                                        ?>
                                        <tr id="player-{{$player->id}}">
                                            <td>{{$i++}}</td>
                                            <td>{{$player->name}}</td>
                                            <td>{{$player->email}}</td>
                                            <td>{{$player->user->username}}</td>
                                            <td>{{$player->mobile}}</td>
                                            <td>{{$player->gender}}</td>
                                            <td id="player-status-{{$player->id}}">
                                                @if($player->payment)
                                                    <span class="label label-sm label-success">paid</span>
                                                @else
                                                    <span class="label label-sm label-danger">Unpaid</span>
                                                @endif
                                            </td>
                                            <td>{{date('d-M-Y',strtotime($player->created_at))}}</td>
                                            <td>
                                                <label class="switchToggle tooltips" data-placement="top"
                                                       data-original-title="Payment Confirm">
                                                    <input {{$player->payment ? 'checked' : null}} type="checkbox"
                                                           class="switch-payment" data-player-id="{{$player->id}}">
                                                    <span class="slider green round"></span>
                                                </label>
                                            </td>
                                            <td>

                                                <a href="{{url('admin/player/edit/'.$player->id)}}"
                                                   class="btn btn-tbl-edit btn-xs">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="delete/player"
                                                   params="{id: {{$player->id}}}"
                                                   class="btn btn-tbl-delete btn-xs smooth-submit delete-player">
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
                                    <li class="page-item {{($players->currentPage()==1)?'disabled':''}}">
                                        <a class="page-link"
                                           href='{{($players->previousPageUrl())?$players->previousPageUrl():url()->current()}}'
                                           tabindex="-1">Previous</a>
                                    </li>
                                    @if($players->lastPage())
                                        @for($i=$players->currentPage() > 3 ? $players->currentPage() - 2 : 1; $i <=  $players->currentPage() + 2 && $i <= $players->lastPage() ; $i++)
                                            <li class="page-item {{($players->currentPage()==$i)?'active':''}}"><a
                                                    class="page-link"
                                                    href="{{$players->url($i)}}">{{$i}}</a></li>
                                        @endfor
                                    @endif
                                    <li class="page-item {{($players->lastPage()==$players->currentPage())?'disabled':''}}">
                                        <a class="page-link" href="{{$players->nextPageUrl()}}">Next</a>
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
