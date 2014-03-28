<h2>Tuoteryhmät</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tuoteryhmännro</th>
            <th>Tuoteryhmä</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data->lista as $asia):
            ?>
            <tr>                                    
                <td><?php echo $asia->getTuoteryhmanro(); ?></td>
                <td><?php echo $asia->getNimi(); ?></td>
                <td><a href="#" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-cog"></span>  Muokkaa tuoteryhmaan kuuluvia tuotteita</a></td>
                <td><a href="#" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-cog"></span>  Muokkaa tuoteryhman nimea</a></td>
                <td><button type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> Poista tuoteryhma</button></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>    
<a href="#" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Lisää uusi tuoteryhmä</a>