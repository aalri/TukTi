<?php

require_once 'nykyinentilausrivi.php';

class Nykyinentilaus {

    private $rivit;

    public function __construct($rivit) {
        $this->rivit = array();
    }

    public function getRivit() {
        return $this->rivit;
    }

    public function setRivit($rivit) {
        $this->rivit = $rivit;
    }

    public function lisaaTilaukseen($tuotenro, $maara, $kappalehinta) {
        $rivi = $this->rivit[(int)$tuotenro];
        if ($rivi !== null) {
            $rivi->setMaara($rivi->getMaara() + $maara);
        } else {
            $nykyinentilausrivi = new Nykyinentilausrivi($tuotenro, $maara, $kappalehinta);
            $this->rivit[$tuotenro] = $nykyinentilausrivi;
        }
    }

    public function poistaTilauksesta($tuotenro) {
        unset($this->rivit[$tuotenro]);
    }
    
    public function hintaYhteensa() {
        $yhteensa = 0;        
        foreach($this->rivit as $rivi){
            $yhteensa += $rivi->getKappalehinta()*$rivi->getMaara();
        }
        return $yhteensa;
    }

}
