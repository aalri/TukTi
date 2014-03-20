<?php
   
class Asiakas {

    private $asiakasnro;
    private $nimi;
    private $osoite;
    private $tunnus;
    private $salasana;
    private $poistettu;

    public function __construct($asiakasnro, $nimi, $osoite, $tunnus, $salasana, $poistettu) {
        $this->asiakasnro = $asiakasnro;
        $this->nimi = $nimi;
        $this->osoite = $osoite;
        $this->tunnus = $tunnus;
        $this->salasana = $salasana;
        $this->poistettu = $poistettu;
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
        return $this->nimi;
    }

    public function setOsoite($osoite) {
        $this->osoite = $osoite;
    }

    public function getOsoite() {
        return $this->osoite;
    }
    
    public function setTunnus($tunnus) {
        $this->tunnus= $tunnus;
    }    
    
    public function getTunnus() {
        return $this->tunnus;
    }
    
    public function setSalasana($salasana) {
        $this->salasana= $salasana;
    }
    
    public function getSalasana() {
        return $this->salasana;
    }

    public function setPoistettu($poistettu) {
        $this->poistettu= $poistettu;
    }
    
    public function getPoistettu() {
        if ($this->poistettu === 'Kyllä') {
            return true;
        }
        return false;
    }    

    public function poista() {
        $this->poistettu = 'Kyllä';
    }

    public static function getAsiakkaat() {
        $sql = "SELECT asiakasnro, nimi, osoite, tunnus, salasana, poistettu FROM Asiakas";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $asiakas = new Asiakas();
            $asiakas->setAsiakasnro($tulos->asiakasnro);
            $asiakas->setNimi($tulos->nimi);
            $asiakas->setOsoite($tulos->osoite);
            $asiakas->setTunnus($tulos->tunnus);
            $asiakas->setSalasana($tulos->salasana);
            $asiakas->setPoistettu($tulos->poistettu);

            $tulokset[] = $asiakas;
        }
        return $tulokset;
    }

}
