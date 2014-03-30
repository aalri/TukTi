<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/tuoteryhma.php';
$lista = Tuoteryhma::getTuoteryhmat();
naytaNakyma('tuoteryhmalista.php', array('lista' => $lista));