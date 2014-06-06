<section id="single">
	<h2><?php echo $titrepage;?></h2>
	<div class="main">
		<img src="<?php echo $donnees->imgL();?> " alt="<?php echo $donnees->name();?>" />
	</div>
</section>

<section id="thumbmenu">
<?php
$catid = $donnees->catid();
$compt=0;
$page=0;
if(isset($catid)):
		if($gestion->existscat($catid)):
			$lignecat=$gestion->selectinputcat($catid);
			if(count($lignecat)>1):
				foreach ($lignecat as $donneescat):
					if ($donneescat->id() !== $donnees->id()):
						/*if($compt===0 && $page===0){echo '<div id="page'.$page.'" >';}
						else if($compt===0 && $page>0) {echo '<div id="page'.$page.'" >';}
						$compt++;
						if($compt>5){
							$page++;
							$compt=0;
							}*/
	?>
						<div class="thumbmenu">
							<a href="single.php?id=<?php echo $donneescat->id();?>">
								<img src="<?php echo $donneescat->imgS();?> " alt="<?php echo $donneescat->name();?>" />
							</a>
						</div>		
	<?php
					endif;
					//if($compt===0 ){echo '</div>';} 
				endforeach;
			else :
				echo 'pas d\'autres items dans cette categorie';
			endif;
			//if($compt!==0 ){echo '</div>';} 
	     endif;
	endif;
?>

</section>
