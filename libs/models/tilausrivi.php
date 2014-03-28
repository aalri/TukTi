<?php
   
class Tilausrivi {

    private $tilausnro;
    private $tuotenro;
    private $lkm;
    private $ostohetkenkplhinta;

    public function __construct($tilausnro, $tuotenro, $lkm, $ostohetkenkplhinta) {
        $this->tilausnro = $tilausnro;
        $this->tuotenro = $tuotenro;
        $this->lkm = $lkm;
        $this->ostohetkenkplhinta = $ostohetkenkplhinta;
    }

    public function setTilausnro($tilausnro) {
        $this->tilausnro = $tilausnro;
    }

    public function getTilausnro() {
        return $this->tilausnro;
    }

    public function setTuotenro($tuotenro) {
        $this->tuotenro = $tuotenro;
    }

    public function getTuotenro() {
        return $this->tuotenro;
    }

    public function setLkm($lkm) {
        $this->lkm = $lkm;
    }

    public function getLkm() {
        return $this->lkm;
    }
    
    public function setOstoHetkenKplhinta($ostohetkenkplhinta) {
        $this->ostohetkenkplhinta= $ostohetkenkplhinta;
    }    
    
    public function getOstoHetkenKplhinta() {
        return $this->ostohetkenkplhinta;
    }
    
    public function getYhteensa() {
        return $this->lkm * $this->ostohetkenkplhinta;
    }

    public static function getTilausrivit() {
        $sql = "SELECT tilausnro, tuotenro, lkm, ostohetkenkplhinta FROM Tilausrivi";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilausrivi = new Tilausrivi();
            $tilausrivi->setTilausnro($tulos->tilausnro);
            $tilausrivi->setTuotenro($tulos->tuotenro);
            $tilausrivi->setLkm($tulos->lkm);
            $tilausrivi->setOstoHetkenKplhinta($tulos->ostohetkenkplhinta);
            $tulokset[] = $tilausrivi;
        }
        return $tulokset;
    }
    
    public static function getTilausrivitTilausnumerolla($tilausnro) {
        $sql = "SELECT tilausnro, tuotenro, lkm, ostohetkenkplhinta FROM Tilausrivi where tilausnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilausrivi = new Tilausrivi();
            $tilausrivi->setTilausnro($tulos->tilausnro);
            $tilausrivi->setTuotenro($tulos->tuotenro);
            $tilausrivi->setLkm($tulos->lkm);
            $tilausrivi->setOstoHetkenKplhinta($tulos->ostohetkenkplhinta);

            $tulokset[] = $tilausrivi;
        }
        return $tulokset;
    }    
    
    public static function getTilausrivitHintaYhteensaTilausnumerolla($tilausnro) {
        $sql = "SELECT lkm, ostohetkenkplhinta FROM Tilausrivi where tilausnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));        
        $yhteensa = 0.0;
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {            
            $yhteensa += (double)$tulos->lkm * (double)$tulos->ostohetkenkplhinta;
        }
        return $yhteensa;
    }    

}
