<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
session_start();
if (kirjautunutAsiakas()) {
    $asiakas = $_SESSION['asiakas'];
    ?>
    <h2>Tervetuloa <?php echo $asiakas->getNimi(); ?></h2>
    <p>
        Tarjoamme kaikkea toimistotavaroista kalusteisiin.
    </p>
<?php }else if (kirjautunutYllapitaja()) {
    $yllapitaja = Yllapitajatiedot();
    ?>
    <h2>Tervetuloa takaisin Ylläpitäjä <?php echo $yllapitaja; ?>.</h2>
    <p>
    </p>
<?php } else {
    ?>
    <h2>Tervetuloa!</h2>
    <p>
        Tarjoamme kaikkea toimistotavaroista kalusteisiin.
    </p>
    <?php
}
?>
