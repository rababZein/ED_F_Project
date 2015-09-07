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
                </tr>
            </thead>
            <tbody>
                

                    @foreach ($courseStudents as $courseStudent)
                        <tr  class="success" id="{{ $courseStudent->course->id }}">
                            <td class="text-center">{{ $courseStudent->course->id}}</td>
                            <td class="text-center"><a href="/courses/{{$courseStudent->course->id}}" >{{ $courseStudent->course->title }}</a></td>
                            <td class="text-center"> {{ $courseStudent->course->category->name}}</td>
                            <td class="text-center"><a href="/users/{{$courseStudent->user->id}}">{{ $courseStudent->course->user->name}}</a></td>
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
