<?php 
    include_once "module/modul-functii.php";

    $fisiere = [];
    $dir = opendir("imagini"); //resursa imagini
    while($nf = readdir($dir))
    {
        if(!is_dir("imagini/{$nf}") && EsteImagine($nf))
        {
            $fisiere[] = $nf;
        }
    }
    closedir($dir);

?>
<main>
    <div class="section-header">
        <h1>Autovehicule disponibile</h1>
    </div>
    <div class="row">
        <div class="col-3 filter">
            <h2 class="filter-list-title">Model autovehicul</h2>
            <ul>
                <li class="list" data-filter="sedan">Limuzină</li>
                <li class="list" data-filter="suv">SUV</li>
                <li class="list" data-filter="coupe">Coupe</li>
                <hr style="margin-left: 50px; width: 35%">
                <li class="list active" data-filter="all">Vezi toate modelele</li>
            </ul>
        </div>
        <div class="col-9 gallery">
            <?php 
                foreach($fisiere as $nf)
                {
                    $v = explode("-", $nf);
                    $tip = $v[0];
                    $nume_masina = pathinfo($v[1], PATHINFO_FILENAME);
                    ?>
                        <div class="itemBox <?=TipMasina($tip)?>">
                            <a href="configurator.php?model=<?=trim(ModelMasina($nume_masina, $tip), " ")?>">
                                <p class="itemBox-car"><?=ModelMasina($nume_masina, $tip)?></p>
                                <div class="itemBox-link">
                                    <p class="itemBox-price">începând de la ****€</p>
                                    <img src="imagini/<?=htmlspecialchars($nf)?>" alt="<?=TipMasina($tip)?>" class="img-fluid my-3">
                                    <p class="itemBox-button">Configurați</p>
                                </div>
                            </a>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</main>