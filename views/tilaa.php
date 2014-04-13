<h2>Tilaa</h2>

<?php
if ($data->maksamatta){
    ?>
    <p>Et voi tilata lisää ennen kuin olet maksanut laskusi!</p>
    <?php
} else if (count($data->nykyinentilaus->getRivit()) !== 0) {
    ?>        
    
    <h4>Hinta yhteensä: <?php echo money_format('%.2n',$data->nykyinentilaus->hintaYhteensa()) ?> e</h4>
    <p>Haluatko varmasti tilata tuotteet?</p>
    <form class="form-vertical" role="form" method="POST" action=""> 
        <button type="submit" name="tilaa" class="btn btn-default">Kyllä</button>
    </form>
    <?php
}else{
    ?>
    <p>Et voi tilata tyhjää</p>    
    <?php
}
