<h2>Tuoteryhmään <?php echo $data->tuoteryhma->getNimi() ?> kuuluu</h2>
<?php if ($data->sivuja > 0){ ?>
<p>Huom! muutokset unohtuvat vaihdettaessa sivua, jos muutoksia ei tallenna.</p>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
<form role="form" method="POST" action=""> 
    <table class="table table-striped">    
        <thead>
            <tr>
                <th>Tuotenro</th>
                <th>Tuotenimi</th>
                <th>Kuuluu ryhmään</th>
            </tr>
        </thead>
        <tbody>        
            <?php
            foreach ($data->lista as $asia):
                ?>
                <tr>                
                    <td><?php echo $asia->getTuotenro(); ?></td>
                    <td><?php echo $asia->getNimi(); ?></td>
                    <td>       
                        <input type="hidden" name="kuuluiryhmaan<?php echo $asia->getTuotenro(); ?>" <?php if ($asia->getKuuluuryhmaan()){ ?> value="true" <?php }else{ ?> value="false" <?php } ?>>
                        <input type="checkbox" name="kuuluuryhmaan<?php echo $asia->getTuotenro(); ?>" <?php if ($asia->getKuuluuryhmaan()){ ?> checked <?php } ?>>                      
                    </td>                
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>    
    </table>
    <button type="submit" name="tallennettumuutokset" value="kylla" class="btn btn-default">Tallenna muutokset</button>
</form>
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=muokkaatuoteryhmaankuuluvattuotteet&tuoteryhma=<?php echo $data->tuoteryhma->getTuoteryhmanro(); ?>&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=muokkaatuoteryhmaankuuluvattuotteet&tuoteryhma=<?php echo $data->tuoteryhma->getTuoteryhmanro(); ?>&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; }else{?>
<p>Ei löydy tuotteita, joiden kuuluvuutta voisi muokata.</p>
<?php } ?>
<br></br>
<a href="?ikkuna=tuoteryhmatjatuotteet" class="btn btn-default" role="button"> Palaa</a>