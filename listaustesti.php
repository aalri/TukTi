<?php
require_once 'libs/yhteydenotto.php';
require_once 'libs/models/asiakas.php';
$lista = Asiakas::getAsiakkaat();
?><!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <title>Asiakkaat</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body> 
        <div class="container">
            <h1>Tukkuliike Tukti</h1>
            <div class="row">
                <div class="col-md-3">  
                    <script src = "html-demo/nav(yllapitaja).js"></script>
                    <noscript>Sorry, your browser does not support JavaScript!</noscript>
                </div>
                <div class="col-md-6">         
                    <h2>Asiakkaat</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asiakkaan nimi</th>
                                <th>Osoite</th>
                                <th>Tunnus</th>
                                <th>Salasana</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($lista as $asia):
                                if ($asia->getPoistettu()) {
                                    ?>
                                    <tr>                                    
                                        <td class="text-muted"><?php echo $asia->getAsiakasnro(); ?></td>
                                        <td class="text-muted"><?php echo $asia->getNimi(); ?></td>
                                        <td class="text-muted"><?php echo $asia->getOsoite() ?></td>
                                        <td class="text-muted"><?php echo $asia->getTunnus(); ?></td>
                                        <td class="text-muted"><?php echo $asia->getSalasana(); ?></td>
                                        <td class="text-muted">Poistettu</td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>                                    
                                        <td><?php echo $asia->getAsiakasnro(); ?></td>
                                        <td><?php echo $asia->getNimi(); ?></td>
                                        <td><?php echo $asia->getOsoite() ?></td>
                                        <td><?php echo $asia->getTunnus(); ?></td>
                                        <td><?php echo $asia->getSalasana(); ?></td>
                                        <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> Poista Asiakas</button></td>
                                    </tr>
                                    <?php
                                }
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>