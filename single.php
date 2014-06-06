<?php	

//HTML head
	$titrepage= 'oeuvre';
	include('includes/head.php');
	
$iditem= $_GET['id'];
$gestion = new Gestion($db);
if(isset($iditem) ){
	if($gestion->exists($iditem)){
			$ligne=$gestion->selectinput($iditem);		
			 foreach ($ligne as $donnees)  {
			 }	
		}	
}
$titrepage= $donnees->name();
$catid=$donnees->catid();
	
//if(!isset($ligne)){header('Location: index.php'); } 
?>
<body>
<div id="container">
	<div id="colunm1">	
		<div id="title">
			<h1><?php echo $titrepage;?></h1>
		</div>
			
		<div id="section">
			<p><?php echo $donnees->description(); ?></p>
		</div>

		<?php include('includes/menu.php');?>
	</div>

<?php include('includes/templates/templatesingle.php');?>


</div><!-- end container -->

</body>
</html>


