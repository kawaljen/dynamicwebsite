$(document).ready(function(){
		
	var currentpage =0,
		padding_conteneur = 5,
		img_width = $('.thumbmenu .face').width()+ 2*padding_conteneur,
		nbimg = $('.thumbmenu').length,
		conteneur_width= $('#thumbmenu').width()-60,
		cards = $('.thumbmenu'),
		page0width=0,
		nbimginapage, 
		page0width,
		current=0,
		next=1;
	
	if (conteneur_width < nbimg*img_width){
		slider();
		}
		else{
			var leftpx =30;
			for(var i=0; i<cards.length ;i++){
				  cards.eq(i).css('left', leftpx+'px');
				  leftpx += 140;
				}
			
			}

function slider(){
		$('.arrow').show();
		var lenght= 0,
			nbimginapage = 0,
			nbpg = 0,
		    checkfirst  = false;
		//Hide thumb that are over the conteneur
		for (var i=0; i<nbimg; i++){		
			lenght += img_width;
			
			if(lenght>conteneur_width){
					if (!checkfirst){
						nbimginapage = i;
						nbpg ++;
						page0width = lenght-img_width;
						$('.thumbmenu').addClass('slpage0');
					  }
					checkfirst  = true;
					$('.thumbmenu').eq(i).hide();
					//organise en pages
					if (i=== (nbpg+1)*nbimginapage){
						 nbpg ++;
					  } 
				    $('.thumbmenu').eq(i).removeClass('slpage0' );
					$('.thumbmenu').eq(i).addClass('slpage'+nbpg );
				}
			
		   }
		if(nbpg>0){ 
			 var fixpadding = ((conteneur_width - page0width)/nbimginapage)/2,
				 leftpx = 30 + fixpadding,
				 arrayleft= [leftpx];
			 for(var i=0; i<cards.length ;i++){				
				  cards.eq(i).css('left', leftpx+'px');
				  if(i < 2*nbimginapage){
					leftpx += img_width +fixpadding;
					}
				  arrayleft.push(leftpx);
				}		  
			}
		
			$('#next').click(function(){
				if (next>nbpg)
					next = 0;
				// if Mozilla, because only one to support flipping card
				if(!navigator.appCodeName == "Mozilla"){
					flipingcard( );
					} 
				else {
					otherbrowsercard(arrayleft);	
				}	
				current = next;
				next++;
				});
			$('#previous').click(function(){
				next-=2; 
				if (next<0)
					next =nbpg;
				if(!navigator.appCodeName == "Mozilla"){
					flipingcard( );
					} 
				else {
					otherbrowsercard(arrayleft);	
				}	
				current = next;
				next +=1;
				});
			}	
	

function otherbrowsercard(arrayleft){
		$('.slpage'+ next).each(function(i){
			var left = (i+1) * conteneur_width;
			//$(this).css('left', '+='+left+'px');
			$(this).css('left', '+='+left+'px');
		});
		$('.slpage'+current).hide();
		$('.slpage'+ next).show();
		$('.slpage'+ next).each(function(i){
			var left = (i+1) * conteneur_width;
			$(this).animate({left : arrayleft[i]+"px"});
		});
		$('.slpage'+current).each(function(i){
			var left = (i+1) * conteneur_width;
			$(this).css('left', '+='+left+'px');
		});
	}	

function flipingcard( ){
		var removehtml='.back';
		if ($('.thumbmenu').hasClass('flipped')){
			 removehtml='.front';
			}
	
	  //add them in the dom to flip the card
	  for (var i =0; i< $('.slpage'+next).length; i++){
		  var page1 =  $('.slpage'+next+' .front').eq(i).html();

		  $('.slpage0 '+removehtml).eq(i).html(page1);
		  }		
	/* -- FLIPPING CARD -- */
		  
			 for(var i=0; i<$('.thumbmenu').length ;i++){
				var card = $('#flipid'+i),
					time = i*80;
				if (card.hasClass('flipped')){
					card.delay(time)
						.queue(function() {
							$(this).removeClass('flipped');     
							 $(this).dequeue();   });	
					}
				else {
					card.delay(time)
						.queue(function() {
							$(this).addClass('flipped');    
							 $(this).dequeue();	   });
					}	
				}
			
		}	

	
$('.thumbmenu img').hover(function(){
	 $(this).next().slideToggle();
	});


});
