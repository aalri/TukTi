<?php
if ($data->lista === null) {
    ?>
    <h2>Ei ole Tuoteryhmiä</h2>
    <?php
}
?>
<h2>Tuoteryhmät</h2>
<p>Sivu <?php echo $data->sivu ?>/<?php echo $data->sivuja ?></p>
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
<?php if ($data->sivu > 1): ?>
<a href="?ikkuna=tuoteryhmat&sivu=<?php echo $data->sivu - 1; ?>" class="btn btn-xs btn-default" role="button">Edellinen sivu</a>
<?php endif; ?>
<?php if ($data->sivu < $data->sivuja): ?>
<a href="?ikkuna=tuoteryhmat&sivu=<?php echo $data->sivu + 1; ?>" class="btn btn-xs btn-default" role="button">Seuraava sivu</a>
<?php endif; ?>