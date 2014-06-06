<?php

class Gestion{
	
    private $_db; // Instance de PDO
	  
	public function __construct($db)  {
		$this->setDb($db);
		}

//Set db
	public function setDb(PDO $db)  {
		$this->_db = $db;
	}

//get lsit off all items	
	public function getlist() {
		$cat = $this-> getcat();
		for ($i=0; $i<count($cat); $i++){
			$lignes[] = $this->selectinputcat($cat['id'][$i]);
		}
		 return $lignes;
	
	}

  
//fetch category name	
	public function getcat() {
		$cat['id']=array();
		$cat['name']= array();
		
		$reponse = $this->_db->query('SELECT * FROM Category');
			while ($donnees = $reponse->fetch()){	
					$cat['id'][]=$donnees['catid'];
					$cat['name'][]=$donnees['catname'];
					}
			return $cat;	
	}
	
//check if items not empty
	public function exists($info) {
		if (is_numeric($info)) {
			  return (bool) $this->_db->query('SELECT COUNT(*) FROM Piece WHERE id = '.$info)->fetchColumn();}
		
		$q = $this->_db->prepare('SELECT COUNT(*) FROM Piece WHERE name LIKE :nom'); 
		$q ->bindValue('nom', "%".$info."%", PDO::PARAM_STR);
		$q-> execute();
		return (bool) $q->fetchColumn();
	  }	
	  
//check if categorie not empty
	public function existscat($info) {
		if (is_numeric($info)) {
			  return (bool) $this->_db->query('SELECT COUNT(*) FROM Piece WHERE catid = '.$info)->fetchColumn();
			}
		
		return false;
	  }	
	
//selectionner un article suivant son nom ou id
	public function selectinput($info){		
			$lignes = array();

			if (is_numeric($info))	{
				    $q = $this->_db->query('SELECT * FROM Piece WHERE id = '.$info);
					$donnees = $q->fetch(PDO::FETCH_ASSOC);
					$q->closeCursor();
					$q = NULL;
					
					$lignes[] = new Ligne($donnees);
					}
			else 
				{
					if(strlen ($info)>3){
						$q = $this->_db->prepare('SELECT * FROM Piece WHERE name LIKE :nom'); 
						$q ->bindValue('nom', "%".$info."%", PDO::PARAM_STR);
						$q-> execute();
						 while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){	
								$lignes [] = new Ligne($donnees);	
								}
						$q->closeCursor();
						$q = NULL;
					}
				}

		    return $lignes;
		}
		
//selectionner un article suivant une categorie
	public function selectinputcat($id){
			$lignes = array();
			if (is_numeric($id)){

				  $q = $this->_db->prepare('SELECT * FROM Piece NATURAL JOIN Category WHERE catid =:id');
				  $q ->bindValue('id', $id, PDO::PARAM_INT);
				  $q-> execute();
					  while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
							{  $lignes[] = new Ligne($donnees);}
				$q->closeCursor();
				$q = NULL;
				}	
		    return $lignes;
		}
		
//upadte		
	public function update($post, $files){
		if(!empty($post['piece_name']) && !empty($post['piece_desc']) && !empty($post['cat_id']) ){
				//modifier
				if (isset($post['mod'])){
					return $this->modifier ($post, $files );}
				//ajouter
				else if( $files['large']['error'] <= 0 ) {
							$this->insertvaleur($post['piece_name'], $post['piece_desc'], $post['cat_id'], $post['id'] );
							return'Les informations text ont bien ete enregistrees <br/> '. $this->createimgsize($files['large'], $post['id']);}	
					else {
							return '- Erreur utilisateur, operation ignoree car d\'image proposee, <br/> Verifies tes informations - ';	}	
			}
		else {return '- Erreur utilisateur, operation ignoree car un ou plusieurs des champs nom, description ou categorie etai-en-t vide-e-s <br/> Verifies tes informations - ';}
			
		return 'exception non traitee a la fonction update, contacte moi pour regler ca, avec un copier/coller de ce message stp';
		}
		
//modifier
	public function modifier($post, $files){
			if($this->exists($post['mod'])){
				
				$this->modifvaleur($post['piece_name'], $post['piece_desc'], $post['cat_id'], $post['mod'] );
				$err = 'Les informations text ont bien ete enregistrees <br/> ';
				
				if( $files['large']['error'] <= 0 ) {
					if( !isset ($files['medium']['error'] )) {
						if( !isset ($files['thumb']['error'] )) {
							return $err.' '. $this->createimgsize($files['large'],$post['mod'] );	}
						else {
							return $err.'- l\'image Thumbnail envoyee n\'a pas ete enregistree et a ete ignoree, car la possibilite d\'importer des images avec un cadrage personnalise n\a pas encore ete implantee, la serie d\'images a ete cree automatiquement par le script - ';}									
						}
					else {
						return  $err.'- l\'image Moyenne envoyee n\'a pas ete enregistree et a ete ignoree, car la possibilite d\'importer des images avec un cadrage personnalise n\a pas encore ete implantee, la serie d\'images a ete cree automatiquement par le script - ';}									
					}
				else {
					return '- info pas d\'image uploadee, les autres informations ont ete modifiees - ';}
			}
			else{
					return '- Cette entree n\'existe pas dans la base de donnee (erreur a la fonction exists ), donc modification annulee - ';}
			
			return 'exception non traitee a la fonction modifier, contacte moi pour regler ca, avec un copier/coller de ce message stp';
		}
		
//new entry piece 	
	public function insertvaleur( $name, $desc, $catid, $id){
		$query = 'INSERT INTO Piece (id, name, description, catid) VALUES (:id, :name, :desc, :catid)';
		$prep = $this->_db -> prepare($query);
		$prep -> bindValue('id', $id, PDO::PARAM_INT);
		$prep -> bindValue('name', $name, PDO::PARAM_STR);
		$prep -> bindValue('desc', $desc, PDO::PARAM_STR);
		$prep -> bindValue('catid', $catid, PDO::PARAM_INT);
		$prep -> execute();
		$prep->closeCursor();
		$prep = NULL;	
		
		//$ligne = $this->selectinput($name);
		
		//return 
		
		
	}
	
//update une doc +	
	public function modifvaleur( $name, $desc, $catid, $id){
		$query = 'UPDATE Piece SET name=:name, description=:desc, catid=:catid WHERE id=:id';
		$prep = $this->_db -> prepare($query);
		$prep -> bindValue('name', $name, PDO::PARAM_STR);
		$prep -> bindValue('desc', $desc, PDO::PARAM_STR);
		$prep -> bindValue('catid', $catid, PDO::PARAM_INT);
		$prep -> bindValue('id', $id, PDO::PARAM_INT);	
		$prep -> execute();
		$prep->closeCursor();
		$prep = NULL;	
	
	}
	
	public function delete($id) {
		if (is_numeric($id)) {
			if($this->exists($id)){
				$this->_db->exec('DELETE FROM Piece WHERE id = '.$id);
				return 'L\'item a bien ete efface.';
			}
			return 'Erreur a la suppression, cet item n\'existe pas, operation ignoree.';
		}
		return 'Erreur a la suppression, cet id n\'est pas valide , operation ignoree.';
	}	


	public function getmaxid() {
		$reponse = $this->_db->query('SELECT MAX(id) as max FROM Piece');
		$donnees = $reponse->fetch();
		return ($donnees['max']+1);
	}
	
	
	
// creer img
public function createimgsize($img, $id) {
	

				$ListeExtension = array('jpg' => 'image/jpeg', 'jpeg'=>'image/jpeg');
				$ListeExtensionIE = array('jpg' => 'image/pjpeg', 'jpeg'=>'image/pjpeg');

						$TitreNews = $img['name'].'change1';
						$ContenuNews = 'test';
		 
						if ($img['error'] <= 0)
						{
								if ($img['size'] <= 2097152)
								{
									$ImageNews = $img['name'];

									$ExtensionPresumee = explode('.', $ImageNews);
									$ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
									if ($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg')
									{
									  $ImageNews = getimagesize($img['tmp_name']);
									 // if($ImageNews['mime'] == $ListeExtension[$ExtensionPresumee]  || $ImageNews['mime'] == $ListeExtensionIE[$ExtensionPresumee])
									//	{
		 
													  $ImageChoisie = imagecreatefromjpeg($img['tmp_name']);
													  $TailleImageChoisie = getimagesize($img['tmp_name']);
													  $NouvelleLargeur = 200; //Largeur choisie à 350 px 
													  $NouvelleLargeur2 = 100; //Largeur choisie à 50 px 
		 
													  $NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) );
													  $NouvelleHauteur2 = ( ($TailleImageChoisie[1] * (($NouvelleLargeur2)/$TailleImageChoisie[0])) );	
													
													  $NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
													  $NouvelleImage2 = imagecreatetruecolor($NouvelleLargeur2 , $NouvelleHauteur2) or die ("Erreur");
		 
													  imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
													  imagecopyresampled($NouvelleImage2 , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur2, $NouvelleHauteur2, $TailleImageChoisie[0],$TailleImageChoisie[1]);

													  $Nameimg = basename($img['name']);													 
													  $Nameimg = strtr($Nameimg,  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'); 
													  $Nameimg = preg_replace('/([^.a-z0-9]+)/i', '-', $Nameimg);

													  
													  imagejpeg($NouvelleImage , '../pieces/medium/'.$Nameimg, 100);
													  imagejpeg($NouvelleImage2 , '../pieces/thumb/'.$Nameimg, 100);
													  imagejpeg( $ImageChoisie  , '../pieces/'.$Nameimg, 100);
													  
													  //$LienImageNews = 'imagesnews/'.$NomImageExploitable.'.'.$ExtensionPresumee;
		 
														$query = 'UPDATE Piece SET imgL=:imgL, imgM=:imgM, imgS=:imgS WHERE id=:id';
														$prep = $this->_db -> prepare($query);
														$prep -> bindValue('imgL', 'pieces/'.$Nameimg);
														$prep -> bindValue('imgM', 'pieces/medium/'.$Nameimg);	
														$prep -> bindValue('imgS', 'pieces/thumb/'.$Nameimg);
														$prep -> bindValue('id', $id, PDO::PARAM_INT);					
														$prep -> execute();
														$prep->closeCursor();
														$prep = NULL;
													  //if ($res)
													  //{
															  return 'La nouvelle image a bien été insérée';
													 // }
											/*			}
										else
												{
														return 'Le type MIME de l\'image n\'est pas bon';
												
												}*/
										}
										else
										{
												return 'L\'extension choisie pour l\'image est incorrecte';
										}
								}
								else
								{
										return 'L\'image est trop lourde';
								}
						}
						else
						{
								return 'Erreur lors de l\'upload image';
						}
				}

}


class Ligne{
	
  private $_name,
          $_id,
          $_catid,
          $_catname,
          $_description,
          $_imgS,
          $_imgM,
          $_imgL;

 
  
  public function __construct(array $donnees) {
    $this->hydrate($donnees);
  }

  public function hydrate(array $donnees)  {
    foreach ($donnees as $key => $value) {
      $method = 'set'.ucfirst($key);
      
      if (method_exists($this, $method))  {
        $this->$method($value);
      }
    }
  }



  public function name()  {return $this->_name;}
  public function id()  {return $this->_id;}
  public function description()  {return $this->_description;}
  public function catid()  {return $this->_catid;}
  public function catname()  {return $this->_catname;}
  public function imgL()  {return $this->_imgL;}
  public function imgM()  {return $this->_imgM;}
  public function imgS()  {return $this->_imgS;}
  
  public function setname($name)  {
    if (is_string($name)) {
      $this->_name = $name;
    }
  }
  
  public function setid($id) { $this->_id = $id; }
  public function setdescription($description) { $this->_description = $description; }
  public function setcatid($catid) { $this->_catid = $catid; }
  public function setcatname($catname) { $this->_catname = $catname; } 
  public function setimgL($imgL) { $this->_imgL = $imgL; }  
  public function setimgM($imgM) { $this->_imgM = $imgM; }  
  public function setimgS($imgS) { $this->_imgS = $imgS; }    
  
}	
	
	
	
	
	
	
?>
