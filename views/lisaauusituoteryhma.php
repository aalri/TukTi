<h2>Lisää uusi tuoteryhmä</h2>
<form class="form-horizontal" name="form" role="form" action="" method="POST">      
    <div class="form-group">
        <label for="inputName" class="col-md-1 control-label">Nimi</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="inputName" name="nimi" placeholder="Nimi" value="<?php echo $data->tuoteryhma->getNimi() ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-default">Luo tuoteryhma</button>
        </div>
    </div>
    <a href="?ikkuna=tuoteryhmatjatuotteet" class="btn btn-xs btn-default" role="button"> Palaa</a>
    <?php if (!empty($data->virhe)): ?>
        <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
    <?php endif; ?>
</form>