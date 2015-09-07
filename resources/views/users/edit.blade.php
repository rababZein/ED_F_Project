@extends ('layouts.dashboard')
@section('page_heading','Update Interest')

@section('section')

    {{ Form::open(array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('users.update'))) }}         
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
         <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label class="col-md-4 control-label">Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-4 control-label">E-Mail Address</label>
                <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                </div>
            </div>

          
             <div class="form-group">
                <label class="col-md-4 control-label">Register as </label>
                <label class="radio-inline">
                @if($user->type == 'teacher')
                   <input type="radio" name="type" id="optionsRadiosInline1" value="teacher" checked> Teacher
                @else
                   <input type="radio" name="type" id="optionsRadiosInline1" value="teacher" > Teacher
                @endif
                </label>
                
                 <label class="radio-inline">
                @if($user->type == 'student')
                   <input type="radio" name="type" id="optionsRadiosInline1" value="student" checked> Student
                @else
                   <input type="radio" name="type" id="optionsRadiosInline1" value="student" > Student
                @endif
                </label>

                 <label class="radio-inline">
                @if($user->type == 'admin')
                   <input type="radio" name="type" id="optionsRadiosInline1" value="admin" checked> Admin
                @else
                   <input type="radio" name="type" id="optionsRadiosInline1" value="admin" > Admin
                @endif
                </label>

                 <label class="radio-inline">
                @if($user->type == 'super admin')
                   <input type="radio" name="type" id="optionsRadiosInline1" value="super admin" checked> Super Admin
                @else
                   <input type="radio" name="type" id="optionsRadiosInline1" value="super admin" > Super Admin
                @endif
                </label>
           
            </div>

                        <input type="hidden" name="id" value="{{ $user->id }}">


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Edit
                    </button>
                </div>
            </div>

            
            
        {{ Form::close() }}
        <p>For complete documentation, please visit <a href="http://getbootstrap.com/css/#forms">Bootstrap's Form Documentation</a>.</p>
   

@stop