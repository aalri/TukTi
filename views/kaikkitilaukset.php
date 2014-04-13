<h2>Tilaukset</h2>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tilausnro</th>
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
                <td><?php if ($asia->getToimitettu()){ echo Kyllä;}else{echo Ei;} ?></td>
                <td><?php echo $asia->getTilauspaiva(); ?></td>
                <td><?php if ($asia->getMaksettu()){ echo Kyllä;}else{echo Ei;} ?></td>
                <td><?php if ($asia->getMaksettupaiva() !== null){ echo $asia->getMaksettupaiva(); }else{echo "-";}?></td>
                <td><a href="?ikkuna=tarkempiatilaustietoja&tilausnro=<?php echo $asia->getTilausnro() ?>"class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-eye-open"></span> Tarkempia tietoja</td>
                <?php if (!$asia->getToimitettu()){ ?>
                <td><form class="form-horizontal" role="form" method="POST" action=""> 
                        <input type="hidden" name="toimita" value="<?php echo $asia->getTilausnro(); ?>">
                        <button type="submit" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-flash"></span> Kirjaa toimitetuksi</button>
                    </form></td>
                <?php } ?>
                <?php if ($asia->getToimitettu() && !$asia->getMaksettu()){ ?>
                <td><form class="form-horizontal" role="form" method="POST" action=""> 
                        <input type="hidden" name="maksettu" value="<?php echo $asia->getTilausnro(); ?>">
                        <button type="submit" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-euro"></span> Kirjaa maksetuksi</button>
                    </form></td>
                <?php } ?>
            </tr>            
            <?php
        endforeach;
        ?>
</table>
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=kaikkitilaukset&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=kaikkitilaukset&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; ?>