<h2>Asiakkaat</h2>
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
                    <td class="text-muted"><?php echo $asia->getOsoite() ?></td>
                    <td class="text-muted">Poistettu</td>
                </tr>
            <?php } else { ?>
                <tr>                                    
                    <td><?php echo $asia->getAsiakasnro(); ?></td>
                    <td><?php echo $asia->getNimi(); ?></td>
                    <td><?php echo $asia->getOsoite() ?></td>
                    <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> Poista Asiakas</button></td>
                </tr>
                <?php
            }
        endforeach;
        ?>
    </tbody>
</table>
