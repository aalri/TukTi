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
        $this->maksettu = $maksettu;
    }

    public function getMaksettu() {
        if ($this->maksettu === "Kyllä") {
            return true;
        }
        return false;
    }

    public function setMaksettupaiva($maksettupaiva) {
        $this->maksettupaiva = $maksettupaiva;
    }

    public function getMaksettupaiva() {
        return $this->maksettupaiva;
    }

    //palauttaa kannasta kaikki tilaukset
    public static function getTilaukset() {
        $sql = "SELECT tilausnro, toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva FROM Tilaus ORDER BY tilausnro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilaus = new Tilaus($tulos->tilausnro, $tulos->toimitettu, $tulos->tilauspaiva, $tulos->asiakasnro, $tulos->maksettu, $tulos->maksettupaiva);
            $tulokset[] = $tilaus;
        }
        return $tulokset;
    }

    //palauttaa kannasta kaikki tilaukset asiakasnumerolla
    public static function getTilauksetAsiakasnumerolla($asiakasnro) {
        $sql = "SELECT tilausnro, toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva FROM Tilaus where asiakasnro = ? ORDER BY tilausnro ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilaus = new Tilaus($tulos->tilausnro, $tulos->toimitettu, $tulos->tilauspaiva, $tulos->asiakasnro, $tulos->maksettu, $tulos->maksettupaiva);
            $tulokset[] = $tilaus;
        }
        return $tulokset;
    }
    
    //palauttaa kannasta tietyn määrän tilauksia kohdasta asiakasnumerolla
    public static function getTilauksetAsiakasnumerollaTiettyMaaraKohdasta($asiakasnro, $maara, $kohta) {
        $sql = "SELECT tilausnro, toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva FROM Tilaus where asiakasnro = ? ORDER BY tilausnro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro, $maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilaus = new Tilaus($tulos->tilausnro, $tulos->toimitettu, $tulos->tilauspaiva, $tulos->asiakasnro, $tulos->maksettu, $tulos->maksettupaiva);
            $tulokset[] = $tilaus;
        }
        return $tulokset;
    }
    
    //palauttaa kannasta tietyn määrän tilauksia kohdasta
    public static function getTilauksetTiettyMaaraKohdasta($maara, $kohta) {
        $sql = "SELECT tilausnro, toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva FROM Tilaus ORDER BY tilausnro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tilaus = new Tilaus($tulos->tilausnro, $tulos->toimitettu, $tulos->tilauspaiva, $tulos->asiakasnro, $tulos->maksettu, $tulos->maksettupaiva);
            $tulokset[] = $tilaus;
        }
        return $tulokset;
    }

    //palauttaa kannasta tilauksen asiakasnumeron tilausnumerolla
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

    //lisää kantaan uuden tilauksen asiakasnumerolla, ja palauttaa sen
    public static function luoKantaanUusitilaus($asiakasnro) {
        $sql = "INSERT INTO Tilaus(toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva) VALUES('Ei', current_date, ?, 'Ei', null) RETURNING Tilausnro";
        $kysely = getTietokantayhteys()->prepare($sql);        
        $kysely->execute(array($asiakasnro));
        $tilausnro = $kysely->fetchColumn();
        if ($tilausnro == null) {
            return null;
        } else {
            $sql = "SELECT tilausnro, toimitettu, tilauspaiva, asiakasnro, maksettu, maksettupaiva FROM Tilaus where tilausnro = ? LIMIT 1";
            $kysely = getTietokantayhteys()->prepare($sql);            
            $kysely->execute(array($tilausnro)); 
            $tulos2 = $kysely->fetchObject();
            $tilaus = new Tilaus($tulos2->tilausnro, $tulos2->toimitettu, $tulos2->tilauspaiva, $tulos2->asiakasnro, $tulos2->maksettu, $tulos2->maksettupaiva);
            return $tilaus;
        }
    }
    
    //kertoo onko tilausta kannassa tilausnumerolla
    public static function onTilausNumerolla($tilausnro) {
        $sql = "SELECT tilausnro FROM tilaus WHERE tilausnro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
        if ($kysely->fetchObject() == null) {
            return false;
        } else {
            return true;
        }
    }
    
    //palauttaa kannasta tilausten lukumäärän asiakasnumerolla
    public static function asiakkaanTilaustenLukumaara($asiakasnro) {
        $sql = "SELECT count(*) FROM tilaus WHERE asiakasnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        return $kysely->fetchColumn();
    }
    
    //palauttaa kannasta tilausten lukumäärän
    public static function tilaustenLukumaara() {
        $sql = "SELECT count(*) FROM tilaus";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }
    
    //päivittää kantaan tilauksen toimitetuksi tilausnumerolla
    public static function paivitaToimitetuksiKantaan($tilausnro) {
        $sql = "UPDATE Tilaus SET toimitettu = 'Kyllä' where tilausnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
    }
    
    //päivittää kantaan tilauksen maksetuksi tilausnumerolla
    public static function paivitaMaksetuksiKantaan($tilausnro) {
        $sql = "UPDATE Tilaus SET maksettu = 'Kyllä', maksettupaiva = current_date where tilausnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
    }
    
    //kertoo onko tilausta toimitettu kannassa tilausnumerolla
    public static function onToimitettu($tilausnro) {
        $sql = "SELECT toimitettu from Tilaus where tilausnro = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tilausnro));
        $tulos = $kysely->fetchObject();
        if ($tulos->toimitettu == "Kyllä") {
            return true;
        } else {
            return false;
        }
    }
    
    //kertoo onko toimitettuja tilauksia kannassa asiakasnumerolla
    public static function onToimitettujaTilauksiaAsiakasnrolla($asiakasnro) {
        $sql = "SELECT toimitettu from Tilaus where asiakasnro = ? and toimitettu = 'Kyllä' LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        $tulos = $kysely->fetchObject();
        if ($tulos->toimitettu == "Kyllä") {
            return true;
        } else {
            return false;
        }
    }

}
