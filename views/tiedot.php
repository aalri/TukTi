<?php 
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
    if (kirjautunutAsiakas()) {
    $asiakas = Asiakastiedot();
    ?>
    <h2>Tietosi</h2>
    <p>
        <?php echo $asiakas->getNimi() ?><br>
        <?php echo $asiakas->getOsoite() ?><br>                   
    </p>
    <a href="#" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-cog"></span> Muokkaa tietoja</a>
<?php } ?>