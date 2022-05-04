<?php 
  session_start();

  include("module/modul-conectivitate.php");
  include("module/modul-functii.php");

  $query = "select * from configuratii";
  $r = mysqli_query($con, $query);
  $results_conf = mysqli_fetch_assoc($r);
  $pret_interior = $results_conf['pret_interior'];
  $pret_culori = $results_conf['pret_culoare'];
  $pret_rims = $results_conf['pret_jante'];
  $pret_pachet = $results_conf['pret_pachet'];
  $id_culori = $results_conf['conf_culoare'];
  $id_interior = $results_conf['conf_interior'];
  $id_pachet = $results_conf['conf_pachet'];
  $id_jante = $results_conf['conf_jante'];

  $user_data = check_login($con);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Roboto:wght@300&family=Rubik:wght@600&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <link rel="stylesheet" href="css/style.css">

        <title>Configuratia mea</title>
    </head>
    <?php 

        $apikey = "4db44704-adf3-4b37-a993-dfbcff5df01b"; //c4b2ba2f-3db6-485b-b395-ef581c2d568d
        $ch = "https://api.mercedes-benz.com/configurator/v1/markets/ro_RO/models/2053151/configurations/";
        $result = $ch . $id_interior . "_GC-421_LE-L_" . $id_culori ."_MJ-802_PC-30P-431-DSP-P29-P31-P47-P49-P65-PYB-PYH-PYO_PS-089%23_SA-01U-02U-08U-09U-14U-16U-17U-235-249-258-270-274-287-294-309-33B-345-351-362-367-413-440-448-464-475-486-500-501-513-51U-531-537-580-5U4-604-611-628-642-737-739-772-776-79B-810-824-840-859-873-876-877-889-893-916-927-968-971-989-B59-K11-L5C-R01-R66-U01-U02-U09-U10-U22-U25-U26-U29-U60-U79-U85_SC-1B3-1P6-2U1-2U8-3U1-502-56V-5P6-6P5-6S8-8B6-8P8-8U6-8U8-998-B09-K14-K27-PZB/images/vehicle?apikey=3656443a-3bb0-45dd-9ef5-3c262711358c";
        $ch = curl_init($result);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $results = json_decode($response, true);

        $i = 0;
        foreach($results['vehicle'] as $img)
        {
            $imgs[$i++] = $img['url'];
        }
    ?>
    <body>        
        <!-- HEADER -->
        <?php
            include "module/modul-header.php";
        ?>
        <!-- HEADER -->

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?=$imgs[0]?>" class="d-block w-100" alt="Ext">
            </div>
            <div class="carousel-item">
                <img src="<?=$imgs[1]?>" class="d-block w-100" alt="Int">
            </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
        <main>
            <div class="container">
                <div class="wrapper">
                    <div class="main-text">
                        <h1>Configurația dvs.</h1>
                        <h2><?=$results_conf['model']?></h2>
                        <br>
                        <p style="font-size:20px">Preț total: <?=$results_conf['pret_total']?>€</p>
                    </div>
                    <div class="back-to-home">
                        <a href="index.php" class="btn btn-primary">Înapoi</a>
                    </div>
                </div>
            </div>
        </main>

            <!-- FOOTER -->
            <?php 
                include "module/modul-footer.php";
            ?>
            <!-- FOOTER -->
    </body>
</html>