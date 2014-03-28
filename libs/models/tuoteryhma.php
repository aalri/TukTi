<?php

class Tuoteryhma {

    private $tuoteryhmanro;
    private $nimi;

    public function __construct($tuoteryhmanro, $nimi) {
        $this->tuoteryhmanro = $tuoteryhmanro;
        $this->nimi = $nimi;
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
        return $this->nimi;
    }

    public static function getTuoteryhmat() {
        $sql = "SELECT tuoteryhmanro, nimi FROM Tuoteryhma";
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

    public static function etsiNumerolla($tuoteryhmanro) {
        $sql = "SELECT tuoteryhmanro, nimi FROM Tuoteryhma where tuoteryhmanro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tuoteryhmanro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $tuoteryhma = new Tuoteryhma();
            $tuoteryhma->setTuoteryhmanro($tulos->asiakasnro);
            $tuoteryhma->setNimi($tulos->nimi);

            return $tuoteryhma;
        }
    }

}
