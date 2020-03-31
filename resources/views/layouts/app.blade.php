<?php

use App\Model\User;

$user = User::loggedInUser();
?>
<html>
<head>
    <title>Just Training - @yield('title')</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="description" content="Sports App"/>
    <meta name="author" content="sports"/>

    <base href="{{ asset('/') }}"/>
    <!-- google font -->
    <link href="assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!--bootstrap -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"
          media="screen">
    <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" media="screen">
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="assets/plugins/material/material.min.css">
    <link rel="stylesheet" href="assets/css/material_style.css">
    <!-- animation -->
    <link href="assets/css/pages/animate_page.css" rel="stylesheet">
    <!-- Template Styles -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/pages/formlayout.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/theme-color.css" rel="stylesheet" type="text/css"/>
    <!-- dropzone -->
    <link href="assets/plugins/dropzone/dropzone.css" rel="stylesheet" media="screen">
    <!--tagsinput-->
    <link href="assets/plugins/jquery-tags-input/jquery-tags-input.css" rel="stylesheet">
    <!--select2-->
    <link href="assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css"/>


    <link href="assets/training/index.css" rel="stylesheet" type="text/css"/>
    <!-- favicon -->
    <link rel="shortcut icon" href="img/logo.png"/>
    <script>
        var $timezone = "{{get_timezone()}}";
    </script>

</head>
<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
<div class="page-wrapper">
    <!-- start header -->
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <!-- logo start -->
            <div class="page-logo">
                <a href="{{route('dashboard')}}">
                    <img alt="" src="img/logo.png" style="width: 40px;">
                    <span class="logo-default">Just Training</span> </a>
            </div>
            <!-- logo end -->
            <ul class="nav navbar-nav navbar-left in">
                <li><a class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
            </ul>
            {{--<form class="search-form-opened" action="#" method="GET">--}}
                {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search..." name="query">--}}
                    {{--<span class="input-group-btn search-btn">--}}
                          {{--<a href="javascript:;" class="btn submit">--}}
                             {{--<i class="icon-magnifier"></i>--}}
                           {{--</a>--}}
                        {{--</span>--}}
                {{--</div>--}}
            {{--</form>--}}

            <!-- start mobile menu -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- end mobile menu -->
            <!-- start header menu -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">

                    <!-- start manage user dropdown -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle " src="img/admin.png"/>
                            <span class="username username-hide-on-mobile"> ADMIN </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default animated jello">
                            <li>
                                <a href="{{route('profile')}}">
                                    <i class="icon-user"></i> Profile </a>
                            </li>
                            <li>
                                <a href="{{route('change_password')}}">
                                    <i class="icon-key"></i> Change Password
                                </a>
                            </li>
                            <li>
                                <a class="smooth-submit logout-btn" method="post" href="logout" id="logout-btn">
                                    <i class="icon-logout"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="page-container">
        <div class="sidebar-container">
            <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                <div id="remove-scroll">
                    <ul class="sidemenu page-header-fixed p-t-20" data-keep-expanded="false" data-auto-scroll="true"
                        data-slide-speed="200">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <li class="sidebar-user-panel">
                            <div class="user-panel">
                                <div class="row">
                                    <div class="sidebar-userpic">
                                        <img src="img/admin.png" class="img-responsive" alt=""></div>
                                </div>
                                <div class="profile-usertitle">
                                    <div class="sidebar-userpic-name text-uppercase"> {{$user->username}}</div>
                                    <div class="profile-usertitle-job"> {{$user->name}}</div>
                                </div>
                                <div class="sidebar-userpic-btn">
                                    <a class="tooltips" href="{{route('profile')}}" data-placement="top"
                                       data-original-title="Profile">
                                        <i class="material-icons">person_outline</i>
                                    </a>
                                    <a href="{{route('change_password')}}" class="tooltips" data-placement="top"
                                       data-original-title="Change Password">
                                        <i class="material-icons">vpn_key</i>
                                    </a>
                                    <a class="tooltips" data-placement="top"
                                       data-original-title="Chat">
                                        <i class="material-icons">chat</i>
                                    </a>
                                    <a class="smooth-submit tooltips logout-btn" data-placement="top"
                                       data-original-title="Logout" method="post" href="logout">
                                        <i class="material-icons">input</i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="menu-heading">
                            <span>-- Main</span>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('players')}}" class="nav-link nav-toggle"> <i
                                    class="material-icons">group</i>
                                <span class="title">Players</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('trainings')}}" class="nav-link nav-toggle"> <i class="fa fa-trophy"></i>
                                <span class="title">Trainings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('events')}}" class="nav-link nav-toggle"> <i class="fa fa-calendar"></i>
                                <span class="title">Events</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('videos')}}" class="nav-link nav-toggle"> <i class="fa fa-video-camera"></i>
                                <span class="title">Video</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('groups')}}" class="nav-link nav-toggle"> <i class="fa fa-users"></i>
                                <span class="title">Groups</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('assign_player_to_group')}}" class="nav-link nav-toggle"> <i
                                    class="fa fa-list-alt"></i>
                                <span class="title">Assign Players to group</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('sport_list')}}" class="nav-link nav-toggle"> <i class="fa fa-list"></i>
                                <span class="title">Sports List</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('massages')}}" class="nav-link nav-toggle"> <i class="fa fa-envelope"></i>
                                <span class="title">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('coupons')}}" class="nav-link nav-toggle"> <i class="fa fa-tags"></i>
                                <span class="title">Coupon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('chat_room')}}" class="nav-link nav-toggle"> <i class="fa fa-users"></i>
                                <span class="title">Chat Room</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('assign_player_to_chat_room')}}" class="nav-link nav-toggle"> <i
                                    class="fa fa-list-alt"></i>
                                <span class="title">Assign Players to Chat Room</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            @yield('content')
        </div>

        <div class="chat-sidebar-container" data-close-on-body-click="false">
            <div class="chat-sidebar">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon" data-toggle="tab">Theme
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#quick_sidebar_tab_2" class="nav-link tab-icon" data-toggle="tab"> Chat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#quick_sidebar_tab_3" class="nav-link tab-icon" data-toggle="tab"> Settings
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane chat-sidebar-settings in show active animated shake" role="tabpanel"
                         id="quick_sidebar_tab_1">
                        <div class="slimscroll-style">
                            <div class="theme-light-dark">
                                <h6>Sidebar Theme</h6>
                                <button type="button" data-theme="white"
                                        class="btn lightColor btn-outline btn-circle m-b-10 theme-button">Light Sidebar
                                </button>
                                <button type="button" data-theme="dark"
                                        class="btn dark btn-outline btn-circle m-b-10 theme-button">Dark Sidebar
                                </button>
                            </div>
                            <div class="theme-light-dark">
                                <h6>Sidebar Color</h6>
                                <ul class="list-unstyled">
                                    <li class="complete">
                                        <div class="theme-color sidebar-theme">
                                            <a href="#" data-theme="white"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="dark"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="blue"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="indigo"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="cyan"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="green"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="red"><span class="head"></span><span
                                                    class="cont"></span></a>
                                        </div>
                                    </li>
                                </ul>
                                <h6>Header Brand color</h6>
                                <ul class="list-unstyled">
                                    <li class="theme-option">
                                        <div class="theme-color logo-theme">
                                            <a href="#" data-theme="logo-white"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="logo-dark"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="logo-blue"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="logo-indigo"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="logo-cyan"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="logo-green"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="logo-red"><span class="head"></span><span
                                                    class="cont"></span></a>
                                        </div>
                                    </li>
                                </ul>
                                <h6>Header color</h6>
                                <ul class="list-unstyled">
                                    <li class="theme-option">
                                        <div class="theme-color header-theme">
                                            <a href="#" data-theme="header-white"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="header-dark"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="header-blue"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="header-indigo"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="header-cyan"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="header-green"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="header-red"><span class="head"></span><span
                                                    class="cont"></span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Start Doctor Chat -->
                    <div class="tab-pane chat-sidebar-chat animated slideInRight" id="quick_sidebar_tab_2">
                        <div class="chat-sidebar-list">
                            <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd"
                                 data-wrapper-class="chat-sidebar-list">
                                <div class="chat-header"><h5 class="list-heading">Online</h5></div>
                                <ul class="media-list list-items">
                                    <li class="media"><img class="media-object" src="assets/img/user/user3.jpg"
                                                           width="35" height="35" alt="...">
                                        <i class="online dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">John Deo</h5>
                                            <div class="media-heading-sub">Spine Surgeon</div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-success">5</span>
                                        </div>
                                        <img class="media-object" src="assets/img/user/user1.jpg" width="35" height="35"
                                             alt="...">
                                        <i class="busy dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Rajesh</h5>
                                            <div class="media-heading-sub">Director</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="assets/img/user/user5.jpg"
                                                           width="35" height="35" alt="...">
                                        <i class="away dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Jacob Ryan</h5>
                                            <div class="media-heading-sub">Ortho Surgeon</div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-danger">8</span>
                                        </div>
                                        <img class="media-object" src="assets/img/user/user4.jpg" width="35" height="35"
                                             alt="...">
                                        <i class="online dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Kehn Anderson</h5>
                                            <div class="media-heading-sub">CEO</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="assets/img/user/user2.jpg"
                                                           width="35" height="35" alt="...">
                                        <i class="busy dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Sarah Smith</h5>
                                            <div class="media-heading-sub">Anaesthetics</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="assets/img/user/user7.jpg"
                                                           width="35" height="35" alt="...">
                                        <i class="online dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Vlad Cardella</h5>
                                            <div class="media-heading-sub">Cardiologist</div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="chat-header"><h5 class="list-heading">Offline</h5></div>
                                <ul class="media-list list-items">
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-warning">4</span>
                                        </div>
                                        <img class="media-object" src="assets/img/user/user6.jpg" width="35" height="35"
                                             alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Jennifer Maklen</h5>
                                            <div class="media-heading-sub">Nurse</div>
                                            <div class="media-heading-small">Last seen 01:20 AM</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="assets/img/user/user8.jpg"
                                                           width="35" height="35" alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Lina Smith</h5>
                                            <div class="media-heading-sub">Ortho Surgeon</div>
                                            <div class="media-heading-small">Last seen 11:14 PM</div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <div class="media-status">
                                            <span class="badge badge-success">9</span>
                                        </div>
                                        <img class="media-object" src="assets/img/user/user9.jpg" width="35" height="35"
                                             alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Jeff Adam</h5>
                                            <div class="media-heading-sub">Compounder</div>
                                            <div class="media-heading-small">Last seen 3:31 PM</div>
                                        </div>
                                    </li>
                                    <li class="media"><img class="media-object" src="assets/img/user/user10.jpg"
                                                           width="35" height="35" alt="...">
                                        <i class="offline dot"></i>
                                        <div class="media-body">
                                            <h5 class="media-heading">Anjelina Cardella</h5>
                                            <div class="media-heading-sub">Physiotherapist</div>
                                            <div class="media-heading-small">Last seen 7:45 PM</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="chat-sidebar-item">
                            <div class="chat-sidebar-chat-user">
                                <div class="page-quick-sidemenu">
                                    <a href="javascript:;" class="chat-sidebar-back-to-list">
                                        <i class="fa fa-angle-double-left"></i>Back
                                    </a>
                                </div>
                                <div class="chat-sidebar-chat-user-messages">
                                    <div class="post out">
                                        <img class="avatar" alt="" src="assets/img/dp.jpg"/>
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran
                                                Patel</a> <span class="datetime">9:10</span>
                                            <span class="body-out"> could you send me menu icons ? </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt="" src="assets/img/user/user5.jpg"/>
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Jacob
                                                Ryan</a> <span class="datetime">9:10</span>
                                            <span class="body"> please give me 10 minutes. </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt="" src="assets/img/dp.jpg"/>
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran
                                                Patel</a> <span class="datetime">9:11</span>
                                            <span class="body-out"> ok fine :) </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt="" src="assets/img/user/user5.jpg"/>
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Jacob
                                                Ryan</a> <span class="datetime">9:22</span>
                                            <span class="body">Sorry for
													the delay. i sent mail to you. let me know if it is ok or not.</span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt="" src="assets/img/dp.jpg"/>
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran
                                                Patel</a> <span class="datetime">9:26</span>
                                            <span class="body-out"> it is perfect! :) </span>
                                        </div>
                                    </div>
                                    <div class="post out">
                                        <img class="avatar" alt="" src="assets/img/dp.jpg"/>
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Kiran
                                                Patel</a> <span class="datetime">9:26</span>
                                            <span class="body-out"> Great! Thanks. </span>
                                        </div>
                                    </div>
                                    <div class="post in">
                                        <img class="avatar" alt="" src="assets/img/user/user5.jpg"/>
                                        <div class="message">
                                            <span class="arrow"></span> <a href="javascript:;" class="name">Jacob
                                                Ryan</a> <span class="datetime">9:27</span>
                                            <span class="body"> it is my pleasure :) </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-sidebar-chat-user-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Type a message here...">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn deepPink-bgcolor">
                                                <i class="fa fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Doctor Chat -->
                    <!-- Start Setting Panel -->
                    <div class="tab-pane chat-sidebar-settings animated slideInUp" id="quick_sidebar_tab_3">
                        <div class="chat-sidebar-settings-list slimscroll-style">
                            <div class="chat-header"><h5 class="list-heading">Layout Settings</h5></div>
                            <div class="chatpane inner-content ">
                                <div class="settings-list">
                                    <div class="setting-item">
                                        <div class="setting-text">Sidebar Position</div>
                                        <div class="setting-set">
                                            <select
                                                class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                                <option value="left" selected="selected">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Header</div>
                                        <div class="setting-set">
                                            <select
                                                class="page-header-option form-control input-inline input-sm input-small ">
                                                <option value="fixed" selected="selected">Fixed</option>
                                                <option value="default">Default</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Sidebar Menu</div>
                                        <div class="setting-set">
                                            <select
                                                class="sidebar-menu-option form-control input-inline input-sm input-small ">
                                                <option value="accordion" selected="selected">Accordion</option>
                                                <option value="hover">Hover</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Footer</div>
                                        <div class="setting-set">
                                            <select
                                                class="page-footer-option form-control input-inline input-sm input-small ">
                                                <option value="fixed">Fixed</option>
                                                <option value="default" selected="selected">Default</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-header"><h5 class="list-heading">Account Settings</h5></div>
                                <div class="settings-list">
                                    <div class="setting-item">
                                        <div class="setting-text">Notifications</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for="switch-1">
                                                    <input type="checkbox" id="switch-1"
                                                           class="mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Show Online</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for="switch-7">
                                                    <input type="checkbox" id="switch-7"
                                                           class="mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Status</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for="switch-2">
                                                    <input type="checkbox" id="switch-2"
                                                           class="mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">2 Steps Verification</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for="switch-3">
                                                    <input type="checkbox" id="switch-3"
                                                           class="mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-header"><h5 class="list-heading">General Settings</h5></div>
                                <div class="settings-list">
                                    <div class="setting-item">
                                        <div class="setting-text">Location</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for="switch-4">
                                                    <input type="checkbox" id="switch-4"
                                                           class="mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Save Histry</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for="switch-5">
                                                    <input type="checkbox" id="switch-5"
                                                           class="mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-item">
                                        <div class="setting-text">Auto Updates</div>
                                        <div class="setting-set">
                                            <div class="switch">
                                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                       for="switch-6">
                                                    <input type="checkbox" id="switch-6"
                                                           class="mdl-switch__input" checked>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-footer">
        <div class="page-footer-inner"> 2018 &copy; Just Training - Design and Developed By
            <a href="http://www.iquincesoft.com/" target="_new" class="makerCss">iQuinceSoft</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>

    <!-- start js include path -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="assets/plugins/popper/popper.min.js"></script>
    <script src="assets/plugins/jquery-blockui/jquery.blockui.min.js"></script>
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- bootstrap -->
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/pages/sparkline/sparkline-data.js"></script>
    <!-- Common js-->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/layout.js"></script>
    <script src="assets/js/theme-color.js"></script>
    <!-- material -->
    <script src="assets/plugins/material/material.min.js"></script>
    <!-- animation -->
    <script src="assets/js/pages/ui/animations.js"></script>
    <!-- morris chart -->
    <script src="assets/plugins/morris/morris.min.js"></script>
    <script src="assets/plugins/morris/raphael-min.js"></script>
    {{--<script src="assets/js/pages/chart/morris/morris_home_data.js"></script>--}}

    <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker-init.js"></script>
    <script src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js"></script>


    <script src="assets/training/runtime.js"></script>
    <script src="assets/training/vendor.js"></script>
    <script src="assets/training/main.js"></script>

    <!-- end js include path -->
</body>
</html>
