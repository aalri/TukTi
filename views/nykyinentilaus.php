<?php
    if (count($data->nykyinentilaus->getRivit()) !== 0) {
        ?>
        <h2>Nykyinen tilaus</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tuotenimi</th>
                    <th>Maara</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->nykyinentilaus->getRivit() as $asia):
                    ?>
                    <tr>                                    
                        <td><?php echo Tuote::getTuoteNimiNumerolla($asia->getTuotenro()); ?></td>
                        <td><?php echo $asia->getMaara() ?></td>
                        <td>
                            <form class="form-vertical" role="form" method="POST" action=""> 
                                <input type="hidden" name="tuotenro" value="<?php echo $asia->getTuotenro(); ?>">
                                <button type="submit" class="btn btn-default">Poista nykyisestä tilauksesta</button>
                            </form>
                        </td>
                    </tr>                
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <h2>Nykyinen tilauksesi on tyhjä</h2>
        <?php
    }
?>
<?php if (!empty($data->onnistui)): ?>
    <div class="alert alert-success"><?php echo $data->onnistui; ?></div>
<?php endif; ?>    