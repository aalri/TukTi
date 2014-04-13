<?php

class Nykyinentilausrivi {
    private $tuotenro;
    private $maara;
    private $kappalehinta;
    
    public function __construct($tuotenro, $maara, $kappalehinta) {
        $this->tuotenro = $tuotenro;
        $this->maara = $maara;
        $this->kappalehinta = $kappalehinta;
    }
    
    public function setTuotenro($tuotenro) {
        $this->tuotenro = $tuotenro;
    }

    public function getTuotenro() {
        return $this->tuotenro;
    }
    
    public function setMaara($maara) {
        $this->maara = $maara;
    }

    public function getMaara() {
        return $this->maara;
    }
    
    public function setKappalehinta($kappalehinta) {
        $this->kappalehinta = $kappalehinta;
    }

    public function getKappalehinta() {
        return $this->kappalehinta;
    }
}
