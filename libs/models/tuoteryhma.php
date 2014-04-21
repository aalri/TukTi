<?php

class Tuoteryhma {

    private $tuoteryhmanro;
    private $nimi;
    private $virhe;

    public function __construct($tuoteryhmanro, $nimi) {
        $this->tuoteryhmanro = $tuoteryhmanro;
        $this->nimi = $nimi;
        $this->virhe = "";
    }

    public function setTuoteryhmanro($tuoteryhmanro) {
        $this->tuoteryhmanro = $tuoteryhmanro;
    }

    public function getTuoteryhmanro() {
        return $this->tuoteryhmanro;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function getNimi() {
        return htmlspecialchars($this->nimi);
    }

    //palauttaa kannasta kaikki tuoteryhmät
    public static function getTuoteryhmat() {
        $sql = "SELECT tuoteryhmanro, nimi FROM Tuoteryhma ORDER BY tuoteryhmanro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuoteryhma = new Tuoteryhma();
            $tuoteryhma->setTuoteryhmanro($tulos->tuoteryhmanro);
            $tuoteryhma->setNimi($tulos->nimi);

            $tulokset[] = $tuoteryhma;
        }
        return $tulokset;
    }

    //palauttaa kannasta tietyn määrän tuoteryhmiä tietystä kohdasta
    public static function getTuoteryhmatTiettyMaaraKohdasta($maara, $kohta) {
        $sql = "SELECT tuoteryhmanro, nimi FROM Tuoteryhma ORDER BY tuoteryhmanro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tuoteryhma = new Tuoteryhma();
            $tuoteryhma->setTuoteryhmanro($tulos->tuoteryhmanro);
            $tuoteryhma->setNimi($tulos->nimi);

            $tulokset[] = $tuoteryhma;
        }
        return $tulokset;
    }

    //palauttaa kannasta tuoteryhmän tuoteryhmänumerolla
    public static function etsiNumerolla($tuoteryhmanro) {
        $sql = "SELECT tuoteryhmanro, nimi FROM Tuoteryhma where tuoteryhmanro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $tuoteryhma = new Tuoteryhma();
            $tuoteryhma->setTuoteryhmanro($tulos->tuoteryhmanro);
            $tuoteryhma->setNimi($tulos->nimi);

            return $tuoteryhma;
        }
    }

    //luo kantaan uuden tuoteryhmän nimellä, ja luo sille tuoteryhmänumeron
    public function lisaaKantaan() {
        $sql = "INSERT INTO Tuoteryhma(nimi) VALUES(?) RETURNING tuoteryhmanro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->nimi));
        if ($ok) {
            $this->tuoteryhmanro = $kysely->fetchColumn();
        }
        return $ok;
    }

    // tarkistaa onko tuoteryhmän nimi kelvollinen kantaan
    public function onkoKelvollinen() {
        $ok = true;
        $this->virhe = "";
        if ($this->nimi === "") {
            $this->virhe .= "Nimi ei saa olla tyhjä. \n";
            $ok = false;
        } else if (strlen($this->nimi) > 50) {
            $this->virhe .= "Nimi on yli 50 merkkiä, mikä on liian pitkä. (määrä: " . strlen($this->nimi) . ") \n";
            $ok = false;
        }
        return $ok;
    }

    public function getVirhe() {
        return $this->virhe;
    }

    //päivittää kantaan tuoteryhmän nimen tuoteryhmänumerolla
    public function paivitaKantaan() {
        $sql = "UPDATE Tuoteryhma SET nimi = ? WHERE tuoteryhmanro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->nimi, $this->getTuoteryhmanro()));
    }

    //poistaa kannasta tuoteryhmänumerolla
    public static function poista($tuoteryhmanro) {
        $sql = "DELETE FROM Tuoteryhma WHERE tuoteryhmanro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro));
    }

    //palauttaa kannasta tuoteryhmien lukumäärän
    public static function lukumaara() {
        $sql = "SELECT count(*) FROM tuoteryhma";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

}
