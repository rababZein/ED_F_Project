@extends('layouts.dashboard')
@section('page_heading','List Of All Student')

@section('section')

<!-- <script src = "/assets/jquery.masonry.js"></script>
<script src = "/assets/jquery.masonry.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  

<meta name="_token" content="{{ app('Illuminate\Encryption\Encrypter')->encrypt(csrf_token()) }}" />
<script type="text/javascript">


window.onload = function() {
    
            $.ajaxSetup({
                headers: {
                    'X-XSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });

 };


 



	
function checkAll(bx,courseId) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
  $.ajax({
	    url: '/courses/inviteAll' ,
	    type: 'POST',
	    data: {  
	   		 
            courseId: courseId,
	   	    },
	    success: function(result) {
	    			console.log(result);
				  },
		error: function(jqXHR, textStatus, errorThrown) {
	        console.log(errorThrown);
	           }





	});

  var selectAllButton=document.getElementById('selectAll');
  selectAllButton.disabled= true;
  $("input.group1").attr("disabled", true);
}


function sendinvitation(studentId,courseId,studentName){

//alert(studentId);
	$.ajax({
	    url: '/courses/sendinvitation' ,
	    type: 'POST',
	    data: {  
	   		studentId: studentId, 
            courseId: courseId,
	   	    },
	    success: function(result) {
	    			console.log(studentId);
				  },
		error: function(jqXHR, textStatus, errorThrown) {
	        console.log(errorThrown);
	           }





	});
	alert(studentName);
    $("#"+studentName).attr("disabled", true);

}

function search(courseId){
	var studentTable = document.getElementById('studentTable');
	var input=document.getElementById('search');
	var name=input.value;

	$.ajax({
	    url: '/courses/searchStudent' ,
	    type: 'POST',
	    data: {  
	   		name: name, 
	   	    },
	    success: function(result) {
	    			console.log(result);
	    				//studentTable.innerHTML=' ';
	    				result = JSON.parse(result) ; 
						$("#studentTable").html('');
						$("#studentTable").append("<table class='table table-bordered'><thead><tr><th>User Name</th><th>Invite</th></tr></thead><tbody>");
						for (var i = 0 ; i< result.length ; i++){
							
							var user = result[i];
						    //$("#studentTable").append("<li>"+"<a href= '/users/"+user['id']+"' > "+user['name']+"</li>");
					        $("#studentTable").append("<tr  class='success' id='"+user['id']+"'><td class='text-center'><a href='/users/"+user['id']+"'>"+user['name']+"</a></td><td class='text-center'><input id='"+user['name']+"' class='group1' type='checkbox' ></td></tr>");
					         //$("#"+c).click = function() { alert('blah'); };

					         document.getElementById(user['name']).onclick = function() {
								// access properties using this keyword
								if ( this.checked ) {
								// if checked ...
								alert( this.value );
								sendinvitation(user['id'],courseId,user['name']);

								} 
							 };

					    } 
					    $("#studentTable").append("</tbody></table>");

				  },
		error: function(jqXHR, textStatus, errorThrown) {
	        console.log(errorThrown);
	           }





	});
}



</script>
<div class="col-sm-12">
<div class="row">
<div class="col-sm-12">
<input type="text" id="search" name="search"> <button onclick="search('{{$courseId}}')"> Search </button>
</div>
</div>
<div class="row">

</div>
	
<div class="row">
	
</div>
<div class="row">
	<div class="col-sm-12" >
		@section ('cotable_panel_title','Coloured Table')
		@section ('cotable_panel_body')

        Select All : <input id="selectAll" type="checkbox" onclick="checkAll(this,'{{$courseId}}')"> 
		<table class="table table-bordered" id="studentTable" >
			<thead>
				<tr>
				
					<th>User Name</th>
					<th>Invite</th>
				</tr>
			</thead>
			<tbody>
				

					@foreach ($students as $student)
				        <tr  class="success" id="{{ $student->id }}">
				          
				            <td class="text-center"><a href="/users/{{$student->id}}" >{{ $student->name }}</a></td>
				           
				            <td class="text-center">
				             <input id='{{$student->name}}' class="group1" type="checkbox" onclick="sendinvitation('{{$student->id}}','{{$courseId}}','{{$student->name}}');">
				            </td>
				        </tr>
		     		@endforeach
	
			</tbody>
		</table>
		<input type="hidden"  name="id" value="{{$courseId}}" >
		<a href="/courses/outsideInvitation/{{$courseId}}"> Send Invitation To Students who not found here </a> 
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>
</div>-
</div>
@stop
