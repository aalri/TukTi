<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
        <title>Kirjautuminen</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>

        <div class="container">  
            <h1>Tukkuliike Tukti</h1>
            <div class="col-md-offset-2">
                <h2>Kirjaudu sisään</h2>
            </div>
            <form class="form-horizontal" role="form" method="POST">      
                <div class="form-group">

                    <label for="inputEmail1" class="col-md-2 control-label">Tunnus</label>
                    <div class="col-md-10">
                        <input class="form-control" name="username" placeholder="Tunnus" value="<?php echo $data->kayttaja; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword1" class="col-md-2 control-label">Salasana</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" placeholder="Salasana">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default">Kirjaudu sisään</button>
                    </div>
                </div>
            </form>
            <?php if (!empty($data->virhe)): ?>
                <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
            <?php endif; ?>
        </div>
    </body>
</html>
