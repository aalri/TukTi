<h2>Tilauksen numero <?php echo $data->tilausnro ?> tiedot</h2>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tuote</th>
            <th>Lkm</th>
            <th>Yhteensä</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data->lista as $asia):
            ?>
            <tr>                                    
                <td><?php echo Tuote::getTuoteNimiNumerolla($asia->getTuotenro()); ?></td>
                <td><?php echo $asia->getLkm(); ?></td>
                <td><?php echo money_format('%.2n', $asia->getYhteensa()); ?> e</td>
            </tr>            
            <?php
        endforeach;
        ?>    
</table>
<?php if ($data->sivu > 1): ?>
    <a href="?ikkuna=tarkempiatilaustietoja&tilausnro=<?php echo $data->tilausnro; ?>&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
    <a href="?ikkuna=tarkempiatilaustietoja&tilausnro=<?php echo $data->tilausnro; ?>&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; ?>
<br></br>
<form class="form-vertical" role="form" method="POST" action=""> 
    <button type="submit" class="btn btn-default" name="palaa" value="1">Palaa</button>
</form> 