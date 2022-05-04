<header>
  <div class="header-container">
  <div id="header-logo">
    <a href="index.php">
      <img src="https://logodownload.org/wp-content/uploads/2014/04/mercedes-benz-logo-1-1.png" alt="small-logo">
    </a>
  </div>
  <div id="header-components">
    <?php
      if(!Login())
      {
        ?>
        <a href="login.php"><i class="fa fa-user" aria-hidden="true"></i></a>
        <?php
      }
      else
      {
        ?>
        <div style="justify-conent: space-between;">
          <a href="logout.php">Logout</a>
          <a href="favorites.php">Salvari</i></a>
        </div>
        <?php
      }
    ?>
  </div>
</div>
</header>
