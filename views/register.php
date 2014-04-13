<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <title>Rekisteröityminen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div class="container"> 
            <h1>Tukkuliike Tukti</h1>
            <div class="col-md-offset-2">
                <h2>Rekisteröidy</h2>
            </div>
            <form class="form-horizontal" name="form" role="form" action="" method="POST">      
                <div class="form-group">
                    
                    <label for="inputName" class="col-md-2 control-label">Tunnus</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="inputName" name="tunnus" value="<?php echo $data->asiakas->getTunnus() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-md-2 control-label">Salasana</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" id="inputName" name="salasana" value="<?php echo $data->asiakas->getSalasana() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-md-2 control-label">Nimi</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="inputName" name="nimi" value="<?php echo $data->asiakas->getNimi() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-md-2 control-label">Osoite</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="inputName" name="osoite" value="<?php echo $data->asiakas->getOsoite() ?>">
                    </div>
                </div>    
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" name="tallennetturekisteroityminen" value="kylla" class="btn btn-default">Rekisteröidy</button>
                    </div>
                </div>
                <?php if (!empty($data->virhe)): ?>
                    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
                <?php endif; ?>
            </form>
        </div>
    </body>
</html>
