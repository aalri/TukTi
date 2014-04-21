<?php

class Lasku {

    private $laskunro;
    private $tilausnro;
    private $tyyppi;
    private $erapaiva;

    public function __construct($laskunro, $tilausnro, $tyyppi, $erapaiva) {
        $this->laskunro = $laskunro;
        $this->tilausnro = $tilausnro;
        $this->tyyppi = $tyyppi;
        $this->erapaiva = $erapaiva;
    }

    public function setLaskunro($laskunro) {
        $this->laskunro = $laskunro;
    }

    public function getLaskunro() {
        return $this->laskunro;
    }

    public function setTilausnro($tilausnro) {
        $this->tilausnro = $tilausnro;
    }

    public function getTilausnro() {
        return $this->tilausnro;
    }

    public function setTyyppi($tyyppi) {
        $this->tyyppi = $tyyppi;
    }

    public function getTyyppi() {
        return $this->tyyppi;
    }

    public function setErapaiva($erapaiva) {
        $this->erapaiva = $erapaiva;
    }

    public function getErapaiva() {
        return $this->erapaiva;
    }

    //palauttaa kannasta kaikki laskut
    public static function getLaskut() {
        $sql = "SELECT laskunro, tilausnro, tyyppi, erapaiva FROM Lasku ORDER BY laskunro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = new Lasku($tulos->laskunro, $tulos->tilausnro, $tulos->tyyppi, $tulos->erapaiva);
            $tulokset[] = $lasku;
        }
        return $tulokset;
    }
    
    //palauttaa kannasta kaikki laskut asiakasnumerolla
    public static function getLaskutAsiakasnumerolla($asiakasnro) {
        $sql = "SELECT A.laskunro, A.tilausnro, A.tyyppi, A.erapaiva FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.asiakasnro = ? ORDER BY laskunro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = new Lasku($tulos->laskunro, $tulos->tilausnro, $tulos->tyyppi, $tulos->erapaiva);
            $tulokset[] = $lasku;
        }
        return $tulokset;
    }

    //palauttaa kannasta laskun laskunumerolla
    public static function getLaskuNumerolla($laskunro) {
        $sql = "SELECT laskunro, tilausnro, tyyppi, erapaiva FROM Lasku where laskunro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($laskunro));
        $tulos = $kysely->fetchObject();
        $lasku = new Lasku($tulos->laskunro, $tulos->tilausnro, $tulos->tyyppi, $tulos->erapaiva);
        return $lasku;
    }

    //kertoo onko laskua, jonka tyyppi on karhu 1 ja maksamaton, asiakasnumerolla
    public static function onMaksamattomiaKarhujaAsiakasnrolla($asiakasnro) {
        $sql = "SELECT A.laskunro, A.tilausnro, A.tyyppi, A.erapaiva FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.asiakasnro = ? and B.maksettu not like 'Kyllä' and A.tyyppi = 'Karhu1' LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return false;
        } else {
            return true;
        }
    }

    //lisaa kantaan uuden laskun tiedoilla sekä ennalta määrätyllä päiväyslisäyksellä eräpäivätietoon
    public function lisaaKantaanMaaratyllaAjalla() {
        $sql = "INSERT INTO Lasku(tilausnro, tyyppi, erapaiva) VALUES(?, ?, ?) RETURNING laskunro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $erapaiva = date("Y-m-d", (strtotime($this->erapaiva) + 86400));
        $ok = $kysely->execute(array($this->getTilausnro(), $this->getTyyppi(), $erapaiva));
        if ($ok) {
            $this->laskunro = $kysely->fetchColumn();
        }
        return $ok;
    }

    //lisaa kantaan uuden laskun tiedoilla sekä nykyisellä tietokannan päiväyksellä
    public function lisaaKantaanNykyisellaAjalla() {
        $sql = "INSERT INTO Lasku(tilausnro, tyyppi, erapaiva) VALUES(?, ?, (current_date + interval '1 day')) RETURNING laskunro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getTilausnro(), $this->getTyyppi()));
        if ($ok) {
            $this->laskunro = $kysely->fetchColumn();
        }
        return $ok;
    }

    //palauttaa laskujen lukumäärän kannasta
    public static function laskujenLukumaara() {
        $sql = "SELECT count(*) FROM lasku";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }
    
    //palauttaa laskujen lukumäärän kannasta asiakasnumerolla
    public static function asiakkaanLaskujenLukumaara($asiakasnro) {
        $sql = "SELECT count(A.*) FROM lasku A, tilaus B WHERE A.tilausnro = B.tilausnro and B.asiakasnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        return $kysely->fetchColumn();
    }

    //palauttaa kannasta laskuja tietyn määrän kohdasta
    public static function getLaskutTiettyMaaraKohdasta($maara, $kohta) {
        $sql = "SELECT laskunro, tilausnro, tyyppi, erapaiva FROM Lasku ORDER BY laskunro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = new Lasku($tulos->laskunro, $tulos->tilausnro, $tulos->tyyppi, $tulos->erapaiva);
            $tulokset[] = $lasku;
        }
        return $tulokset;
    }
    
    //palauttaa kannasta laskuja tietyn määrän kohdasta asiakasnumerolla
    public static function getLaskutAsiakasnumerollaTiettyMaaraKohdasta($asiakasnro, $maara, $kohta) {
        $sql = "SELECT A.laskunro, A.tilausnro, A.tyyppi, A.erapaiva FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.asiakasnro = ? ORDER BY laskunro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro, $maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = new Lasku($tulos->laskunro, $tulos->tilausnro, $tulos->tyyppi, $tulos->erapaiva);

            $tulokset[] = $lasku;
        }
        return $tulokset;
    }

    //palauttaa kannasta lukumäärän maksamattomia laskuja asiakasnumerolla
    public static function maksamattomiaKarhujaMaaraAsiakasnrolla($asiakasnro) {
        $sql = "SELECT count(A.laskunro) FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.asiakasnro = ? and B.maksettu not like 'Kyllä' and A.tyyppi = 'Karhu1'";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        $tulos = $kysely->fetchColumn();
        return $tulos;
    }
    //Hakee kaikki lasku tyypin laskunrot joiden eräpaiva on ylitetty ja joiden tilausnrolla ei ole viela karhu1 tai karhu2 tyypin laskua, ja luo niille karhu1 tyypin laskut.
    public static function paivitaMaksamattomatLaskut() {        
        $sql = "SELECT A.laskunro FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.tilausnro not in (select distinct tilausnro FROM Lasku where tyyppi = 'Karhu1' or tyyppi = 'Karhu2') and B.maksettu not like 'Kyllä' and A.tyyppi = 'Lasku' and A.erapaiva < current_date ORDER BY A.laskunro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = Lasku::getLaskuNumerolla($tulos->laskunro);
            $karhu1 = new Lasku($lasku->getLaskunro(), $lasku->getTilausnro(), "Karhu1", $lasku->getErapaiva());
            $karhu1->lisaaKantaanMaaratyllaAjalla();
        }
    }

    //Hakee kaikki karhu1 tyypin laskunrot joiden eräpaiva on ylitetty ja joiden tilausnrolla ei ole viela karhu2 tyypin laskua, ja luo niille karhu2 tyypin laskut.
    public static function paivitaMaksamattomatKarhut() {        
        $sql = "SELECT A.laskunro FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.tilausnro not in (select distinct tilausnro FROM Lasku where tyyppi = 'Karhu2') and B.maksettu not like 'Kyllä' and A.tyyppi = 'Karhu1' and A.erapaiva < current_date ORDER BY A.laskunro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {            
            $lasku = Lasku::getLaskuNumerolla($tulos->laskunro);
            $karhu2 = new Lasku($lasku->getLaskunro(), $lasku->getTilausnro(), "Karhu2", $lasku->getErapaiva());
            $karhu2->lisaaKantaanMaaratyllaAjalla();
        }
    }
    
    //Hakee lasku tyypin laskunrot jotka kuuluvat asiakkaalle, eräpaiva on ylitetty ja joiden tilausnrolla ei ole viela karhu1 tai karhu2 tyypin laskua ja luo niille karhu1 tyypin laskut.
    public static function paivitaAsiakkaanMaksamattomatLaskut($asiakasnro) {        
        $sql = "SELECT A.laskunro FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.asiakasnro = ? and B.tilausnro not in (select distinct tilausnro FROM Lasku where tyyppi = 'Karhu1' or tyyppi = 'Karhu2') and B.maksettu not like 'Kyllä' and A.tyyppi = 'Lasku' and A.erapaiva < current_date ORDER BY A.laskunro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = Lasku::getLaskuNumerolla($tulos->laskunro);
            $karhu1 = new Lasku($lasku->getLaskunro(), $lasku->getTilausnro(), "Karhu1", $lasku->getErapaiva());
            $karhu1->lisaaKantaanMaaratyllaAjalla();
        }
    }
    //Hakee karhu1 tyypin laskunrot jotka kuuluvat asiakkaalle, eräpaiva on ylitetty ja joiden tilausnrolla ei ole viela karhu2 tyypin laskua, ja luo niille karhu2 tyypin laskut.
    public static function paivitaAsiakkaanMaksamattomatKarhut($asiakasnro) {        
        $sql = "SELECT A.laskunro FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.asiakasnro = ? and B.tilausnro not in (select distinct tilausnro FROM Lasku where tyyppi = 'Karhu2') and B.maksettu not like 'Kyllä' and A.tyyppi = 'Karhu1' and A.erapaiva < current_date ORDER BY A.laskunro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {            
            $lasku = Lasku::getLaskuNumerolla($tulos->laskunro);
            $karhu2 = new Lasku($lasku->getLaskunro(), $lasku->getTilausnro(), "Karhu2", $lasku->getErapaiva());
            $karhu2->lisaaKantaanMaaratyllaAjalla();
        }
    }

}
