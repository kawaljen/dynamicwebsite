<section id="single">
	<h2><?php echo $titrepage;?></h2>
	<div class="main">
		<img src="<?php echo $donnees->imgL();?> " alt="<?php echo $donnees->name();?>" />
	</div>
</section>

<section id="thumbmenu">
	<div class="arrow" id="previous"><</div>
	<div id="conteneur">
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
						<div class="thumbmenu2" >	
							<div class="thumbmenu" id="flipid<?php echo $compt; $compt++;?>">
								<div class="face front">
									<a href="single.php?id=<?php echo $donneescat->id();?>">
										<img src="<?php echo $donneescat->imgS();?> " alt="<?php echo $donneescat->name();?>" />
										<div class="thumbtitle"><p><?php echo $donneescat->name();?></p></div>
									</a>
								</div>
								<div class="face back"></div>
							</div>
						</div>		
		<?php
						endif;
						//if($compt===0 ){echo '</div>';} 
					endforeach;
				else :
					echo 'pas d\'autres items dans cette categorie';
				endif;
				//if($compt!==0 ){echo '</div>';} id="next"
			 endif;
		endif;
	?>
	</div>
	<div class="arrow"id="next" >></div>
</section>
