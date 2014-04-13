<h2>Navigaatio</h2>
<?php
if (kirjautunutAsiakas()) {
    ?>    
        <div class="panel panel-default">
            <ul class="nav">
                <li class="active"><a href="?ikkuna=etusivu">Etusivu</a></li>
                <li><a href="?ikkuna=tiedot">Tietoni</a></li>
                <li><a href="?ikkuna=laskut">Laskuni</a></li>
                <li><a href="?ikkuna=tilaukset">Aikaisemmat tilaukset</a></li>
                <li><a href="?ikkuna=nykyinentilaus">Nykyinen tilaus</a></li>
                <li><a href="?ikkuna=tilaa">Tilaa</a></li>
                <li><a href="?ikkuna=tuoteryhmat">Tuoteryhmät</a></li>
                <li><a href="poistu.php">Kirjaudu ulos</a></li>
            </ul>
        </div>
    <?php
} else if (kirjautunutYllapitaja()) {
    ?>    
        <div class="panel panel-default">
            <ul class="nav">
                <li class="active"><a href="?ikkuna=etusivu">Etusivu</a></li>
                <li><a href="?ikkuna=varasto">Varasto</a></li>                
                <li><a href="?ikkuna=kaikkilaskut">Laskut</a></li>
                <li><a href="?ikkuna=asiakkaat">Asiakkaat</a></li>
                <li><a href="?ikkuna=tuoteryhmatjatuotteet">Tuoteryhmät ja tuoteet</a></li>
                <li><a href="?ikkuna=kaikkitilaukset">Tilaukset</a></li>
                <li><a href="?ikkuna=automaattisetvarastontaydennykset">Automaattiset varastontäydennykset</a></li>
                <li><a href="poistu.php">Kirjaudu ulos</a></li>
            </ul>
        </div>
    <?php
} else {
    ?>
        <div class="panel panel-default">
            <ul class="nav">
                <li class="active"><a href="?ikkuna=etusivu">Etusivu</a></li>
                <li><a href="?ikkuna=tuoteryhmat">Tuoteryhmät</a></li>
                <li><a href="login.php">Kirjautuminen</a></li>
                <li><a href="register.php">Rekisteröidy</a></li>
            </ul>
        </div>
<?php
}
?>