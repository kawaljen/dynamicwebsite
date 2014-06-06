<?php
if (isset ($_GET['action'])){
	if ($_GET['action'] === "M"){
		if (!isset ($_GET['id']))
			header('Location: ajout.php'); 
		else
			header('Location: ajout.php?id='.$_GET['id']); 
	}
}
include("../tools/connectbd.php");
include("../tools/functions.php");

$gestion = new Gestion($db);

		
//HTML head
	$titrepage="Admin Général";
	include('headadmin.php');

?>
<body>
	
<div id="menu_admin" class="row">
	<h1 class="col">Espace Admin</h1>
	<form method="get" action="admin.php" class="form-inline col">
			<select name="action" class="form-control">
			  <option value="V">Visualiser</option>
			  <option value="M">Modifier/Ajouter</option>
			</select> 
			<input type="text"  size="70" name="id" class="form-control" placeholder="Entre un id ou un nom d'oeuvre, laisse le champ vide pour avoir la liste"/>
			<input type="submit" value ="Chercher"  class="btn btn-primary">
	</form>

</div>	

<div class="container">



<div id="main">
		
					
<!--Liste article-->

<?php 					
	if(isset($_GET['id']) && $_GET['id'] != null):				
		if($gestion->exists($_GET['id'])):
			$ligne=$gestion->selectinput($_GET['id']);
			echo '<h4>>> Choix de recherche : '.$_GET['id'].'</h4>';
				
			  foreach ($ligne as $donnees):

					echo '<h2>'.$donnees->name().'</h2>';
					echo '<p>Description : <br/>'.$donnees->description().'</p>';
					echo '<p>ID oeuvre : '.$donnees->id().'</p>';?>

				<div class="col-md-3 imgadmthumb"> 
					<p>image principale</p>
					<img src="../<?php echo $donnees->imgL();?> " width=200 />
				</div>
				<div class="imgadmin dispnone"> 
					<p>X</p>
					<img src="../<?php echo $donnees->imgL();?> " />
				</div>
					
			
				<div class="col-md-3 imgadmthumb"> 
					<p>image moyenne</p>
					<img src="../<?php echo $donnees->imgM();?> " width=200 />
				</div>
				<div class="imgadmin dispnone"> 
					<p>X</p>
					<img src="../<?php echo $donnees->imgM();?> " />
				</div>
								

				<div class="col-md-3 imgadmthumb"> 
					<p>thumbnail</p>
					<img src="../<?php echo $donnees->imgS();?> " />
				</div>
				<div class="imgadmin dispnone"> 
					<p>X</p>
					<img src="../<?php echo $donnees->imgS();?> " />
				</div>	
				<div class="clearboth"></div>				
<?php 		endforeach;  
		endif; 
	else : 
	echo 'Clique sur une oeuvre pour la modifier, pour la visualiser copie son nom ou son id dans la barre de recherche';
	$cat = $gestion-> getcat();
		for ($i=0; $i<count($cat); $i++){		
			if ($gestion->existscat($cat['id'][$i])){	
				echo  '<h2>Categorie '.$cat['name'][$i].'</h2>';
				$lignescat = $gestion->selectinputcat($cat['id'][$i]);
			  foreach ($lignescat as $donnees):
					echo '<a href="ajout.php?id='.$donnees->id().'">'.$donnees->name().'</a><br/>';
			  endforeach; 	
			  }
			}		
	?>
	
	
		
<?php	endif;?>


	<div class="clr"></div>
	<!--info ferme la div categorie-->
	</div>

<!--fin div container-->		
</div>	



</body>
</html>

