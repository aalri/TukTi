<h2>Muokkaa tietojani</h2>
<form class="form-horizontal" name="form" role="form" action="" method="POST">      
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="nimi" value="<?php echo $data->asiakas->getNimi() ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Osoite</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="osoite" value="<?php echo $data->asiakas->getOsoite() ?>">
        </div>
    </div>    
    <div class="form-group">
        <label for="inputName" class="col-md-2 control-label">Uusi Salasana (Tyhjä ei muutosta)</label>
        <div class="col-md-10">
            <input type="password" class="form-control" id="inputName" name="salasana" value="">
        </div>
    </div>    
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" name="tallennettumuutokset" value="kylla" class="btn btn-default">Tallenna muutokset</button>
        </div>
    </div>
    <?php if (!empty($data->virhe)): ?>
        <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
    <?php endif; ?>
</form>

