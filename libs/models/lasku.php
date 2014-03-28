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

    public static function getLaskut() {        
        $sql = "SELECT laskunro, tilausnro, tyyppi, erapaiva FROM Lasku";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = new Lasku();
            $lasku->setLaskunro($tulos->laskunro);
            $lasku->setTilausnro($tulos->tilausnro);
            $lasku->setTyyppi($tulos->tyyppi);
            $lasku->setErapaiva($tulos->erapaiva);

            $tulokset[] = $lasku;
        }
        return $tulokset;
    }
    
    public static function getLaskutAsiakasnumerolla($asiakasnro) {        
        $sql = "SELECT A.laskunro, A.tilausnro, A.tyyppi, A.erapaiva FROM Lasku A, Tilaus B where A.tilausnro = B.tilausnro and B.asiakasnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $lasku = new Lasku();
            $lasku->setLaskunro($tulos->laskunro);
            $lasku->setTilausnro($tulos->tilausnro);
            $lasku->setTyyppi($tulos->tyyppi);
            $lasku->setErapaiva($tulos->erapaiva);

            $tulokset[] = $lasku;
        }
        return $tulokset;
    }

}