<?php
  session_start();
  $user = $_SESSION['user'];
    if(!isset($_SESSION['user'])){
    header("location: models/404Page.php?notFound");
  }
    //else if($_SESSION['id_role']!=1)   
    else if($user->id_role!=1){
    header("location: models/404Page.php?notFound");
  }
    else{
  include "includes/headAdmin.php";
  include "includes/headerAdmin.php";
  include "config/connection.php";
  //include "models/functions.php";

  function getAllFromTabel($nameTabel){
    global $conn;

    try{
        $query="SELECT * FROM $nameTabel";
        $result=$conn->query($query)->fetchAll();
        return $result;
    }
    catch(PDOException $e){
        $message="Server error";
    }
}

  $brands=getAllFromTabel("brand");
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
            <a class="navbar-brand" href="adminPanel.php">Brand Table</a>
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
      <!-- update i delete -->
      <div class="col-md-12">   
        <h3>Brand</h3>
        <div id="artist">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_brand</th>
                  <th scope="col">brand_name</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($brands as $b):
              ?>
                <tr>
                  <th scope="row"><?=$b->id_brand?></th>
                  <td><input type="text" id="nameArtist<?=$b->id_brand?>" class="form-control" value="<?=$b->brand_name?>"></td>
                  <td><a href="#" data-id="<?=$b->id_brand?>" class="updateArtist">Update</a></td>
                  <td><a href="#" data-id="<?=$b->id_brand?>" class="deleteArtist">Delete</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
          </div>
          </div>
		    </div>
      <!-- kraj update i delete -->
      <!-- insert -->
      <div class="row">
      <div class="col-md-12 mt-5">   
      <table class="table">
            <h3>Insert brand</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameArtist" class="form-control" placeholder="Enter name"></td>
                  <td><a href="#" id="insertArtist">Insert</a></td>
                </tr>
              </tbody>
      </table>  
		  </div>
      </div>
      <!-- kraj inserta -->
		</div>
    </div>
<?php
      }
  include "includes/footerAdmin.php";
?>
