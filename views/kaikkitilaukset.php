<h2>Tilaukset</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tilausnro</th>
            <th>Toimitettu</th>
            <th>Tilauspaiva</th>
            <th>Maksettu</th>
            <th>Maksettupaiva</th>
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
            </tr>            
            <?php
        endforeach;
        ?>
</table>