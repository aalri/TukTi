<?php
if ($data->tuoteryhma === null) {
    ?>
    <h2>Tuoteryhmää ei ole olemassa</h2>
    <?php
} else if (empty($data->lista)) {
    ?>
    <h2><?php echo $data->tuoteryhma->getNimi(); ?> on tyhjä</h2>
    <?php
} else {
    ?> 
    <h2><?php echo $data->tuoteryhma->getNimi(); ?></h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tuotenimi</th>
                <th>Löytyy heti</th>
                <th>Hinta</th>
                <?php if (kirjautunutAsiakas()) { ?>
                    <th>Määrä</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->lista as $asia):
                ?>
                <tr>                                    
                    <td><?php echo $asia->getNimi(); ?></td>
                    <td><?php echo $asia->getJaljella(); ?></td>
                    <td><?php echo $asia->getHinta(); ?></td>
                    <?php if (kirjautunutAsiakas()) { ?>
                        <td>
                            <form class="form-vertical" role="form" method="POST" action=""> 
                                <input type="hidden" name="tuotenro" value="<?php echo $asia->getTuotenro(); ?>">
                                <input type="text" name="maara" size="1" value="1">
                                <button type="submit" class="btn btn-default">Lisää tilaukseen</button>
                            </form>
                        </td>
                    <?php } ?>
                </tr>
                <?php
            endforeach;
        }
        ?>    
    </tbody>
</table>
<a href="http://alrial.users.cs.helsinki.fi/TukTi/index.php?ikkuna=tuoteryhmat" class="btn btn-xs btn-default" role="button"> Palaa</a>
<?php if (!empty($data->virhe)): ?>
    <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
<?php endif; ?>
<?php if (!empty($data->onnistui)): ?>
    <div class="alert alert-success"><?php echo $data->onnistui; ?></div>
<?php endif; ?>