<h2>Asiakkaat</h2>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Asiakkaan nimi</th>
            <th>Osoite</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data->lista as $asia):
            if ($asia->getPoistettu()) {
                ?>
                <tr>                                    
                    <td class="text-muted"><?php echo $asia->getAsiakasnro(); ?></td>
                    <td class="text-muted"><?php echo $asia->getNimi(); ?></td>
                    <td class="text-muted"><?php echo $asia->getOsoite(); ?></td>
                    <td class="text-muted">Poistettu</td>
                </tr>
            <?php } else { ?>
                <tr>                                    
                    <td><?php echo $asia->getAsiakasnro(); ?></td>
                    <td><?php echo htmlspecialchars($asia->getNimi()); ?></td>
                    <td><?php echo htmlspecialchars($asia->getOsoite()); ?></td>
                    <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> Poista Asiakas</button></td>
                </tr>
                <?php
            }
        endforeach;
        ?>
    </tbody>
</table>
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=asiakkaat&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=asiakkaat&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; ?>