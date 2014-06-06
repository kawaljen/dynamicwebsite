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

  
//recuperer valeurs des mots clefs	
	public function recupmotclef() {
		$motclef=array();
		$reponse = $this->_db->query('SELECT DISTINCT docmotclef FROM doc_mots_clefs');
		while ($donnees = $reponse->fetch()){	
				$motclef[]=$donnees['docmotclef'];	
				}
		return $motclef;

	}
	
//est ce que l'entrée existe 
	public function exists($info) {
		if (is_numeric($info)) // On veut voir si tel personnage ayant pour id $info existe.
			{
			  return (bool) $this->_db->query('SELECT COUNT(*) FROM doc_article WHERE docid = '.$info)->fetchColumn();
			}
		
		// Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
		$q = $this->_db->prepare('SELECT COUNT(*) FROM doc_mots_clefs WHERE docmotclef = :nom');
		$q->execute(array(':nom' => $info));
		
		return (bool) $q->fetchColumn();
	  }	
	
	
	
//selectionner un article suivant un mot clef
	public function selectinput($info){
			
			$lignes = array();
			$occ = array();
			
		
			if (is_numeric($info))
				{$occ[]= $info;}
			else 
				{
				  $q = $this->_db->prepare('SELECT * FROM doc_article NATURAL JOIN doc_mots_clefs WHERE docmotclef LIKE :info OR docid =:info');
				  $q ->bindValue('info', "%".$info."%", PDO::PARAM_STR);
				  $q-> execute();
					  while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
							{  $occ[] =$donnees['docid'];}
				}	
			
			for ($i=0; $i<count($occ); $i++)
				{	$mc= ' ';
					$q = $this->_db->query('SELECT * FROM doc_article WHERE docid = '.$occ[$i]);
					$donnees = $q->fetch(PDO::FETCH_ASSOC);
					$q->closeCursor();
					$q = NULL;
							
					$q = $this->_db->query('SELECT * FROM doc_mots_clefs WHERE docid = '.$occ[$i]);
					while ($donnees_mc = $q->fetch(PDO::FETCH_ASSOC))
							{  $mc .= $donnees_mc['docmotclef'].' - - ';}
							
					$donnees['docmotclef']=	 $mc;
					$lignes[] = new Ligne($donnees);
				}

		    return $lignes;
		}
		
//inserer une nouvelle doc 	
	public function insertvaleur( $titre, $resume,$lien, $id){
		$query = 'INSERT INTO doc_article (doctitre, doctopo, doclien, docid) VALUES (:titre, :topo, :resume, :id)';
		$prep = $this->_db -> prepare($query);
		$prep -> bindValue('titre', $titre, PDO::PARAM_STR);
		$prep -> bindValue('topo', $resume, PDO::PARAM_STR);
		$prep -> bindValue('resume', $lien, PDO::PARAM_STR);
		$prep -> bindValue('id', $id, PDO::PARAM_INT);
		$prep -> execute();
		$prep->closeCursor();
		$prep = NULL;	
	}
	
//update une doc +	remise à 0 des mot clefs
	public function modifvaleur( $titre, $resume,$lien,$id){
		$query = 'UPDATE doc_article SET doctitre=:titre, doctopo=:topo, doclien=:resume WHERE docid=:id';
		$prep = $this->_db -> prepare($query);
		$prep -> bindValue('titre', $titre, PDO::PARAM_STR);
		$prep -> bindValue('topo', $resume, PDO::PARAM_STR);
		$prep -> bindValue('resume', $lien, PDO::PARAM_STR);
		$prep -> bindValue('id', $id, PDO::PARAM_INT);
		$prep -> execute();
		$prep->closeCursor();
		$prep = NULL;	
		
		$this->deletemc($id);
	}
	
	public function deletemc($id) {
		$this->_db->exec('DELETE FROM doc_mots_clefs WHERE docid = '.$id);
	}	
	
//inserer une nouvelle doc Mot clef
	public function insertvaleurmc( $id, $motclef){
		$query = 'INSERT INTO doc_mots_clefs (docmotclef, docid) VALUES (:motclef, :id)';
		$prep = $this->_db -> prepare($query);
		$prep -> bindValue('motclef', $motclef, PDO::PARAM_STR);
		$prep -> bindValue('id', $id, PDO::PARAM_INT);
		$prep -> execute();
		$prep->closeCursor();
		$prep = NULL;
	}

	public function getmaxid() {
		$reponse = $this->_db->query('SELECT MAX(docid) as max FROM doc_article');
		$donnees = $reponse->fetch();
		return ($donnees['max']+1);
	}

}


class Ligne{
	
  private $_doctitre,
          $_docid,
          $_doctopo,
          $_doclien,
          $_docmotclef;
 
  
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



  public function doctitre()  {return $this->_doctitre;}
  public function docid()  {return $this->_docid;}
  public function doctopo()  {return $this->_doctopo;}
  public function doclien()  {return $this->_doclien;}
  public function docmotclef()  {return $this->_docmotclef;}
  
  public function setDoctitre($doctitre)  {
    if (is_string($doctitre)) {
      $this->_doctitre = $doctitre;
    }
  }
  
  public function setDocid($docid) { $this->_docid = $docid; }
  public function setDoctopo($doctopo) { $this->_doctopo = $doctopo; }
  public function setDoclien($doclien) { $this->_doclien = $doclien; }
  public function setDocmotclef($docmotclef) { $this->_docmotclef = $docmotclef; }
  
  
  
}	
	
	
	
	
	
	
?>
