<?php if  ($data->sivuja == 0){ ?>
<h2>Aikaisemmat tilaukset</h2>
<p>Sinulla ei ole aikaisempia tilauksia</p>
<?php }else{ ?>
<h2>Aikaisemmat tilaukset</h2>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tilausnro</th>
            <th>Asiakasnro</th>
            <th>Toimitettu</th>
            <th>Tilauspäivä</th>
            <th>Maksettu</th>
            <th>Maksettupäivä</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data->lista as $asia):
            ?>
            <tr>                                    
                <td><?php echo $asia->getTilausnro(); ?></td>
                <td><?php echo $asia->getAsiakasnro(); ?></td>
                <td><?php if ($asia->getToimitettu()){ echo Kyllä;}else{echo Ei;} ?></td>
                <td><?php echo $asia->getTilauspaiva(); ?></td>
                <td><?php if ($asia->getMaksettu()){ echo Kyllä;}else{echo Ei;} ?></td>
                <td><?php if ($asia->getMaksettupaiva() !== null){ echo $asia->getMaksettupaiva(); }else{echo "-";}?></td>
                <td><a href="?ikkuna=tarkempiatilaustietoja&tilausnro=<?php echo $asia->getTilausnro() ?>"class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-eye-open"></span> Tarkempia tietoja</td>                
            </tr>            
            <?php
        endforeach;
        ?>
</table>
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=tilaukset&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=tilaukset&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; }?>