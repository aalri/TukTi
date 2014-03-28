<?php

class Nykyinentilausrivi {
    private $tuotenro;
    private $maara;    
    
    public function __construct($tuotenro, $maara) {
        $this->tuotenro = $tuotenro;
        $this->maara = $maara;
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
}
