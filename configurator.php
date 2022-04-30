<?php 
  session_start();

  include("module/modul-conectivitate.php");
  include("module/modul-functii.php");

  $query = "select * from configuratii";
  $r = mysqli_query($con, $query);
  $results = mysqli_fetch_assoc($r);
  $pret_interior = $results['pret_interior'];
  $pret_culori = $results['pret_culoare'];
  $pret_rims = $results['pret_jante'];
  $pret_pachet = $results['pret_pachet'];
  $id_culori = $results['conf_culoare'];
  $id_interior = $results['conf_interior'];

  $fisiere = [];
  $dir = opendir("configurator"); //resursa imagini
  while($nf = readdir($dir))
  {
      if(!is_dir("configurator/{$nf}") && EsteImagine($nf))
      {
          $fisiere[] = $nf;
      }
  }
  closedir($dir);
  $base_price = PretModel($_GET["model"]);

  if(isset($_POST['id_i']))
  {
    $query1 = "select * from interior where id='{$_POST['id_i']}'";
    $r = mysqli_query($con, $query1);
    $results = mysqli_fetch_assoc($r);
    $id_interior = $results['id_interior'];
    $query2 = "update configuratii set conf_interior='{$results["id_interior"]}', pret_interior='{$results["pret"]}'";
    mysqli_query($con, $query2);
  }
  else if(isset($_POST['id_c']))
  {
    $query1 = "select * from culori where id='{$_POST['id_c']}'";
    $r = mysqli_query($con, $query1);
    $results = mysqli_fetch_assoc($r);
    $id_culori = $results['id_culoare'];
    $query2 = "update configuratii set conf_culoare='{$results["id_culoare"]}', pret_culoare='{$results["pret"]}'";
    mysqli_query($con, $query2);
  }
  else if(isset($_POST['id_j']))
  {
    $query1 = "select * from rims where id='{$_POST['id_j']}'";
    $r = mysqli_query($con, $query1);
    $results = mysqli_fetch_assoc($r);
    $query2 = "update configuratii set conf_jante='{$results["id_rims"]}', pret_jante='{$results["pret"]}'";
    mysqli_query($con, $query2);
  }
  else if(isset($_POST['id_p']))
  {
    $query1 = "select * from pachete where id='{$_POST['id_p']}'";
    $r = mysqli_query($con, $query1);
    $results = mysqli_fetch_assoc($r);
    $query2 = "update configuratii set pret_pachet='{$results["pret"]}'";
    mysqli_query($con, $query2);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/configurator.css">

    <title>Car Configurator</title>
  </head>
  <body>
    <!-- HEADER -->
    <?php
      include "module/modul-header.php";
    ?>
    <!-- HEADER -->

    <div class="configurator-header">
      <div class="header-insider container">
        <div class="desc">
          <p><?=$_GET["model"]?></p>
        </div>
        <div class="pret">
          <p>Pret: <?=$base_price + $pret_culori + $pret_interior + $pret_pachet + $pret_rims?> €</p>
        </div>
      </div>
    </div>

    <section> 
      <?php 

        $apikey = "c4b2ba2f-3db6-485b-b395-ef581c2d568d";
        $ch = "https://api.mercedes-benz.com/configurator/v1/markets/ro_RO/models/2053151/configurations/";
        $result = $ch . $id_interior . "_GC-421_LE-L_" . $id_culori ."_MJ-802_PC-30P-431-DSP-P29-P31-P47-P49-P65-PYB-PYH-PYO_PS-089%23_SA-01U-02U-08U-09U-14U-16U-17U-235-249-258-270-274-287-294-309-33B-345-351-362-367-413-440-448-464-475-486-500-501-513-51U-531-537-580-5U4-604-611-628-642-737-739-772-776-79B-810-824-840-859-873-876-877-889-893-916-927-968-971-989-B59-K11-L5C-R01-R66-U01-U02-U09-U10-U22-U25-U26-U29-U60-U79-U85_SC-1B3-1P6-2U1-2U8-3U1-502-56V-5P6-6P5-6S8-8B6-8P8-8U6-8U8-998-B09-K14-K27-PZB/images/vehicle?apikey=c4b2ba2f-3db6-485b-b395-ef581c2d568d";
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
    </section>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button class="navbar-toggler conf-nav-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse conf-nav" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Exterior
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a data-id="1" class="dropdown-item citem">Culori</a></li>
                <li><a data-id="2" class="dropdown-item citem">Jante</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a data-id="3" class="nav-link citem">Interior</a>
            </li>
            <li class="nav-item">
              <a data-id="4" class="nav-link citem">Pachete</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main> 
      <div class="wrapper active"> 
      <div id="culori" class="conf-section active">
        <?php 
          $query = "select * from culori";
          $result = mysqli_query($con, $query);

          if($result)
          {
            if($result && mysqli_num_rows($result) > 0)
            {
              while($colors_data = mysqli_fetch_array($result, MYSQLI_ASSOC))
              {
                ?>
                <div class="col-4 d-flex justify-content-center parent-card">
                 <div class="card" style="width: 15rem;">
                  <img src="https://i.imgur.com/<?=htmlspecialchars($colors_data['imagine_culoare'])?>" class="card-img-top" alt="<?=$colors_data['id_culoare']?>">
                    <div class="card-body">
                      <h5 class="card-title"><?=$colors_data['nume_culoare']?></h5>
                      <p class="card-text"><?=$colors_data['pret']?>€</p>
                      <form method="post" action="configurator.php?model=<?=$_GET['model']?>"> 
                        <input type="hidden" id="id_c" name="id_c" value="<?=$colors_data['id']?>">
                        <button class="btn btn-primary" type="submit">Sumbit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          }
        ?>
        </div>
      </div>
      <div class="wrapper"> 
      <div id="jante" class="conf-section">
        <?php 
          $query = "select * from rims";
          $result = mysqli_query($con, $query);

          if($result)
          {
            if($result && mysqli_num_rows($result) > 0)
            {
              while($rims_data = mysqli_fetch_array($result, MYSQLI_ASSOC))
              {
                ?>
                <div class="col-4 d-flex justify-content-center parent-card">
                <div class="card" style="width: 15rem;">
                  <img src="https://i.imgur.com/<?=htmlspecialchars($rims_data['imagine_rims'])?>" class="card-img-top" alt="<?=$rims_data['id_rims']?>">
                    <div class="card-body">
                      <h5 class="card-title"><?=$rims_data['nume_rims']?></h5>
                      <p class="card-text"><?=$rims_data['pret']?>€</p>
                      <form method="post" action="configurator.php?model=<?=$_GET['model']?>"> 
                        <input type="hidden" id="id_j" name="id_j" value="<?=$rims_data['id']?>">
                        <button class="btn btn-primary" type="submit">Sumbit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          }
        ?>
      </div>
      </div>
      <div class="wrapper">
      <div id="interior" class="conf-section">
      <?php 
          $query = "select * from interior";
          $result = mysqli_query($con, $query);

          if($result)
          {
            if($result && mysqli_num_rows($result) > 0)
            {
              while($interior_data = mysqli_fetch_array($result, MYSQLI_ASSOC))
              {
                ?>
                <div class="col-4 d-flex justify-content-center parent-card">
                <div class="card" style="width: 25rem;">
                  <img src="https://i.imgur.com/<?=htmlspecialchars($interior_data['imagine_interior'])?>" class="card-img-top" alt="<?=$interior_data['id_interior']?>">
                    <div class="card-body">
                      <h5 class="card-title"><?=$interior_data['nume_interior']?></h5>
                      <p class="card-text"><?=$interior_data['pret']?>€</p>
                      <form method="post" action="configurator.php?model=<?=$_GET['model']?>"> 
                        <input type="hidden" id="id_i" name="id_i" value="<?=$interior_data['id']?>">
                        <button class="btn btn-primary" type="submit">Sumbit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          }
        ?>
      </div>
      </div>
      <div class="wrapper">
      <div id="pachete" class="conf-section">
        <?php 
          $query = "select * from pachete";
          $result = mysqli_query($con, $query);

          if($result)
          {
            if($result && mysqli_num_rows($result) > 0)
            {
              while($pachete_data = mysqli_fetch_array($result, MYSQLI_ASSOC))
              {
                ?>
                <div class="col-4 d-flex justify-content-center parent-card">
                <div class="card" style="width: 24rem;">
                    <div class="card-body">
                      <h5 class="card-title"><?=$pachete_data['nume_pachet']?></h5>
                      <p class="card-text"><?=$pachete_data['pret']?>€</p>
                      <ul>
                        <?php 
                          $optiuni = explode("/", $pachete_data['optiuni']);
                          foreach($optiuni as $componente)
                          {
                            ?>
                            <li><?=$componente?></li>
                            <?php
                          }
                        ?>
                      </ul>
                      <form method="post" action="configurator.php?model=<?=$_GET['model']?>"> 
                        <input type="hidden" id="id_p" name="id_p" value="<?=$pachete_data['id']?>">
                        <button class="btn btn-primary" type="submit">Sumbit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
          }
        ?>
      </div>
      </div>

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/d55f974d75.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
    <script src="js/configurator.js"></script>
    <script> 
      
    </script>
  </body>
</html>