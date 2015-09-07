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
        @section ('cotable_panel_title','YoUR Courses')
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
                

                <!-- /.col-lg-4 -->
            
@stop
