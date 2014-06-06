//déclencheurs//
	var formulR= document.getElementById('formulR');
	var formvalue=new Array();
	var spanVise ;
	
	for(var i=0; i<formulR.length; i++)
	  {	  formvalue[i]=formulR[i].value;
			formulR[i].addEventListener('focus', function() {																		
																if(this.value=="Nom" || this.value=="Email" ||this.value=="Message" ||this.value=="Sujet")
																	{formvalue[i]=this.value; this.value =" "; } 
																this.style.color='#000000' }
																, true);
			  
		}
	for(var i=0; i<formulR.length; i++)
	  {			formulR[i].addEventListener('blur', function() { 
																	if(this.value===" ")
																		{this.value=formvalue[i]; this.style.color='#808080'}	
																}, true);
			}
	formulR.addEventListener('submit', function(e) {	offMessErreur(formulR);
														for(var i=0; i<formulR.length; i++)
															{	
																if(formulR[i].name != 'sujet')
																	{	if(formulR[i].type==='textarea') {var nb=10;}
																		else {var nb=5;}
																		if (formulR[i].value === formvalue[i] || formulR[i].value.length<nb )
																			{ 	
																				if(formulR[i].name==='email'){
																					if(!Verifmail(formulR[i].value)){
																						taille(formulR[i], nb);
																						e.preventDefault();
																						}						
																					}												
																				else {taille(formulR[i], nb);
																				 e.preventDefault();}
																			}
																	}													
															}
													}, true);
	formulR.addEventListener('reset', function() {	for(var i=0; i<formulR.length; i++)
														{formulR[i].style.color='#808080';} 
													offMessErreur(formulR); 
													}, true);


//**************************** AFFICHAGE DES SPANs INFOs *****************************/

  function offMessErreur(formulR) {
			var spans = formulR.getElementsByTagName('span');
			for (var i = 0 ; i < spans.length ; i++) {
				if (spans[i].className == 'messerreur') {
					spans[i].style.visibility = 'hidden';
				}
			}
		
    }
     
function getMesErreur(element) {
        while (element = element.previousSibling) {
            if (element.className === 'messerreur') {
                return element;
            }
        }  
        return false; 
    }

//**************************** mail *****************************/
function Verifmail(mailteste)
{
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	if(reg.test(mailteste))
		{return("ok");}
	else
		{return(false);}
}

//*****Vérification de la taille de la valeur et affichage du message d'erreur
function taille(element,nb){
	spanVise=getMesErreur(element);
	/*if(element.value.length<nb)
		 {
		   spanVise.innerHTML .= ' car l\'entrée devrait faire au moins '+nb+' caractères';
		}	*/
	spanVise.style.visibility="visible";
	}

function vider(){
	for(var i=0; i<formulR.length; i++)
			{ formulR[i].value ='';
			}

	}
