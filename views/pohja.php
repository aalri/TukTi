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
            <?php if (!empty($_SESSION['ilmoitus'])) { ?>
                <div class="alert alert-info">
                    <?php echo $_SESSION['ilmoitus']; ?>
                </div>
                <?php 
                unset($_SESSION['ilmoitus']);
            } else if (!empty($_SESSION['varoitus'])) { ?>
                <div class="alert alert-warning">
                    <?php echo $_SESSION['varoitus']; ?>
                </div>
                <?php 
                unset($_SESSION['varoitus']);
            }else{
                ?>
                <div style="height: 71" >
                </div>
                <?php
            }
            ?>
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