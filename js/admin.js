$(document).ready(function(){
	
	// MESSAGE EFFACER ENTREE	
	$( "#mess" ).click(function() {
		 $( "#mess_delete").removeClass ("dispnone");
	});
	$( "#envoi" ).click(function() {
		$( "#deleteitem" ).submit();
	});
	$( "#mess_delete .btn-success" ).click(function() {
		$( "#mess_delete").addClass ("dispnone");
	});
		
});

