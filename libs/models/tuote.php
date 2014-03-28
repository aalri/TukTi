<?php
   
class Tuote {

    private $tuotenro;
    private $nimi;
    private $tiedot;
    private $hinta;
    private $jaljella;
    private $lisayskynnys;
    private $lisaysmaara;
    private $poistettu;

    public function __construct($tuotenro, $nimi, $tiedot, $hinta, $jaljella, $lisayskynnys, $lisaysmaara, $poistettu) {
        $this->tuotenro = $tuotenro;
        $this->nimi = $nimi;
        $this->tiedot = $tiedot;
        $this->hinta = $hinta;
        $this->jaljella = $jaljella;
        $this->lisayskynnys = $lisayskynnys;
        $this->lisaysmaara = $lisaysmaara;
        $this->poistettu = $poistettu;
    }

    public function setTuotenro($tuotenro) {
        $this->tuotenro = $tuotenro;
    }

    public function getTuotenro() {
        return $this->tuotenro;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function setTiedot($tiedot) {
        $this->tiedot = $tiedot;
    }

    public function getTiedot() {
        return $this->tiedot;
    }
    
    public function setHinta($hinta) {
        $this->hinta = $hinta;
    }    
    
    public function getHinta() {
        return $this->hinta;
    }
    
    public function setJaljella($jaljella) {
        $this->jaljella= $jaljella;
    }
    
    public function getJaljella() {
        return $this->jaljella;
    }
    
    public function setLisayskynnys($lisayskynnys) {
        $this->lisayskynnys = $lisayskynnys;
    }
    
    public function getLisayskynnys() {
        return $this->lisayskynnys;
    }    
    
    public function setLisaysmaara($lisaysmaara) {
        $this->lisaysmaara = $lisaysmaara;
    }
    
    public function getLisaysmaara() {
        return $this->lisaysmaara;
    }

    public function setPoistettu($poistettu) {
        $this->poistettu= $poistettu;
    }
    
    public function getPoistettu() {
        if ($this->poistettu === 'Kyllä') {
            return true;
        }
        return false;
    }    

    public function poista() {
        $this->poistettu = 'Kyllä';
    }

    public static function getTuotteet() {
        $sql = "SELECT tuotenro, nimi, tiedot, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu FROM Tuote";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote();
            $tuote->setTuotenro($tulos->tuotenro);
            $tuote->setNimi($tulos->nimi);
            $tuote->setTiedot($tulos->tiedot);
            $tuote->setHinta($tulos->hinta);
            $tuote->setJaljella($tulos->jaljella);
            $tuote->setlisayskynnys($tulos->lisayskynnys);
            $tuote->setlisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }
    
    public static function getTuoteryhmaanKuuluvatTuotteet($tuoteryhmanro) {
        $sql = "SELECT A.tuotenro, A.nimi, A.tiedot, A.hinta, A.jaljella, A.lisayskynnys, A.lisaysmaara, A.poistettu FROM Tuote A, Kuuluuryhmiin B where A.tuotenro = B.tuotenro and B.tuoteryhmanro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array((int)$tuoteryhmanro));     
        $tulokset = array();        
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote();
            $tuote->setTuotenro($tulos->tuotenro);
            $tuote->setNimi($tulos->nimi);
            $tuote->setTiedot($tulos->tiedot);
            $tuote->setHinta($tulos->hinta);
            $tuote->setJaljella($tulos->jaljella);
            $tuote->setlisayskynnys($tulos->lisayskynnys);
            $tuote->setlisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);

            $tulokset[] = $tuote;
        }        
        return $tulokset;
    }
    
    public static function getTuoteNimiNumerolla($tuotenro) {        
        $sql = "SELECT nimi FROM Tuote where tuotenro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array((int)$tuotenro));            
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            return $tulos->nimi;
        }      
    }

}
