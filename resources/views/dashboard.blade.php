<?php
//echo "<pre>";
//print_r($user);
//exit();
//?>

@extends('layouts.app')

@section('title','Welcome Page')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i
                                    class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- start widget -->
            <div class="state-overview">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-blue">
                            <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Groups</span>
                                <span class="info-box-number">{{$data['groups']}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{$data['groups']}}%" aria-valuenow="{{$data['groups']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-orange">
                            <span class="info-box-icon push-bottom"><i class="material-icons">person</i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Players</span>
                                <span class="info-box-number">{{$data['players']}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{$data['players']}}%" aria-valuenow="{{$data['players']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-purple">
                            <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Trainings</span>
                                <span class="info-box-number">{{$data['trainings']}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{$data['trainings']}}%" aria-valuenow="{{$data['trainings']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon push-bottom"><i class="fa fa-futbol-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Sports</span>
                                <span class="info-box-number">{{$data['sports']}}</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{$data['sports']}}%" aria-valuenow="{{$data['sports']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
    </div>

@endsection