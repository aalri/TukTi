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
                    require $sivu;
                    ?>
                </div>                
            </div>
        </div>
    </body>
</html>