<h2>Tuoteryhmät</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tuoteryhmä</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($data->lista as $asia):
            ?>
            <tr>                                    
                <td><a href="?ikkuna=tuoteryhma&tuoteryhma=<?php echo $asia->getTuoteryhmanro() ?>"><?php echo $asia->getNimi(); ?></td>
            </tr>
            <?php
        endforeach;
        ?>
</table>
