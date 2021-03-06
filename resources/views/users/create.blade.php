@extends ('layouts.dashboard')
@section('page_heading','Add New Spot')

@section('section')

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/users/') }}">
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
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>


                         <div class="form-group">
                            <label class="col-md-4 control-label">Register as </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="optionsRadiosInline1" value="teacher" > Teacher
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="optionsRadiosInline2" value="student" checked>Student
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="optionsRadiosInline2" value="admin" checked>Admin
                            </label>
                       
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
        </form>
        
        <p>For complete documentation, please visit <a href="http://getbootstrap.com/css/#forms">Bootstrap's Form Documentation</a>.</p>
   

@stop