<?php
   
class Tilaus {

    private $tilausnro;
    private $toimitettu;
    private $tilauspaiva;
    private $asiakasnro;
    private $maksettu;
    private $maksettupaiva;

    public function __construct($tilausnro, $toimitettu, $tilauspaiva, $asiakasnro, $maksettu, $maksettupaiva) {
        $this->tilausnro = $tilausnro;        
        $this->toimitettu = $toimitettu;
        $this->tilauspaiva = $tilauspaiva;
        $this->asiakasnro = $asiakasnro;
        $this->maksettu = $maksettu;
        $this->maksettupaiva = $maksettupaiva;
    }  
    public function setTilausnro($tilausnro) {
        $this->tilausnro = $tilausnro;
    }

    public function getTilausnro() {
        return $this->tilausnro;
    }
    
    public function setToimitettu($toimitettu) {
        $this->toimitettu = $toimitettu;
    }

    public function getToimitettu() {
        if ($this->toimitettu === 'Kyllä') {
            return true;
        }
        return false;
    }    

    public function setTilauspaiva($tilauspaiva) {
        $this->tilauspaiva = $tilauspaiva;
    }

    public function getTilauspaiva() {
        return $this->tilauspaiva;
    }
    
    public function setAsiakasnro($asiakasnro) {
        $this->asiakasnro = $asiakasnro;
    }

    public function getAsiakasnro() {
        return $this->asiakasnro;
    }
    
    public function setMaksettu($maksettu) {
        $this->maksettu= $maksettu;
    }    
    
    public function getMaksettu() {
        if ($this->maksettu === 'Kyllä') {
            return true;
        }
        return false;
    }    
    
    public function setMaksettupaiva($maksettupaiva) {
        $this->maksettupaiva= $maksettupaiva;
    }
    
    public function getMaksettupaiva() {
        return $this->maksettupaiva;
    }

    public static function getTilaukset() {
        $sql = "SELECT tilausnro, toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva FROM Tilaus";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilaus = new Tilaus();
            $tilaus->setTilausnro($tulos->tilausnro);
            $tilaus->setToimitettu($tulos->toimitettu);
            $tilaus->setTilauspaiva($tulos->tilauspaiva);
            $tilaus->setAsiakasnro($tulos->asiakasnro);
            $tilaus->setMaksettu($tulos->maksettu);
            $tilaus->setMaksettupaiva($tulos->maksettupaiva);

            $tulokset[] = $tilaus;
        }
        return $tulokset;
    }
    
    public static function getTilauksetAsiakasnumerolla($asiakasnro) {
        $sql = "SELECT tilausnro, toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva FROM Tilaus where asiakasnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilaus = new Tilaus();
            $tilaus->setTilausnro($tulos->tilausnro);
            $tilaus->setToimitettu($tulos->toimitettu);
            $tilaus->setTilauspaiva($tulos->tilauspaiva);
            $tilaus->setAsiakasnro($tulos->asiakasnro);
            $tilaus->setMaksettu($tulos->maksettu);
            $tilaus->setMaksettupaiva($tulos->maksettupaiva);

            $tulokset[] = $tilaus;
        }
        return $tulokset;
    }
    
    public static function getTilausnumeronAsiakas($tilausnro) {        
        $sql = "SELECT asiakasnro FROM Tilaus where tilausnro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));  
        $tulos = $kysely->fetchObject();  
        if ($tulos == null) {
            return null;
        } else {
            return $tulos->asiakasnro;
        }
    }

}
