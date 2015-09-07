@extends('layouts.dashboard')
@section('page_heading','Tables')

@section('section')

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
	
function outsideInvitation (courseId) {
	
	var emails = document.getElementById('emails').value;

	$.ajax({
	    url: '/courses/inviteOutsideStudent' ,
	    type: 'POST',
	    data: {  
	   		emails: emails, 
            courseId: courseId,
	   	    },
	    success: function(result) {
	    			console.log(result);
				  },
		error: function(jqXHR, textStatus, errorThrown) {
	                console.log(errorThrown);
	           }

	});
		    	


}
</script>

<label> Enter all Emails of student , who not in site , by coma seperator  like this ( , ).</label>
		<br/>
		<textarea id='emails' name="enterEmails" cols="70" rows="5"></textarea>
		<button id="button" onclick="outsideInvitation('{{$id}}')">Send</button> 

@endsection
@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))

