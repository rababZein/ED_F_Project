@extends('layouts.dashboard')
@section('page_heading','List All :')

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
		@section ('cotable_panel_title','Category')
		@section ('cotable_panel_body')
		<a href="/categories/create"> Add Nwe Category</a>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>Category Name</th>
					<th>Delete</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				

					@foreach ($categories as $category)
				        <tr  class="success" id="{{ $category->id }}">
				            <td class="text-center">{{ $category->id}}</td>
				            <td class="text-center"><a href="/courses/listByCategories/{{$category->id}}">{{ $category->name }}</a></td>
				            <td class="text-center">
				            	<a title="Edit category" href="/categories/{{$category->id}}/edit" class="do"><img src="/images/edit.png" width="30px" height="30px"></a></td>
	{{ Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('categories.destroy'))) }}
						    <td class="text-center">       
						            <input type="hidden" name="_token" value="{{ csrf_token() }}">
	         						<input type="hidden" name="id" value="{{ $category->id }}">
						          	<button type="submit" title="Delete category"  ><img src="/images/delete.png" width="30px" height="30px"></button>
        {{ Form::close() }}
				            </td>
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