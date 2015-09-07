@extends('layouts.dashboard')
@section('page_heading','List All Courses')

@section('section')
<div class="col-sm-12">
<div class="row">
	
</div>
<div class="row">

</div>
	
<div class="row">
	
</div>
<div class="row">
	<div class="col-sm-12">
		@section ('cotable_panel_title','Coloured Table')
		@section ('cotable_panel_body')
 @if(Auth::User()->type=='admin' || Auth::User()->type=='super admin')
<a href="/courses/create">Add New Course</a>
@endif

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tilte</th>
					<th>Category</th>
					<th>Presenter</th>
					 @if(Auth::User()->type=='admin' || Auth::User()->type=='super admin')

					<th> Edit </th>
					<th> Delete </th>
					<th> Send Invitation </th>

					@endif
				</tr>
			</thead>
			<tbody>
				

					@foreach ($courses as $course)
				        <tr  class="success" id="{{ $course->id }}">
				            <td class="text-center">{{ $course->id}}</td>
				            <td class="text-center"><a href="/courses/{{$course->id}}" >{{ $course->title }}</a></td>
				             <td class="text-center"> {{ $course->category->name}}</td>
				            <td class="text-center"><a href="/users/{{$course->user->id}}">{{ $course->user->name}}</a></td>
				             @if(Auth::User()->type=='admin' || Auth::User()->type=='super admin')

				            <td class="text-center">
				            	<a title="Edit course" href="/courses/{{$course->id}}/edit" class="do"><img src="/images/edit.png" width="30px" height="30px">	</a></td>
	
				            <td class="text-center">
	{{ Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('courses.destroy'))) }}
						            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	         						<input type="hidden" name="id" value="{{ $course->id }}">
						          	<button type="submit" title="Delete User"  ><img src="/images/delete.png" width="30px" height="30px"></button>
        {{ Form::close() }}
				            </td>
				            <td class="text-center"> <a title="Send Invitation" href="/courses/invite/{{$course->id}}" class="do"> Invite Student	</a> </td>
				            @endif
				        </tr>
		     		@endforeach
	
			</tbody>
		</table>	

		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
		                        
	</div>
</div>
</div>
@stop