<h2>Tilauksen numero <?php echo $data->tilausnro ?> tiedot</h2>
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
<form class="form-vertical" role="form" method="POST" action=""> 
        <button type="submit" class="btn btn-default" name="palaa" value="1">Palaa</button>
    </form> 