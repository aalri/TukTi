<?php

class Asiakas {

    private $asiakasnro;
    private $nimi;
    private $osoite;
    private $tunnus;
    private $salasana;
    private $poistettu;
    private $virhe;

    public function __construct($asiakasnro, $nimi, $osoite, $tunnus, $salasana, $poistettu) {
        $this->asiakasnro = $asiakasnro;
        $this->nimi = $nimi;
        $this->osoite = $osoite;
        $this->tunnus = $tunnus;
        $this->salasana = $salasana;
        $this->poistettu = $poistettu;
        $this->virhe = "";
    }

    public function setAsiakasnro($asiakasnro) {
        $this->asiakasnro = $asiakasnro;
    }

    public function getAsiakasnro() {
        return $this->asiakasnro;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function getNimi() {
        return htmlspecialchars($this->nimi);
    }

    public function setOsoite($osoite) {
        $this->osoite = $osoite;
    }

    public function getOsoite() {
        return htmlspecialchars($this->osoite);
    }

    public function setTunnus($tunnus) {
        $this->tunnus = $tunnus;
    }

    public function getTunnus() {
        return htmlspecialchars($this->tunnus);
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function setPoistettu($poistettu) {
        $this->poistettu = $poistettu;
    }

    public function getPoistettu() {
        if ($this->poistettu === 'Kyllä') {
            return true;
        }
        return false;
    }

    public function getVirhe() {
        return $this->virhe;
    }

    public function poista() {
        $this->poistettu = 'Kyllä';
    }

    public function nimiKelpaa() {
        if ($this->nimi === "") {
            $this->virhe .= "Nimi ei saa olla tyhjä. \n";
            return false;
        } else if (strlen($this->nimi) > 60) {
            $this->virhe .= "Nimi on yli 60 merkkiä, mikä on liian pitkä. (määrä: " . strlen($this->nimi) . ") \n";
            return false;
        }
        return true;
    }

    public function osoiteKelpaa() {
        if ($this->osoite === "") {
            $this->virhe .= "Osoite ei saa olla tyhjä. \n";
            return false;
        } else if (strlen($this->osoite) > 80) {
            $this->virhe .= "Osoite on yli 80 merkkiä, mikä on liian pitkä. (määrä: " . strlen($this->osoite) . ") \n";
            return false;
        }
        return true;
    }

    public function salasanaKelpaa() {
        if (strlen($this->salasana) < 6) {
            $this->virhe .= "Salasanan pitää olla vähintään 6 merkkiä. (määrä: " . strlen($this->salasana) . ")\n";
            return false;
        } else if (strlen($this->salasana) > 20) {
            $this->virhe .= "Salasana on yli 20 merkkiä, mikä on liian pitkä. (määrä: " . strlen($this->salasana) . ") \n";
            return false;
        }
        return true;
    }

    //tarkistaa tietojen kelvollisuuden kantaan
    public function onkoUusiKelvollinen() {
        $this->virhe = "";
        $ok = true;
        if (strlen($this->tunnus) < 6) {
            $this->virhe .= "Tunnuksen pitää olla vähintään 6 merkkiä. (määrä: " . strlen($this->tunnus) . ")\n";
            $ok = false;
        } else if (strlen($this->tunnus) > 20) {
            $this->virhe .= "Tunnus on yli 20 merkkiä, mikä on liian pitkä. (määrä: " . strlen($this->tunnus) . ") \n";
            $ok = false;
        } else if (!Asiakas::onkoTunnusVapaa($this->tunnus)) {
            $this->virhe .= "Tunnus on varattu. \n";
            $ok = false;
        }
        if (!$this->salasanaKelpaa()) {
            $ok = false;
        }
        if (!$this->nimiKelpaa()) {
            $ok = false;
        }
        if (!$this->osoiteKelpaa()) {
            $ok = false;
        }
        return $ok;
    }
    
    //tarkistaa päivitysten kelvollisuuden kantaan
    public function onkoKelvollinen() {
        $this->virhe = "";
        $ok = true;
        if (!preg_match('/^\d+$/', $this->asiakasnro)) {
            $this->virhe .= "Asiakasnro vioittunut. \n";
            $ok = false;
        }
        if (!$this->nimiKelpaa()) {
            $ok = false;
        }
        if (!$this->osoiteKelpaa()) {
            $ok = false;
        }
        if (!$this->salasanaKelpaa()) {
            $ok = false;
        }
        return $ok;
    }

    //tarkistaa ettei kanta sisällä Asiakasta tunnuksella
    public static function onkoTunnusVapaa($tunnus) {
        $sql = "SELECT asiakasnro FROM Asiakas where tunnus = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tunnus));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return true;
        } else {
            return false;
        }
    }

    //palauttaa asiakkaan kannasta, jolla on salasana ja tunnus, ja ei ole poistettu
    public static function etsiKayttajaTunnuksilla($tunnus, $salasana) {
        $sql = "SELECT asiakasnro, nimi, osoite, tunnus, salasana, poistettu FROM Asiakas WHERE tunnus = ? AND salasana = ? AND not poistettu = 'Kyllä' LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($tunnus, $salasana));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $asiakas = new Asiakas($tulos->asiakasnro, $tulos->nimi, $tulos->osoite, $tulos->tunnus, $tulos->salasana, $tulos->poistettu);
            return $asiakas;
        }
    }

    //palauttaa asiakkaan kannasta, jolla asiakasnro, ja ei ole poistettu
    public static function etsiNumerolla($asiakasnro) {
        $sql = "SELECT asiakasnro, nimi, osoite, tunnus, salasana, poistettu FROM Asiakas where asiakasnro = ? and not poistettu = 'Kyllä' LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($asiakasnro));
        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $asiakas = new Asiakas($tulos->asiakasnro, $tulos->nimi, $tulos->osoite, $tulos->tunnus, $tulos->salasana, $tulos->poistettu);
            return $asiakas;
        }
    }

    //palauttaa kannasta asiakkaiden lukumäärän
    public static function AsiakkaidenLukumaara() {
        $sql = "SELECT count(*) FROM asiakas";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

    //palauttaa kannasta tietyn määrän asiakkaita tietystä kohdasta
    public static function getAsiakkaatTiettyMaaraKohdasta($maara, $kohta) {
        $sql = "SELECT asiakasnro, nimi, osoite, tunnus, salasana, poistettu FROM Asiakas ORDER BY asiakasnro ASC LIMIT ? OFFSET ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($maara, $kohta));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $asiakas = new Asiakas($tulos->asiakasnro, $tulos->nimi, $tulos->osoite, $tulos->tunnus, $tulos->salasana, $tulos->poistettu);
            $tulokset[] = $asiakas;
        }
        return $tulokset;
    }

    //päivittää kantaan asiakkaan tiedot numerolla
    public function paivitaKantaan() {
        $sql = "UPDATE Asiakas SET nimi = ?, osoite = ?, poistettu = ? WHERE asiakasnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->nimi, $this->osoite, $this->poistettu, $this->asiakasnro));
    }

    //lisää uuden asiakkaan tiedot kantaan ja luo numeron
    public function lisaaKantaan() {
        $sql = "INSERT INTO Asiakas(nimi, osoite, tunnus, salasana, poistettu) VALUES(?, ?, ?, ?, 'Ei') RETURNING asiakasnro";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->nimi, $this->osoite, $this->tunnus, $this->salasana));
        if ($ok) {
            $this->asiakasnro = $kysely->fetchColumn();
        }
        return $ok;
    }

    //poistaa kannasta asiakkaan tiedot numerolla
    public function poistaKannasta() {
        $sql = "DELETE FROM Asiakas WHERE asiakasnro = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($this->getAsiakasnro()));
    }

}
