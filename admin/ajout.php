<?php
if (isset ($_GET['action'])){
	if ($_GET['action'] === "V"){
		if (!isset ($_GET['id']))
			header('Location: admin.php'); 
		else
			header('Location: admin.php?id='.$_GET['id']); 
	}
}
include("../tools/connectbd.php");
include("../tools/functions.php");

$gestion = new Gestion($db);
$err = ' ';	
$mess = ' ';	


if(!empty($_POST) && !isset($_POST['deleteid'])){
	$err .= $gestion->update ($_POST, $_FILES );
}
if(isset($_POST['deleteid'])){
	$err .= $gestion->delete ($_POST['deleteid']);
}
					
//HTML head
	$titrepage="Admin ajout";
	include('headadmin.php');

?>
<body>
	
<div id="menu_admin" class="row">
	<h1 class="col">Espace Admin</h1>
	<form method="get" action="ajout.php" name="id" class="form-inline col">
			<select name="action" class="form-control">
			  <option value="M">Modifier/Ajouter</option>
			  <option value="V">Visualiser</option>
			</select> 
			<input type="text" size="70" name="id" class="form-control" placeholder="Entre un id un nom d'oeuvre "/>
			<input type="submit" value ="Chercher"  class="btn btn-primary">
	</form>

</div>	

<div class="container">


<div id="main">
<!--espace admin-->	
<?php if(isset($_POST['id']) || isset($_GET['id']) ){
	 $id = (empty($_POST['id'])) ? $_GET['id'] : $_POST['id'];
	if($gestion->exists($id)){
			$ligne = $gestion->selectinput($id);		
			 foreach ($ligne as $donnees)  {

			 }	
		}
	
}
?>
		
	
	<?php 	if (count($ligne)>1){ echo '<div class="bg-warning"><h4 class="bs-callout-warning">Info de la recherche</h4><p>La recherche a renvoyee plusieurs items, seule la premiere occurence est affichee.<br/>';
					echo 'Les autres occurences sont accessibles via ces liens : </p>';
					 foreach ($ligne as $donneesdouble)  {
						echo '<a href="ajout.php?id='.$donneesdouble->id().'">'.$donneesdouble->name().'</a><br/>';
					 }	
					 echo '<br/></div>';
			  }
			if ($err!== ' '){ echo '<div class="bg-danger"><h4 class="bs-callout-danger">Info des updates</h4><p>'.$err.'</p></div>'; }
			if (!empty($ligne)){
				  echo '<h4 class ="btn-warning">Modifier/ effacer une entrée dans la doc</h4>
						<p>ID de l\'oeuvre : '.$donnees->id(). '</p>';	
				}
			else 
				echo '<h4 class ="btn-success">Ajouter une entrée dans la doc</h4>';
	?>

		<form method="post" action="ajout.php" name="ajout" enctype="multipart/form-data">
			
			
			<label for="titre">Titre</label><input type="text" class="form-control" name="piece_name" value ="<?php if(!empty($ligne)){echo $donnees->name();}?>"/>
			
			
			<!--<span class="messerreur">Ce champ ne peut pas être vide (min 10aractères)</span>-->
			<textarea class="form-control"  name="piece_desc" rows="8" cols="70">	<?php if(!empty($ligne)){echo $donnees->description();}else {echo 'Description';} ?>	</textarea>
			
			<h3>Categorie</h3>
			<div>
				<?php $cat=$gestion->getcat();
					for($i=0; $i<count($cat['id']); $i++){	
						echo '<input type="checkbox" class="form-control"  name="cat_id" value ="'.$cat['id'][$i].'"';		
						if(!empty($ligne)){
							if ($cat['id'][$i] == $donnees->catid())	
								echo 'checked';	
							}						
						echo '/> <label for="cat_id">'.$cat['name'][$i].'</label>';	
						
						}
				?>
			</div><div class="clr"></div>
			
			<h3>Images</h3>
			<p>3 tailles d'image sont necessaires, mais tu n'as besoin d'uploader qu'une image, la grande, car le script va creer les 2 autres. </p>
			<?php if(!empty($ligne)): ?>
				<div class="col-md-3 imgadmthumb"> 
					<img src="../<?php echo $donnees->imgL();?> " width=200 />
				</div>
				<div class="imgadmin dispnone"> 
					<p>X</p>
					<img src="../<?php echo $donnees->imgL();?> " />
				</div>
			<?php endif; ?>
			<div class="form-group">
				<label for="large">Grande - Version originale et obligatoire</label>
				<input type="file" id="large" name="large"/>
				<p class="help-block">max 100000 octets, seul le format jpg est supporte pour le moment</p>
			</div>
			<div class="disable">
					<p class="clearboth"> --Cet espace est desactive, fonctions pas encore implemetee -- <br/>Par defaut les images seront redimensionnees et centree. Pour personnaliser le cadrage, tu peux entrer toi meme l'image dans la dimension souhaitee. Attention aux dimensions, le script te redimentionnera aussi ta nouvelle image si elle n'est pas a la taille voulue.</p>
					
					<?php if(!empty($ligne)): ?>
						<div class="col-md-3 imgadmthumb"> 
							<img src="../<?php echo $donnees->imgM();?> " width=200 />
						</div>
						<div class="imgadmin dispnone"> 
							<p>X</p>
							<img src="../<?php echo $donnees->imgM();?> " />
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label for="medium">Moyenne (apparait dans les page de categories)</label>
						<input type="file" id="medium" name="medium" disabled>
						<p class="help-block">400px de largeur</p>
					</div>
					<div class="clearboth"></div>
					
					<?php if(!empty($ligne)): ?>
						<div class="col-md-3 imgadmthumb"> 
							<img src="../<?php echo $donnees->imgS();?> " width=100 />
						</div>
						<div class="imgadmin dispnone"> 
							<p>X</p>
							<img src="../<?php echo $donnees->imgS();?> " />
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label for="thumb">Thumbnail</label>
						<input type="file" id="thumb" name="thumb" disabled>
						<p class="help-block">100px de largeur</p>
					</div>
			</div>
			
			<?php
					if(!empty($ligne)){
						echo '<input type="hidden" name="id" value="'.$donnees->id().'"/>';
						echo '<input type="hidden" name="mod" value="'.$donnees->id().'"/>';	
						}
					else
						echo '<input type="hidden" name="id" value="'.$gestion->getmaxid().'"/>';
						
			?>
			<input type="submit" value ="<?php if(!empty($ligne)){echo 'MODIFIER" class="form-control btn btn-warning';}else {echo 'AJOUTER" class="form-control btn btn-success';}?> ">
		</form>
		<?php if(!empty($ligne)): ?>
			<form method="post" action="ajout.php" id="deleteitem">
				<input type="hidden" name="deleteid" value="<?php echo $donnees->id(); ?>"/>
				<input type="button" value ="EFFACER" class="form-control btn btn-danger" id="mess">
			</form>		
			<div id="mess_delete" class="dispnone">
				<h4>Effacer cette entree ? Operation defintive.</h4>
				<div class ="btn-success"><p> Non, revenir en arriere </p></div>
				<div class ="btn-danger"  id="envoi"><p > Oui, effacer</p></div>
			</div>
			
		<?php endif; ?>
					


	</div><!--info ferme la div main-->

		
</div>	<!--fin div container-->
<script src="../js/admin.js" type="text/javascript"></script>
</body>
</html>

