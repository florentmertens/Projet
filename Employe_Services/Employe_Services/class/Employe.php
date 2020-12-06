<?php
class Employe implements JsonSerializable {
    private $noEmp;
    private $nom;
    private $prenom;
    private $emploi;
    private $sup;
    private $embauche;
    private $sal;
    private $comm;
    private $noServ;

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    // NoEmp
    public function getNoEmp() : int{
        return $this->noEmp;
    }

    public function setNoEmp( int $newNoEmp) : self{
        $this->noEmp = $newNoEmp;
        return $this;
    }

    // Nom
    public function getNom() : ? string{
        return $this->nom;
    }

    public function setNom(? string $newNom) : self{
        $this->nom = $newNom;
        return $this;
    }
    
    // Prenom
    public function getPrenom() : ? string{
        return $this->prenom;
    }

    public function setPrenom(? string $newPrenom) : self{
        $this->prenom = $newPrenom;
        return $this;
    }
    
    // Emploi
    public function getEmploi() : ? string{
        return $this->emploi;
    }

    public function setEmploi(? string $newEmploi) : self{
        $this->emploi = $newEmploi;
        return $this;
    }
    
    // Sup
    public function getSup() : ? int{
        return $this->sup;
    }

    public function setSup(? int $newSup) : self{
        $this->sup = $newSup;
        return $this;
    }
    
    // Embauche
    public function getEmbauche() : ? string{
        return $this->embauche;
    }

    public function setEmbauche(? string $newEmbauche) : self{
        $this->embauche = $newEmbauche;
        return $this;
    }
    
    // Sal
    public function getSal() : ? float{
        return $this->sal;
    }

    public function setSal(? float $newSal) : self{
        $this->sal = $newSal;
        return $this;
    }
    
    // Comm
    public function getComm() : ? float{
        return $this->comm;
    }

    public function setComm(? float $newComm) : self{
        $this->comm = $newComm;
        return $this;
    }
    
    // NoServ
    public function getNoServ() : ? int{
        return $this->noServ;
    }

    public function setNoServ( ? int $newNoServ) : self{
        $this->noServ = $newNoServ;
        return $this;
    }
    
    // Affichage
    public function __toString() : string
    {
        return "[NoEmp] : " . $this->noEmp .
        " [Nom] : " . $this->nom .
        " [Prenom] : " . $this->prenom .
        " [Emploi] : " . $this->emploi .
        " [Sup] : " . $this->sup .
        " [Embauche] : " . $this->embauche .
        " [Sal] : " . $this->sal .
        " [Comm] : " . $this->comm .
        " [NoServ] : " . $this->noServ;
    }
}
?>