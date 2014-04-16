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
    private $kuuluuryhmaan;
    private $virhe;

    public function __construct($tuotenro, $nimi, $tiedot, $hinta, $jaljella, $lisayskynnys, $lisaysmaara, $poistettu) {
        $this->tuotenro = $tuotenro;
        $this->nimi = $nimi;
        $this->tiedot = $tiedot;
        $this->hinta = $hinta;
        $this->jaljella = $jaljella;
        $this->lisayskynnys = $lisayskynnys;
        $this->lisaysmaara = $lisaysmaara;
        $this->poistettu = $poistettu;
        $this->kuuluuryhmaan = false;
        $this->virhe = "";
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
        return htmlspecialchars($this->nimi);
    }

    public function setTiedot($tiedot) {
        $this->tiedot = $tiedot;
    }

    public function getTiedot() {
        return htmlspecialchars($this->tiedot);
    }

    public function setHinta($hinta) {
        $this->hinta = $hinta;
    }

    public function getHinta() {
        return $this->hinta;
    }

    public function setJaljella($jaljella) {
        $this->jaljella = $jaljella;
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
        $this->poistettu = $poistettu;
    }
    
    public function getPoistettu() {
        return $this->poistettu;
    }
    
    public function onPoistettu() {
        if ($this->poistettu === "Kyllä") {
            return true;
        }
        return false;
    }

    public function setKuuluuRyhmaan($kuuluuryhmaan) {
        $this->kuuluuryhmaan = $kuuluuryhmaan;
    }

    public function getKuuluuRyhmaan() {
        return $this->kuuluuryhmaan;
    }

    public function poista() {
        $this->poistettu = "Kyllä";
    }

    public static function getTuotteet() {
        $sql = "SELECT tuotenro, nimi, tiedot, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu FROM Tuote WHERE not poistettu = 'Kyllä' ORDER BY tuotenro ASC";
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
            $tuote->setLisayskynnys($tulos->lisayskynnys);
            $tuote->setLisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }

    public static function getTuoteryhmaanKuuluvatTuotteet($tuoteryhmanro) {
        $sql = "SELECT A.tuotenro, A.nimi, A.tiedot, A.hinta, A.jaljella, A.lisayskynnys, A.lisaysmaara, A.poistettu FROM Tuote A, Kuuluuryhmiin B where A.tuotenro = B.tuotenro and B.tuoteryhmanro = ? and not poistettu = 'Kyllä' ORDER BY tuotenro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array((int) $tuoteryhmanro));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote();
            $tuote->setTuotenro($tulos->tuotenro);
            $tuote->setNimi($tulos->nimi);
            $tuote->setTiedot($tulos->tiedot);
            $tuote->setHinta($tulos->hinta);
            $tuote->setJaljella($tulos->jaljella);
            $tuote->setLisayskynnys($tulos->lisayskynnys);
            $tuote->setLisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }

    public static function getTuoteNimiNumerolla($tuotenro) {
        $sql = "SELECT nimi FROM Tuote where tuotenro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array((int) $tuotenro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            return $tulos->nimi;
        }
    }

    public static function getTuotteetJaKuuluvuudetTuoteryhmaan($tuoteryhmanro) {
        $sql = "SELECT tuotenro, nimi, tiedot, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu FROM Tuote WHERE not poistettu = 'Kyllä' ORDER BY tuotenro ASC";
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
            $tuote->setLisayskynnys($tulos->lisayskynnys);
            $tuote->setLisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);
            $sql = "SELECT tuotenro, tuoteryhmanro FROM Kuuluuryhmiin where tuotenro = ? and tuoteryhmanro = ? LIMIT 1";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($tulos->tuotenro, $tuoteryhmanro));
            $tulos = $kysely->fetchObject();
            if (!empty($tulos)) {
                $tuote->setKuuluuRyhmaan(true);
            }
            $tulokset[] = $tuote;
        }
        return $tulokset;
    }

    public static function etsiNumerolla($tuotenro) {
        $sql = "SELECT tuotenro, nimi, tiedot, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu FROM Tuote where tuotenro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuotenro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $tuote = new Tuote();
            $tuote->setTuotenro($tulos->tuotenro);
            $tuote->setNimi($tulos->nimi);
            $tuote->setTiedot($tulos->tiedot);
            $tuote->setHinta($tulos->hinta);
            $tuote->setJaljella($tulos->jaljella);
            $tuote->setLisayskynnys($tulos->lisayskynnys);
            $tuote->setLisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);
            return $tuote;
        }
    }

    public function onkoKelvollinen() {
        $this->virhe = "";
        $ok = true;
        if (!preg_match('/^\d+$/', $this->tuotenro)) {
            $this->virhe .= "Tuotenro vioittunut. \n";
            $ok = false;
        }        
        if ($this->nimi === "") {
            $this->virhe .= "Nimi ei saa olla tyhjä. \n";
            $ok = false;
        }else if (strlen($this->nimi) > 50){
            $this->virhe .= "Nimi on yli 50 merkkiä, mikä on liian pitkä. (määrä: ". strlen($this->nimi)  .") \n";
            $ok = false;
        }
        if (strlen($this->tiedot) > 600){
            $this->virhe .= "Tiedot on yli 600 merkkiä, mikä on liian pitkä. (määrä: ". strlen($this->tiedot)  .") \n";
            $ok = false;
        }
        if (!preg_match('/^\d+$/', $this->jaljella)) {
            $this->virhe .= "Määrän pitää olla positiivinen kokonaisluku. \n";
            $ok = false;
        }
        if (!is_numeric($this->hinta)) {
            $this->virhe .= "Hinnan pitää olla numeerinen ja positiivinen. \n";
            $ok = false;
        }
        if (!preg_match('/^\d+$/', $this->lisayskynnys)) {
            $this->virhe .= "Lisayskynnyksen pitää olla positiivinen kokonaisluku. \n";
            $ok = false;
        }
        if (!preg_match('/^\d+$/', $this->lisaysmaara)) {
            $this->virhe .= "Lisäysmäärän pitää olla positiivinen kokonaisluku. \n";
            $ok = false;
        }
        return $ok;
    }
    
    public function getVirhe(){
        return $this->virhe;
    }

    public function paivitaKantaan() {
        $sql = "UPDATE Tuote SET nimi = ?, tiedot = ?, hinta = ?, jaljella = ?, lisayskynnys = ?, lisaysmaara = ? , poistettu = ? WHERE tuotenro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->nimi, $this->tiedot, $this->getHinta(), $this->getJaljella(), $this->getLisayskynnys(), $this->getLisaysmaara(), $this->getPoistettu(), $this->getTuotenro()));
    }

    public function lisaaKantaan() {
        $sql = "INSERT INTO Tuote(nimi, tiedot, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu) VALUES(?, ?, ?, ?, ?, ?, ?) RETURNING tuotenro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->nimi, $this->tiedot, $this->getHinta(), $this->getJaljella(), $this->getLisayskynnys(), $this->getLisaysmaara(), $this->getPoistettu()));
        if ($ok) {
            $this->tuotenro = $kysely->fetchColumn();
        }
        return $ok;
    }

    public function poistaKannasta() {
        $sql = "DELETE FROM Tuote WHERE tuotenro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getTuotenro()));
    }

    public static function getTuotteetTiettyMaaraKohdasta($maara, $kohta) {        
        $sql = "SELECT tuotenro, nimi, tiedot, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu FROM Tuote WHERE not poistettu = 'Kyllä' ORDER BY tuotenro LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($maara, $kohta)); 
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote();
            $tuote->setTuotenro($tulos->tuotenro);
            $tuote->setNimi($tulos->nimi);
            $tuote->setTiedot($tulos->tiedot);
            $tuote->setHinta($tulos->hinta);
            $tuote->setJaljella($tulos->jaljella);
            $tuote->setLisayskynnys($tulos->lisayskynnys);
            $tuote->setLisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }
    
    public static function getTuoteryhmanTuotteetTiettyMaaraKohdasta($tuoteryhmanro, $maara, $kohta) {        
        $sql = "SELECT A.tuotenro, A.nimi, A.tiedot, A.hinta, A.jaljella, A.lisayskynnys, A.lisaysmaara, A.poistettu FROM Tuote A, Kuuluuryhmiin B WHERE not poistettu = 'Kyllä' and A.tuotenro = B.tuotenro and B.tuoteryhmanro = ? ORDER BY tuotenro LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro, $maara, $kohta)); 
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote();
            $tuote->setTuotenro($tulos->tuotenro);
            $tuote->setNimi($tulos->nimi);
            $tuote->setTiedot($tulos->tiedot);
            $tuote->setHinta($tulos->hinta);
            $tuote->setJaljella($tulos->jaljella);
            $tuote->setLisayskynnys($tulos->lisayskynnys);
            $tuote->setLisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }

    public static function lukumaara() {
        $sql = "SELECT count(*) FROM tuote WHERE not poistettu = 'Kyllä'";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }
    public static function tuoteryhmanLukumaara($tuoteryhmanro) {
        $sql = "SELECT count(A.*) FROM tuote A, kuuluuryhmiin B WHERE not poistettu = 'Kyllä' and A.tuotenro = B.tuotenro and B.tuoteryhmanro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro));
        return $kysely->fetchColumn();
    }
    
    public static function loytyyTuoteMaarat($tilausnro) {
        $sql = "SELECT A.tuotenro, A.lkm, B.jaljella FROM tilausrivi A, Tuote B where A.tilausnro = ? and A.tuotenro = B.tuotenro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            if ($tulos->lkm > $tulos->jaljella){
                return false;
            }
        }
        return true;
    }
    
    public static function vahennaTuoteMaarat($tilausnro) {
        $sql = "SELECT tuotenro, lkm FROM tilausrivi where tilausnro = ?;";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $sql = "SELECT jaljella FROM Tuote where tuotenro = ? LIMIT 1";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($tulos->tuotenro));
            $jaljella = $kysely->fetchObject();
            $sql = "UPDATE Tuote SET jaljella = ? where tuotenro = ?;";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array(($jaljella->jaljella - $tulos->lkm), $tulos->tuotenro));
        }
    }
    
    public static function getTuotteetMaaraAliKynnyksenTiettyMaaraKohdasta($maara, $kohta) {
        $sql = "SELECT tuotenro, nimi, tiedot, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu FROM Tuote WHERE not poistettu = 'Kyllä' and jaljella < lisayskynnys ORDER BY tuotenro LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote();
            $tuote->setTuotenro($tulos->tuotenro);
            $tuote->setNimi($tulos->nimi);
            $tuote->setTiedot($tulos->tiedot);
            $tuote->setHinta($tulos->hinta);
            $tuote->setJaljella($tulos->jaljella);
            $tuote->setLisayskynnys($tulos->lisayskynnys);
            $tuote->setLisaysmaara($tulos->lisaysmaara);
            $tuote->setPoistettu($tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }

}
