<?php	

//HTML head
	$titrepage="Peintures Murale";
	$catid=3;
	include('includes/head.php');
	
?>
<body>
<div id="container">
	<div id="colunm1">	
		<div id="title">
			<h1><?php echo $titrepage;?></h1>
		</div>
			
		<div id="section">
			<p>Lorem Ipsum är en utfyllnadstext från tryck- och förlagsindustrin. Lorem ipsum har varit standard ända sedan 1500-talet, 
			när en okänd boksättare tog att antal bokstäver och blandade dem för att göra ett provexemplar av en bok. Lorem ipsum har 
			inte bara överlevt fem århundraden, utan även övergången till elektronisk typografi utan större förändringar. Det blev allmänt 
			känt på 1960-talet i samband med lanseringen av Letraset-ark med avsnitt av Lorem Ipsum, och senare med mjukvaror som Aldus PageMaker.</p>
		</div>

		<?php include('includes/menu.php');?>
	</div>

<?php include('includes/templates/general.php');?>


</div><!-- end container -->

</body>
</html>


