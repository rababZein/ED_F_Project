@extends ('layouts.dashboard')

@section ('page_heading','Course : '.$course->title )

@section('section')
</div>

	@section ('alert1_panel_title','Basic Info ')
	@section ('alert1_panel_body')
	@include('widgets.alert', array('class'=>'success', 'message'=> 'Title : '.$course->title, 'icon'=> 'user'))
	@include('widgets.alert', array('class'=>'info', 'message'=> 'Category : '.$course->category->name ,'icon'=> 'glyphicon glyphicon-search'))
	@include('widgets.alert', array('class'=>'warning', 'message'=> 'Teacher : '.$course->user->name,'icon'=> 'glyphicon glyphicon-cog'))
	@include('widgets.alert', array('class'=>'success', 'message'=> 'Description : '.$course->desc, 'icon'=> 'user'))
	@include('widgets.alert', array('class'=>'info', 'message'=> 'Start Time : '.$course->start_time ,'icon'=> 'glyphicon glyphicon-search'))
	@include('widgets.alert', array('class'=>'warning', 'message'=> 'Duration : '.$course->duration,'icon'=> 'glyphicon glyphicon-cog'))
	@include('widgets.alert', array('class'=>'info', 'message'=> 'Limit : '.$course->attendee_limit ,'icon'=> 'glyphicon glyphicon-search'))
	@include('widgets.alert', array('class'=>'warning', 'message'=> 'Language : '.$course->language_culture_name,'icon'=> 'glyphicon glyphicon-cog'))
	
		@include('widgets.alert', array('class'=>'warning', 'message'=> 'For Contact with Teacher : '.$course->user->email,'icon'=> 'glyphicon glyphicon-cog'))




	@endsection

@include('widgets.panel', array('header'=>true, 'as'=>'alert1'))

@stop
