<h2>Laskuni</h2>
<?php if  ($data->sivuja == 0){ ?>
<p>Sinulla ei ole aikaisempia laskuja</p>
<?php }else{ ?>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Laskunro</th>
            <th>Tilausnro</th>
            <th>Tyyppi</th>
            <th>Erapaiva</th>
            <th>Hinta</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $lasku = 0;
        foreach ($data->lista as $asia):
            ?>
            <tr>                                    
                <td><?php echo $asia->getLaskunro(); ?></td>
                <td><?php echo $asia->getTilausnro(); ?></td>
                <td><?php echo $asia->getTyyppi(); ?></td>
                <td><?php echo $asia->getErapaiva(); ?></td>
                <td><?php echo money_format('%.2n', $data->yhteensa[$lasku]); ?> e</td>
            </tr>            
            <?php
            $lasku++;
        endforeach;
        ?>
</table>
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=tilaukset&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=tilaukset&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; }?>