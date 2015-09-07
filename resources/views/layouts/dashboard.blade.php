@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('/home') }}">Courses Web Site</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
             
                <!-- /.dropdown -->
             
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/users/{{Auth::user()->id}}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="/users/{{Auth::user()->id}}/edit"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>


                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            <form  method="POST" action="/courses/searchCourses">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="text" name="searchCourses" class="form-control" placeholder="Search Course By TiTle...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </form>
                            </div>
                         </li>
                         @if(Auth::User()->type=='admin' || Auth::User()->type=='super admin')
                      <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            <form  method="POST" action="/courses/searchTeachers">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="text" name="searchTeachers" class="form-control" placeholder="Search Teacher By NaMe ...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </form>
                            </div>
                       </li>
                      <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            <form  method="POST" action="/users/searchStudents">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="text" name="searchStudents" class="form-control" placeholder="Search Student By NaMe ...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </form>
                            </div>
                      </li>
                      <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                            <form  method="POST" action="/categories/searchCategories">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="text" name="searchCategories" class="form-control" placeholder="Search CategorY By NaMe ...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </form>
                            </div>
                       </li>
                       <li>
                            <a href="/courses/" class="btn btn-default btn-block">View All Courses</a>
                       </li>
                       <li>
                            <a href="/categories/searchCategories" class="btn btn-default btn-block">View All Categories</a>
                       </li>
                       <li>
                            <a href="/users/" class="btn btn-default btn-block">View All Users</a>
                       </li>
                       <li>
                            <a href="/users/searchStudents" class="btn btn-default btn-block">View All Students</a>
                       </li>
                       <li>
                            <a href="/courses/searchTeachers" class="btn btn-default btn-block">View All Teachers</a>
                       </li>
                      @endif
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			 <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
			<div class="row">  
				@yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

