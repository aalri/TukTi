<h2>Automaattiset varastontäydennykset</h2>
<?php if  ($data->sivuja == 0){ ?>
<p> Automaattiset varastontäydennykset on tyhjä. </p>
<p>(Täydennyksiä muodostuu jonkin tuotteen varastomäärän alittaessa lisäyskynnyksen.)</p>
<?php }else{ ?>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tuotenro</th>
            <th>Nimi</th>
            <th>Määrä</th>
            <th>Tilauskynnys</th>
            <th>Tilausmäärä</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data->lista as $asia):
            ?>
            <tr>                                    
                <td><?php echo $asia->getTuotenro(); ?></td>
                <td><?php echo $asia->getNimi(); ?></td>
                <td><?php echo $asia->getJaljella(); ?></td>
                <td><?php echo $asia->getLisayskynnys(); ?></td>
                <td><?php echo $asia->getLisaysmaara(); ?></td>
                <td><form class="form-horizontal" role="form" method="POST" action=""> 
                        <input type="hidden" name="kirjaatoimitus" value="<?php echo $asia->getTuotenro(); ?>">
                        <button type="submit" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-flash"></span> Kirjaa saapuneeksi</button>
                </form></td>
            </tr>            
            <?php
        endforeach;
        ?>
</table>
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=automaattisetvarastontaydennykset&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=automaattisetvarastontaydennykset&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; } ?>

