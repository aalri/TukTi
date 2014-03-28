<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <title>Tukti</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">

    </head>

    <body>  
        <div class="container">
            <h1>Tukkuliike Tukti</h1>
            <div class="row">        
                <div class="col-md-3">
                    <?php
                    require 'nav.php';
                    ?>
                </div>
                <div class="col-md-6">                    
                    <?php
                    if ($ikkuna === 'varasto' && kirjautunutYllapitaja()){
                        require 'varasto.php';
                    }else if ($ikkuna === 'kaikkilaskut' && kirjautunutYllapitaja()){
                        require 'kaikkilaskut.php';
                    }else if ($ikkuna === 'asiakkaat' && kirjautunutYllapitaja()){
                        require 'asiakkaat.php';
                    }else if ($ikkuna === 'tuoteryhmatjatuotteet' && kirjautunutYllapitaja()){
                        require 'tuoteryhmatjatuotteet.php';
                    }else if ($ikkuna === 'kaikkitilaukset' && kirjautunutYllapitaja()){
                        require 'kaikkitilaukset.php';
                    }else if ($ikkuna === 'tuoteryhma'){
                        require 'tuoteryhma.php';
                    }else if ($ikkuna === 'etusivu'){
                        require 'etusivu.php';
                    }else if ($ikkuna === 'tiedot' && kirjautunutAsiakas()){
                        require 'tiedot.php';
                    }else if ($ikkuna === 'laskut' && kirjautunutAsiakas()){
                        require 'laskuni.php';
                    }else if ($ikkuna === 'tilaukset' && kirjautunutAsiakas()){
                        require 'tilaukset.php';
                    }else if ($ikkuna === 'tarkempiatilaustietoja' && (kirjautunutAsiakas() || kirjautunutYllapitaja())){
                        require 'tarkempiatilaustietoja.php';
                    }else if ($ikkuna === 'nykyinentilaus' && kirjautunutAsiakas()){
                        require 'nykyinentilaus.php';
                    }else if ($ikkuna === 'tuoteryhmat'){
                        require 'tuoteryhmalista.php';
                    }else{
                    header('Location: index.php?ikkuna=etusivu');
                    }
                    ?>
                </div>                
            </div>
        </div>
    </body>
</html>