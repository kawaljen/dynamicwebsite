<?php
include("connectbd.php");
include("functions.php");

$gestion = new Gestion($db);
		
//HTML head
	$titrepage="Admin Général";
	include('head.php');

?>
<body>

<div id="container">

	
<!--Diaporama-->	
	<div id="diaporama">
		<img src="micronauts.png"  alt="micronauts" />
	</div>

<!--espace admin-->	
	<div id="esp_admin">
	<h1>Espace Admin</h1>
	<h2><a href="index.php" id="recherche">Stock de doc /</a>
	<a href="ajout.php"> Ajout de doc</a></h2>

			

<!--Recherche artcle-->
					<div id="rech_art">
						<?php $motclef = $gestion->recupmotclef();
							echo ' <h4>Tous les mots clefs </h4><p><b>';
							for($i=0; $i<count($motclef); $i++)
								echo '<a href="index.php?mc='.htmlspecialchars($motclef[$i]).'#recherche" > -- '.$motclef[$i].' -- > </a>';	
							echo '</b></p>';
						?>
						<form method="post" action="index.php#recherche" name="1">
						<h5>Recherche par mot clef ou id article</h5>
							<label for="recherche"> Valeur : </label><input type="text" name="recherche"/>
							<input type="submit" value="chercher">
						</form>
					</div>
					
					
<!--Liste article-->

				<?php 
									
					if(!empty($_POST['recherche'])){
							if($gestion->exists($_POST['recherche'])){
								$ligne=$gestion->selectinput($_POST['recherche']);
								}
							}
				    else if(!empty($_GET['mc']))	{
							if($gestion->exists($_GET['mc'])){
								$ligne=$gestion->selectinput($_GET['mc']);	
								}
							}	
							
					if (empty($ligne)){
						  echo 'La recherche n\'a donné aucun résultat.';
						}
					
					else{
						echo '<h4>>> Choix de recherche : ';
							if(isset($_POST['recherche']))
								echo 'recherche = '.$_POST['recherche'].'</h4>';
							else if (isset($_GET['mc']))
								echo 'mot = '.$_GET['mc'].'</h4>';
							
						  foreach ($ligne as $donnees)  {

								echo '<h2>'.$donnees->doctitre().'</h2>';
								echo '<p>'.$donnees->doctopo().'</p>';
								echo '<a href="'.$donnees->doclien().'" target=_blank>--->'.$donnees->doclien().'<---</a>';
								echo '<p>Mots clefs : '.$donnees->docmotclef().' </p><p>ID article : '.$donnees->docid().'</p>';
	
							}
						}	
				?>


	<div class="clr"></div>
	<!--info ferme la div categorie-->
	</div>

<!--fin div container-->		
</div>	



</body>
</html>

