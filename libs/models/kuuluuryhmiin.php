<?php
   
class Kuuluuryhmiin {

    private $tuotenro;
    private $tuoteryhmanro;

    public function __construct($tuotenro, $tuoteryhmanro) {
        $this->tuotenro = $tuotenro;
        $this->tuoteryhmanro = $tuoteryhmanro;
    }
    
    public function setTuotenro($tuotenro) {
        $this->tuotenro= $tuotenro;
    }    
    
    public function getTuotenro() {
        return $this->tuotenro;
    }
    
    public function setTuoteryhmanro($tuoteryhmanro) {
        $this->tuoteryhmanro= $tuoteryhmanro;
    }    
    
    public function getTuoteryhmanro() {
        return $this->tuoteryhmanro;
    }

    public static function getTuotteetkuuluuryhmiin() {
        $sql = "SELECT tuotenro, tuoteryhmanro FROM Kuuluuryhmiin";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kuuluuryhmiin = new Kuuluuryhmiin();
            $kuuluuryhmiin->setTuotenro($tulos->tuotenro);
            $kuuluuryhmiin->setTuoteryhmanro($tulos->tuoteryhmanro);

            $tulokset[] = $kuuluuryhmiin;
        }
        return $tulokset;
    }
    
    public static function getTuotteetkuuluuryhmaan($tuoteryhma) {
        $sql = "SELECT tuotenro, tuoteryhmanro FROM Kuuluuryhmiin where tuoteryhmannumero = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array((int)$tuoteryhma));        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $kuuluuryhmiin = new Kuuluuryhmiin();
            $kuuluuryhmiin->setTuotenro($tulos->tuotenro);
            $kuuluuryhmiin->setTuoteryhmanro($tulos->tuoteryhmanro);

            $tulokset[] = $kuuluuryhmiin;
        }
        return $tulokset;
    }

}
