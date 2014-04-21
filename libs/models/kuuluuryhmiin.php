<?php

class Kuuluuryhmiin {

    private $tuotenro;
    private $tuoteryhmanro;

    public function __construct($tuotenro, $tuoteryhmanro) {
        $this->tuotenro = $tuotenro;
        $this->tuoteryhmanro = $tuoteryhmanro;
    }

    public function setTuotenro($tuotenro) {
        $this->tuotenro = $tuotenro;
    }

    public function getTuotenro() {
        return $this->tuotenro;
    }

    public function setTuoteryhmanro($tuoteryhmanro) {
        $this->tuoteryhmanro = $tuoteryhmanro;
    }

    public function getTuoteryhmanro() {
        return $this->tuoteryhmanro;
    }

    //palauttaa kannasta kaikki Kuuluuryhmiin
    public static function getTuotteetkuuluuryhmiin() {
        $sql = "SELECT tuotenro, tuoteryhmanro FROM Kuuluuryhmiin ORDER BY 1 ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kuuluuryhmiin = new Kuuluuryhmiin($tulos->tuotenro, $tulos->tuoteryhmanro);
            $tulokset[] = $kuuluuryhmiin;
        }
        return $tulokset;
    }

    //palauttaa kannasta kaikki Kuuluuryhmiin, jotka sisältävät tuoteryhmanumeron
    public static function getTuotteetkuuluuryhmaan($tuoteryhma) {
        $sql = "SELECT tuotenro, tuoteryhmanro FROM Kuuluuryhmiin where tuoteryhmannumero = ? ORDER BY 1 ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array((int) $tuoteryhma));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kuuluuryhmiin = new Kuuluuryhmiin($tulos->tuotenro, $tulos->tuoteryhmanro);
            $tulokset[] = $kuuluuryhmiin;
        }
        return $tulokset;
    }

    //luo kantaan uuden Kuuluuryhmiin tuotenumerolla ja tuoteryhmanumerolla
    public function lisaaKantaan() {
        $sql = "INSERT INTO Kuuluuryhmiin(tuotenro, tuoteryhmanro) VALUES(?, ?) RETURNING tuoteryhmanro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getTuotenro(), $this->getTuoteryhmanro()));
        if ($ok) {
            //Haetaan RETURNING-määreen palauttama id.
            //HUOM! Tämä toimii ainoastaan PostgreSQL-kannalla!
            $this->tuoteryhmanro = $kysely->fetchColumn();
        }
        return $ok;
    }

    //tarkistaa onko tuotenro ja tuoteryhmanro kelvollinen kantaan
    public function onkoKelvollinen() {
        $ok = true;
        if (!preg_match('/^\d+$/', $this->tuotenro)) {
            $ok = false;
        }
        if (!preg_match('/^\d+$/', $this->tuoteryhmanro)) {
            $ok = false;
        }
        return $ok;
    }

    //poistaa kannasta Kuuluuryhmiin tuotenumerolla ja tuoteryhmanumerolla
    public static function poista($tuotenro, $tuoteryhmanro) {
        $sql = "DELETE FROM Kuuluuryhmiin WHERE tuotenro = ? and tuoteryhmanro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuotenro, $tuoteryhmanro));
    }
    
    //poistaa kannasta Kuuluuryhmiin tuotenumerolla
    public static function poistaTuotenro($tuotenro) {
        $sql = "DELETE FROM Kuuluuryhmiin WHERE tuotenro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuotenro));
    }
    
    //poistaa kannasta Kuuluuryhmiin tuoteryhmanumerolla
    public static function poistaTuoteryhmanro($tuoteryhmanro) {
        $sql = "DELETE FROM Kuuluuryhmiin WHERE tuoteryhmanro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro));
    }

}
