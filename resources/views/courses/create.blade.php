@extends ('layouts.dashboard')
@section('page_heading','Add New Course')

@section('section')

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/courses/') }}">
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
                            <label class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                            <textarea name="desc">{{old('desc')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Start time</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="start_time">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Duration </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="duration">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">attendee_limit </label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="attendee_limit">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label">language_culture_name </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="language_culture_name">
                            </div>
                        </div>


                         <div class="form-group has-success">
                           <label class="col-md-4 control-label"> Presenter </label>
                           <div class="col-md-6">
                          <select class="form-control " name="presenter_id">
                          @foreach ($presenters as $presenter)
                                      @if(old('presenter_id') === $presenter->id)
                                        <option value="{{ $presenter->id }}" selected="true"> {{ $presenter->name }}</option>
                                      @else
                                        <option value="{{ $presenter->id }}"> {{ $presenter->name }}</option>   
                                      @endif 
                              
                          @endforeach

                        
                        </select>
                        </div>
                       </div>


                       <div class="form-group has-success">
                           <label class="col-md-4 control-label"> Category </label>
                           <div class="col-md-6">
                          <select class="form-control " name="control_category_id">
                          @foreach ($categories as $category)
                                      @if(old('control_category_id') === $category->id)
                                        <option value="{{ $category->id }}" selected="true"> {{ $category->name }}</option>
                                      @else
                                        <option value="{{ $category->id }}"> {{ $category->name }}</option>   
                                      @endif 
                              
                          @endforeach

                        
                        </select>
                        </div>
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