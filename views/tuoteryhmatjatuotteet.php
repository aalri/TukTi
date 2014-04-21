<h2>Tuoteryhmät</h2>
<?php if ($data->sivuja > 0){ ?>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Tuoteryhmänro</th>
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
                <td><a href="?ikkuna=muokkaatuoteryhmaankuuluvattuotteet&tuoteryhma=<?php echo $asia->getTuoteryhmanro();?>" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-cog"></span>  Muokkaa tuoteryhmään kuuluvia tuotteita</a></td>
                <td><a href="?ikkuna=muokkaatuoteryhmannimea&tuoteryhma=<?php echo $asia->getTuoteryhmanro();?>" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-cog"></span>  Muokkaa tuoteryhmän nimeä</a></td>
                <td><form class="form-vertical" role="form" method="POST" action=""> 
                        <input type="hidden" name="poista" value="<?php echo $asia->getTuoteryhmanro(); ?>">
                        <button type="submit" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> Poista tuoteryhmä</button>
                    </form></td>
            </tr>
            <?php
        endforeach;
        ?>
    </tbody>
</table>    
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=tuoteryhmatjatuotteet&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=tuoteryhmatjatuotteet&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; }else{?>
<p>Tuoteryhmät on tyhjä</p>
<?php } ?>
<br></br>
<a href="?ikkuna=lisaauusituoteryhma" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Lisää uusi tuoteryhmä</a>