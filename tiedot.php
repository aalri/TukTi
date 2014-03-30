<?php
    if (kirjautunutAsiakas()) {
    $asiakas = Asiakastiedot();
    naytaNakyma('tiedot.php', array('asiakas' => $asiakas));
    }
