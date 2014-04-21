<?php
   
class Yllapitaja {

    private $id;
    private $tunnus;
    private $salasana;

    public function __construct($id, $tunnus, $salasana) {
        $this->id = $id;
        $this->tunnus = $tunnus;
        $this->salasana = $salasana;
    }
    
    public function setId($id) {
        $this->id= $id;
    }    
    
    public function getId() {
        return $this->id;
    }
    
    public function setTunnus($tunnus) {
        $this->tunnus= $tunnus;
    }    
    
    public function getTunnus() {
        return htmlspecialchars($this->tunnus);
    }
    
    public function setSalasana($salasana) {
        $this->salasana= $salasana;
    }
    
    public function getSalasana() {
        return $this->salasana;
    }

    //palauttaa kannasta kaikki ylläpitäjät
    public static function getYllapitajat() {
        $sql = "SELECT Id, tunnus, salasana FROM Yllapitaja ORDER BY Id ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();        
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $yllapitaja = new Yllapitaja();
            $yllapitaja->setId($tulos->id);
            $yllapitaja->setTunnus($tulos->tunnus);
            $yllapitaja->setSalasana($tulos->salasana);
            $tulokset[] = $yllapitaja;
        }
        return $tulokset;
    }
    
    //palauttaa kanasta ylläpitäjän tunnuksella ja salasanalla
    public static function etsiKayttajaTunnuksilla($tunnus, $salasana) {
    $sql = "SELECT id, tunnus, salasana FROM Yllapitaja WHERE tunnus = ? AND salasana = ? LIMIT 1";
    $kysely = getTietokantayhteys()->prepare($sql);
    $kysely->execute(array($tunnus, $salasana));    
    $tulos = $kysely->fetchObject();
    if ($tulos == null) {
      return null;
    } else {
      $yllapitaja = new Yllapitaja(); 
      $yllapitaja->setId($tulos->id);
      $yllapitaja->setTunnus($tulos->tunnus);
      $yllapitaja->setSalasana($tulos->salasana);    

      return $yllapitaja;
    }
  }
}
