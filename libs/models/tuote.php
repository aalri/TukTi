<?php

class Tuote {

    private $tuotenro;
    private $nimi;
    private $hinta;
    private $jaljella;
    private $lisayskynnys;
    private $lisaysmaara;
    private $poistettu;
    private $kuuluuryhmaan;
    private $virhe;

    public function __construct($tuotenro, $nimi, $hinta, $jaljella, $lisayskynnys, $lisaysmaara, $poistettu) {
        $this->tuotenro = $tuotenro;
        $this->nimi = $nimi;
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

    //palauttaa kaikki tuotteet kannasta, joita ei ole asetettu poistetuiksi
    public static function getTuotteet() {
        $sql = "SELECT * FROM Tuote WHERE not poistettu = 'Kyllä' ORDER BY tuotenro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote($tulos->tuotenro, $tulos->nimi, $tulos->hinta, $tulos->jaljella, $tulos->lisayskynnys, $tulos->lisaysmaara, $tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }
    
    //palauttaa kaikki tuotteet kannasta,jotka kuuluvat tuoteryhmaan, ja joita ei ole asetettu poistetuiksi
    public static function getTuoteryhmaanKuuluvatTuotteet($tuoteryhmanro) {
        $sql = "SELECT A.* FROM Tuote A, Kuuluuryhmiin B where A.tuotenro = B.tuotenro and B.tuoteryhmanro = ? and not poistettu = 'Kyllä' ORDER BY tuotenro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array((int) $tuoteryhmanro));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote($tulos->tuotenro, $tulos->nimi, $tulos->hinta, $tulos->jaljella, $tulos->lisayskynnys, $tulos->lisaysmaara, $tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }

    //palauttaa tuotteen nimen kannasta tuotenumerolla
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

    //palauttaa tietyn määrän tuotteita tietystä kohdasta kannasta, joita ei ole asetettu poistetuiksi. Myös lisää tiedon, kuuluuko se tuoteryhmään tuoteryhmänumerolla.
    public static function getTuotteetJaKuuluvuudetTuoteryhmaanTiettyMaaraKohdasta($tuoteryhmanro, $maara, $kohta) {
        $sql = "SELECT * FROM Tuote WHERE not poistettu = 'Kyllä' ORDER BY tuotenro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $kysely->execute(array($maara, $kohta));     
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote($tulos->tuotenro, $tulos->nimi, $tulos->hinta, $tulos->jaljella, $tulos->lisayskynnys, $tulos->lisaysmaara, $tulos->poistettu);
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

    //palauttaa tuotteen kannasta tuotenumerolla
    public static function etsiNumerolla($tuotenro) {
        $sql = "SELECT * FROM Tuote where tuotenro = ? and not poistettu = 'Kyllä' LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuotenro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $tuote = new Tuote($tulos->tuotenro, $tulos->nimi, $tulos->hinta, $tulos->jaljella, $tulos->lisayskynnys, $tulos->lisaysmaara, $tulos->poistettu);
            return $tuote;
        }
    }

    //kertoo onko tuotteen tiedot kelvollisia kantaan
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
        if (!preg_match('/^\d+$/', $this->jaljella)) {
            $this->virhe .= "Määrän pitää olla positiivinen kokonaisluku. \n";
            $ok = false;
        }
        if (!is_numeric($this->hinta)) {
            $this->virhe .= "Hinnan pitää olla numeerinen ja positiivinen, ja pistettä pitää käyttää desimaalieroittimena esim. 12.30 \n";
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

    //päivittää tuotteen tiedot kantaan
    public function paivitaKantaan() {
        $sql = "UPDATE Tuote SET nimi = ?, hinta = ?, jaljella = ?, lisayskynnys = ?, lisaysmaara = ? , poistettu = ? WHERE tuotenro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->nimi, $this->getHinta(), $this->getJaljella(), $this->getLisayskynnys(), $this->getLisaysmaara(), $this->getPoistettu(), $this->getTuotenro()));
    }

    //lisää tuotteen tiedot kantaan ja luo uuden tuotenron
    public function lisaaKantaan() {
        $sql = "INSERT INTO Tuote(nimi, hinta, jaljella, lisayskynnys, lisaysmaara, poistettu) VALUES(?, ?, ?, ?, ?, ?) RETURNING tuotenro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->nimi, $this->getHinta(), $this->getJaljella(), $this->getLisayskynnys(), $this->getLisaysmaara(), $this->getPoistettu()));
        if ($ok) {
            $this->tuotenro = $kysely->fetchColumn();
        }
        return $ok;
    }

    //poistaa tuotteen tiedot kannasta tuotenumerolla
    public function poistaKannasta() {
        $sql = "DELETE FROM Tuote WHERE tuotenro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getTuotenro()));
    }

    //palauttaa tietyn määrän tuotteita tietystä kohdasta kannasta, joiden tuotenimi vastaa hakua
    public static function getTuotteetTiettyMaaraKohdastaHaulla($maara, $kohta, $haku) {        
        $sql = "SELECT * FROM Tuote WHERE not poistettu = 'Kyllä' and lower(nimi) like lower(?) ORDER BY tuotenro LIMIT ? OFFSET ?";
        $haku = '%'.$haku.'%';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haku, $maara, $kohta)); 
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote($tulos->tuotenro, $tulos->nimi, $tulos->hinta, $tulos->jaljella, $tulos->lisayskynnys, $tulos->lisaysmaara, $tulos->poistettu);
            $tulokset[] = $tuote;
        }
        return $tulokset;
    }
    
    //palauttaa tietyn määrän tuotteita tietystä kohdasta kannasta tuoteryhmänumerolla
    public static function getTuoteryhmanTuotteetTiettyMaaraKohdasta($tuoteryhmanro, $maara, $kohta) {        
        $sql = "SELECT A.* FROM Tuote A, Kuuluuryhmiin B WHERE not poistettu = 'Kyllä' and A.tuotenro = B.tuotenro and B.tuoteryhmanro = ? ORDER BY tuotenro LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro, $maara, $kohta)); 
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote($tulos->tuotenro, $tulos->nimi, $tulos->hinta, $tulos->jaljella, $tulos->lisayskynnys, $tulos->lisaysmaara, $tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }
    
    //palauttaa kannasta kaikkien poistamattomien tuotteiden lukumäärän
    public static function lukumaara() {
        $sql = "SELECT count(*) FROM tuote WHERE not poistettu = 'Kyllä'";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

    //palauttaa kannasta kaikkien poistamattomien tuotteiden lukumäärän, joiden tuotenimi vastaa hakua
    public static function lukumaaraHaulla($haku) {
        $sql = "SELECT count(*) FROM tuote WHERE not poistettu = 'Kyllä' and lower(nimi) like lower(?)";
        $haku = '%'.$haku.'%';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($haku));
        return $kysely->fetchColumn();
    }
    
    //palauttaa kannasta kaikkien poistamattomien tuotteiden lukumäärän tuoteryhmänumerolla
    public static function tuoteryhmanLukumaara($tuoteryhmanro) {
        $sql = "SELECT count(A.*) FROM tuote A, kuuluuryhmiin B WHERE not poistettu = 'Kyllä' and A.tuotenro = B.tuotenro and B.tuoteryhmanro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro));
        return $kysely->fetchColumn();
    }
    
    //tarkistaa kannasta onko kaikkien tilausrivien tuotteiden varastomaarat suuremmat kuin tilausrivien tilausmaarat tilausnumerolla
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
    
    //paivittaa tuotteiden varastomäärät kannasta vähentämällä niistä tilausrivien määrät tilausnumerolla
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
    
    //palauttaa kannasta lukumäärän tuotteista joiden varastomäärä alittaa kynnyksen
    public static function lukumaaraAliKynnyksen() {
        $sql = "SELECT count(*) FROM tuote WHERE not poistettu = 'Kyllä' and jaljella < lisayskynnys";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $kysely->execute();
        return $kysely->fetchColumn();
    }
    
    //palauttaa kannasta tietyt tuotteet tietystä kohdasta joiden varastomäärä alittaa kynnyksen
    public static function getTuotteetMaaraAliKynnyksenTiettyMaaraKohdasta($maara, $kohta) {
        $sql = "SELECT * FROM Tuote WHERE not poistettu = 'Kyllä' and jaljella < lisayskynnys ORDER BY tuotenro LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuote = new Tuote($tulos->tuotenro, $tulos->nimi, $tulos->hinta, $tulos->jaljella, $tulos->lisayskynnys, $tulos->lisaysmaara, $tulos->poistettu);

            $tulokset[] = $tuote;
        }
        return $tulokset;
    }
}
