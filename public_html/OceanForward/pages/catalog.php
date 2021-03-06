<?php
// start session
session_start();
// Capture previous session ID if available, otherwise save current session ID as cookie
if(isset($_COOKIE['PHPSESSID'])) {
  session_id($_COOKIE['PHPSESSID']);
}
// re-set cookie to maintain session ID
setcookie('PHPSESSID', session_id(), time() + 60*60*24*30);

// If this file is not called by another file, set rootPath locally to root
if(!isset($rootPath)) {
    $rootPath = "../../../";
}

(require $rootPath . 'public_html/OceanForward/scripts/controllers/catalogController.php') or 
  exit("Unable to include 'catalogController.php' from public_html/OceanForward/scripts/controllers/");

$modelArr = getModelsArray();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/default.css" rel="stylesheet">
    <link href="../css/catalog.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-fixed-top navbar-default">
      <div class="container">
        <button class="navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse navHeaderCollapse">
          <ul class="nav navbar-nav navbar-left navigation">
            <li><a href="../index.html" class="scroll">Home</a></li>
            <li class="active"><a href="#" class="scroll">Catalog</a></li>
            <li><a href="contact.php" class="scroll">Contact</a></li>
          </ul>
          <!-- <a href="#" class="shopping_cart glyphicon glyphicon-log-in" title="Log in">
          </a> -->
          <a href="cart.php" class="shopping_cart glyphicon glyphicon-shopping-cart" title="Shopping Cart">
          </a>
        </div>
      </div>
    </nav>
    <!-- Page Header -->
    <section>
      <div class="container products col-md-12">
        <div class="page-title">
          <h1>Yachts</h1>
          <img src="../images/logo-white.png">
        </div>
      </div>
    </section>
    <!-- Catalog Items -->
  <section>
      <div class="container">
        <div class="row new-section">
          <h1 class="catalog-title">Yacht Catalog</h1>
        <?php
          foreach ($modelArr as $model) {
            //$folderLoc = $rootPath . "OceanForward/images/yachts/".$model["model_name"];
            $folderLoc = '../../OceanForward/images/yachts/'.$model['model_name'];
            echo"<div class='col-md-4 contain'>
              <div class='product-thumb1'>
                <img src='$folderLoc/thum.jpg' width='325px' height='250px'>
              </div>
              <div class='content-thumb'>";
                print_r('<h4>'.$model["model_name"].'</h4>');
                print_r('<h5>Price: $'.number_format($model["price"],2).'</h5>');  
                print_r('<h6>Length: '.$model["length"].' ft</h6>');
                $encodedModelName = urlencode($model["model_name"]);
                $clickHandler = "parent.location='product.php?model=$encodedModelName'";
                echo "<input type='button' class='btn' onClick=$clickHandler value='More'>";
            echo"</div>
            </div>";
          }
          ?>
        </div>
      </div>
    </section>
    <footer class="footer OF-footer">
      <div class="row">
        <div class="col-md-3 col-md-offset-2">
          <ul>
            <li class="footer-title">Site Map</li>
            <li><a href="../index.html">Home</a></li>
            <li><a href="#">Catalog</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-2">
          <ul>
            <li class="footer-title">My Account</li>
            <li><a href="#">Order History</a></li>
            <li><a href="#">My Returns</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <ul>
            <li class="footer-title">Contact</li>
            <li><a href="#">Returns</a></li>
            <li><a href="#">Shipping</a></li>
            <li><a href="#">Legal</a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 copy copy_top">
          &copy; 2016 Ocean Forward Inc. Victoria BC CANADA
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 copy copy_bottom">
          This site is for academic purposes only
        </div>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
