<div id="colunm2">	
	<?php
	$gestion = new Gestion($db);
	if(isset($catid)){
			if($gestion->existscat($catid)){
				$ligne=$gestion->selectinputcat($catid);
			}
		} 
	else{		echo '<p>Pas de categorie siginiee, la variable catid est vide, ne l\'aurais tu pas effacer ?</p>';		}
	$compt=0;
	$page=0;
	?>
	<section id="general">
		<h2><?php echo $titrepage;?></h2>
		<?php if(isset($ligne)): ?>
			
				<?php foreach ($ligne as $donnees): 
					if($compt===0 && $page===0){echo '<div id="page'.$page.'" >';}
					else if($compt===0 && $page>0) {echo '<div id="page'.$page.'" >';}
					$compt++;
					if($compt>5){
						$page++;
						$compt=0;
						}
						?>
				
				<div class="imgboard"> 
					<a href="single.php?id=<?php echo $donnees->id();?>">
						<img src="<?php echo $donnees->imgM();?> " alt="<?php echo $donnees->name();?>" />
					</a>
				</div>

				<?php if($compt===0 ){echo '</div>';} ?>
						
				<?php endforeach; ?>
			<?php 
			if($compt!==6 ){echo '</div>';} 

			?>
		<?php else :?>
			<p>Cette categorie n'a aucun items </p><!-- ou $catid est faux-->
		<?php endif; ?>
		<div class="clear"></div>
	</section>
</div>
