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
        $this->ostohetkenkplhinta = $ostohetkenkplhinta;
    }

    public function getOstoHetkenKplhinta() {
        return $this->ostohetkenkplhinta;
    }

    public function getYhteensa() {
        return $this->lkm * $this->ostohetkenkplhinta;
    }

    //palauttaa kaikki tilausrivit kannasta
    public static function getTilausrivit() {
        $sql = "SELECT tilausnro, tuotenro, lkm, ostohetkenkplhinta FROM Tilausrivi ORDER BY tilausnro";
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
    
    //palauttaa tilausrivien lukumäärän kannassa tilausnumerolla
    public static function lukumaaraTilausnumerolla($tilausnro) {
        $sql = "SELECT count(*) FROM Tilausrivi WHERE tilausnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
        return $kysely->fetchColumn();
    }

    //palauttaa tietyn määrän tilausrivejä tietystä kohdasta kannasta tilausnumerolla
    public static function getTilausrivitTilausnumerollaTiettyMaaraKohdasta($tilausnro, $maara, $kohta) {
        $sql = "SELECT tilausnro, tuotenro, lkm, ostohetkenkplhinta FROM Tilausrivi where tilausnro = ? ORDER BY tilausnro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro, $maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilausrivi = new Tilausrivi($tulos->tilausnro, $tulos->tuotenro, $tulos->lkm, $tulos->ostohetkenkplhinta);
            $tulokset[] = $tilausrivi;
        }
        return $tulokset;
    }

    //palauttaa tilausrivien yhteenlasketun hinnan tilausnumerolla kannasta
    public static function getTilausrivitHintaYhteensaTilausnumerolla($tilausnro) {
        $sql = "SELECT lkm, ostohetkenkplhinta FROM Tilausrivi where tilausnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
        $yhteensa = 0.0;
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $yhteensa += (double) $tulos->lkm * (double) $tulos->ostohetkenkplhinta;
        }
        return $yhteensa;
    }

    //kertoo onko kannassa tilausrivejä tuotenumerolla
    public static function onTilausrivejaTuotenumerolla($tuotenro) {
        $sql = "SELECT tilausnro, tuotenro, lkm, ostohetkenkplhinta FROM Tilausrivi where tuotenro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuotenro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return false;
        } else {
            return true;
        }
    }
    
    //lisää kantaa uuden tilausrivin tiedoilla
    public static function luoKantaanUusitilausrivi($tilausnro, $tuotenro, $lkm, $ostohetkenkplhinta) {
        $sql = "INSERT INTO Tilausrivi(tilausnro, tuotenro, lkm, ostohetkenkplhinta) VALUES(?,?,?,?) RETURNING tilausnro";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $kysely->execute(array($tilausnro, $tuotenro, $lkm, $ostohetkenkplhinta));
        $tilausnro = $kysely->fetchObject();
        if ($tilausnro == null) {
            return null;
        } else {
            return $tilausnro;
        }
    }

}
