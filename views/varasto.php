<h2>Varasto</h2>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Tuotenimi</th>
            <th>Määrä</th>
            <th>Hinta</th>
            <th>Lisäyskynnys</th>
            <th>Lisäysmäärä</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data->lista as $asia):
            if (!$asia->onPoistettu()){
            ?>        
            <tr>                                    
                <td><?php echo $asia->getTuotenro(); ?></td>
                <td><?php echo $asia->getNimi(); ?></td>      
                <td><?php echo $asia->getJaljella(); ?></td>
                <td><?php echo $asia->getHinta(); ?></td>                 
                <td><?php echo $asia->getLisayskynnys(); ?></td>
                <td><?php echo $asia->getLisaysmaara(); ?></td>
                <td><a href="?ikkuna=muokkaatuote&tuotenro=<?php echo $asia->getTuotenro();?>" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-cog"></span>  Muokkaa tuotetietoja</a></td>
                <td><form class="form-vertical" role="form" method="POST" action=""> 
                        <input type="hidden" name="poista" value="<?php echo $asia->getTuotenro(); ?>">
                        <button type="submit" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> Poista tuote</button>
                    </form></td>
            </tr>            
            <?php
            }
        endforeach; ?>
    </tbody>
</table>
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=varasto&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=varasto&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; ?>
<br></br>
<a href="?ikkuna=lisaauusituote" class="btn btn-xs btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Lisää tuote</a>