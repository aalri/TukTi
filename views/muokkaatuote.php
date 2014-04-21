<h2>Muokkaa <?php echo $data->vanhanimi ?> tuotetietoja</h2>
<form class="form-horizontal" name="form" role="form" action="" method="POST">      
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Tuotenimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="nimi" value="<?php echo $data->tuote->getNimi() ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Määrä</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="maara" value="<?php echo $data->tuote->getJaljella() ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Hinta</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="hinta" value="<?php echo $data->tuote->getHinta() ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Lisäyskynnys</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="lisayskynnys" value="<?php echo $data->tuote->getLisayskynnys() ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Lisäysmäärä</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="lisaysmaara" value="<?php echo $data->tuote->getLisaysmaara() ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" name="tallennettumuutokset" value="kylla" class="btn btn-default">Tallenna muutokset</button>
        </div>
    </div>
    <a href="?ikkuna=varasto" class="btn btn-xs btn-default" role="button"> Palaa</a>
    <?php if (!empty($data->virhe)): ?>
        <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
    <?php endif; ?>
</form>