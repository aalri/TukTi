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

    //lisää tuotenron uuden rivin listaan, jos sitä ei ole tai päivittää valmista
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
    
    //laskee rivien kappalehinnat yhteen
    public function hintaYhteensa() {
        $yhteensa = 0;        
        foreach($this->rivit as $rivi){
            $yhteensa += $rivi->getKappalehinta()*$rivi->getMaara();
        }
        return $yhteensa;
    }
}
