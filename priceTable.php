<?php
    session_start();
    $user = $_SESSION['user'];
      if(!isset($_SESSION['user'])){
      header("location: models/404.php?notFound");
    }
      //else if($_SESSION['id_role']!=1)   
      else if($user->id_role!=1){
      header("location: models/404.php?notFound");
    }
  else{
  include "includes/headAdmin.php";
  include "includes/headerAdmin.php";
  //include "models/functions.php";
  include "config/connection.php";

  function priceProduct(){
    global $conn;

    try{
        $query="SELECT * FROM price p INNER JOIN product pr ON p.id_price = pr.id_price";
        $products=$conn->query($query)->fetchAll();
        //var_dump($products);
        return $products;
    }
    catch(PDOException $e){
        $message="Server error";
    }
    
}

  $price=priceProduct();
?>
  <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="adminPanel.php">Price Table</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
        </div>
      </nav>
       <!-- End Navbar -->
    <div class="content">
        <div class="container">
            <div class="row">
      <!-- update-->
      <div class="col-md-12">   
        <h3>Price</h3>
        <div id="price">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_price</th>
                  <th scope="col">name</th>
                  <th scope="col">price</th>
                </tr>
              </thead>
              <tbody>
              <?php
               //var_dump($price);
                foreach($price as $p):
                   
              ?>
                <tr>
                  <th scope="row"><?=$p->id_price?></th>
                  <td><input type="text" id="nameProducts<?=$p->id_price?>" class="form-control" value="<?=$p->name?>" disabled></td>
                  <td><input type="number" id="priceOld<?=$p->id_price?>" class="form-control" value="<?=$p->price?>"></td>
                  <td><a href="#" data-id="<?=$p->id_price?>" class="updatePrice">Update</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
          </div>
          </div>
		    </div>
      <!-- kraj update-->
		</div>
    </div>
<?php
  }
  include "includes/footerAdmin.php";
?>
