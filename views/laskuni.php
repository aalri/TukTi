<h2>Laskuni</h2>
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