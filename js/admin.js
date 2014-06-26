$(document).ready(function(){
	
	// MESSAGE EFFACER ENTREE	
	$( "#mess" ).click(function() {
		 $( "#mess_delete").removeClass ("dispnone");
	});
	$( "#envoi" ).click(function() {
		$( "#deleteitem" ).submit();
	});
	$( "#submitupdate" ).click(function() {
	    editor.post();
		$( "#ajout" ).submit();
	});
	$( "#mess_delete .btn-success" ).click(function() {
		$( "#mess_delete").addClass ("dispnone");
	});
		
});

//déclencheurs//
	var formsearch= document.getElementById('search');
	
	function changeselect(){
			var btn = formsearch['btn_submit'];
			btn.value = formsearch['action'][formsearch['action'].selectedIndex].text;
			if (foo.value === "M"){
				btn. className = "";
				btn.className = "btn btn-primary";
				}
			else {
				btn. className = "";
				btn.className = "btn btn-success";
				}
		
		}
		
	if(formsearch['id'].value.length <1) {
			changeselect(); 	
		}

	formsearch['action'].addEventListener('change', function() {	
			changeselect();  
		});
		
	formsearch['id'].addEventListener('focus', function() {	
			changeselect();  
		});
	formsearch['id'].addEventListener('blur', function() {	
		if(formsearch['id'].value.length >=1)
			changeselect();  
			
		else 
			changeselect();  
			
		});
			  

