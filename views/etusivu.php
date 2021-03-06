<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
if ($data->asiakas !== null) {
    ?>
    <h2>Tervetuloa <?php echo $data->asiakas->getNimi(); ?></h2>
    <p>
        Tarjoamme kaikkea toimistotavaroista kalusteisiin.
    </p>
    <?php if ($data->karhut > 0) { ?>
        <div class="alert alert-danger">
            Sinulla on <?php echo $data->karhut; ?> maksamatonta tilausta karhulla!
        </div>
    <?php } ?>
    <?php } else if ($data->yllapitaja !== null) {
    ?>
    <h2>Tervetuloa takaisin Ylläpitäjä <?php echo $data->yllapitaja; ?>.</h2>
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
