@extends('layouts.dashboard')
@section('page_heading','Learn More !')
@section('section')
           
            <!-- /.row -->
            <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            
                                <img src="/images/courses3.jpeg" height="150px" width="220px">
                            
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                                <img src="/images/courses2.jpg" height="150px" width="220px">                           
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                                <img src="/images/courses9.jpeg" height="150px" width="220px">
                      
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                                   <img src="/images/courses7.jpeg" height="150px" width="220px">
                        
                        </div>
                       
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                
                @section ('pane2_panel_title', 'Take a Tour ')
                @section ('pane2_panel_body')
                    
                    <!-- /.panel -->
                    <!-- Courses -->



<div class="row">
    <div class="col-sm-12">
        @section ('cotable_panel_title','Our Courses')
        @section ('cotable_panel_body')
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tilte</th>
                    <th>Category</th>
                    <th>Presenter</th>
                    <th> Edit </th>
                    <th> Delete </th>
                    <th> Send Invitation </th>
                </tr>
            </thead>
            <tbody>
                

                    @foreach ($courses as $course)
                        <tr  class="success" id="{{ $course->id }}">
                            <td class="text-center">{{ $course->id}}</td>
                            <td class="text-center"><a href="/courses/{{$course->id}}" >{{ $course->title }}</a></td>
                             <td class="text-center"> {{ $course->category->name}}</td>
                            <td class="text-center"><a href="/users/{{$course->user->id}}">{{ $course->user->name}}</a></td>
                            <td class="text-center">
                                <a title="Edit course" href="/courses/{{$course->id}}/edit" class="do"><img src="/images/edit.png" width="30px" height="30px">  </a></td>
    
                            <td class="text-center">
    {{ Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('courses.destroy'))) }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                    <button type="submit" title="Delete User"  ><img src="/images/delete.png" width="30px" height="30px"></button>
        {{ Form::close() }}
                            </td>
                            <td class="text-center"> <a title="Send Invitation" href="/courses/invite/{{$course->id}}" class="do"> Invite Student   </a> </td>
                        </tr>
                    @endforeach
    
            </tbody>
        </table>    
                 <a href="/courses/" class="btn btn-default btn-block">View All Courses</a>

        @endsection
        @include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
    </div>
</div>
                        
              
                     
                        
                        <!-- /.panel-body -->
                   
                    <!-- /.panel -->
                @endsection
                @include('widgets.panel', array('header'=>true, 'as'=>'pane2'))
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    @section ('cchart11_panel_title','Our Teachers')
                    @section ('cchart11_panel_body')
                    <!-- All Teachers  -->
<div class="row">
    <div class="col-sm-12">
       
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Teacher</th>
                    <th>Email</th>
                    <th> Edit </th>
                    <th> Delete </th>
                </tr>
            </thead>
            <tbody>
                

                    @foreach ($users as $user)
                        <tr  class="success" id="{{ $user->id }}">
                            <td class="text-center"><a href="/users/{{$user->id}}" >{{ $user->name }}</a></td>
                            <td class="text-center">{{ $user->email}}</td>
                            <td class="text-center">
                                <a title="Edit User" href="/users/{{$user->id}}/edit" class="do"><img src="/images/edit.png" width="30px" height="30px"> </a></td>
                             <td class="text-center">
    {{ Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('users.destroy'))) }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" title="Delete User"  ><img src="/images/delete.png" width="30px" height="30px"></button>
        {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
    
            </tbody>
        </table>    
                        <a href="/courses/listTeachers" class="btn btn-default btn-block">View All Teacher</a>

    </div>
</div>


                    <!-- End All teacher List -->
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'cchart11'))

                    @section ('pane1_panel_title', 'Categories')
                    @section ('pane1_panel_body')
                     
                    @foreach($categories as $category)    
                            <div class="list-group">
                                <a href="/courses/listByCategories/{{$category->id}}" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> {{$category->name}}                                    
                                </a>
                            </div>
                    @endforeach        
                            <!-- /.list-group -->
                            <a href="/categories/" class="btn btn-default btn-block">View All Categories</a>
                        
                        <!-- /.panel-body -->
                  
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane1'))
                      
                    
                    <!-- /.panel -->
                   
                        <!-- /.panel-footer -->
                  
                    <!-- /.panel .chat-panel -->
                    @endsection
                    @include('widgets.panel', array('header'=>true, 'as'=>'pane3'))
                </div>

                <!-- /.col-lg-4 -->
            
@stop
