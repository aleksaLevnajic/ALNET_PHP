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

  $menu=getAllFromTabel("menu");
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
            <a class="navbar-brand" href="adminPanel.php">Menu Table</a>
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
        <h3>Menu</h3>
        <div id="menu">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_menu</th>
                  <th scope="col">name_menu</th>
                  <th scope="col">href_menu</th>
                  <th scope="col">show_menu</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($menu as $m):
              ?>
                <tr>
                  <th scope="row"><?=$m->id_menu?></th>
                  <td><input type="text" id="nameMenu<?=$m->id_menu?>" class="form-control" value="<?=$m->name_menu?>"></td>
                  <td><input type="text" id="hrefMenu<?=$m->id_menu?>" class="form-control" value="<?=$m->path_m?>"></td>
                  <td><input type="number" id="showMenu<?=$m->id_menu?>" class="form-control" value="<?=$m->display?>"></td>
                  <td><a href="#" data-id="<?=$m->id_menu?>" class="updateMenu">Update</a></td>
                  <td><a href="#" data-id="<?=$m->id_menu?>" class="deleteMenu">Delete</a></td>
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
            <h3>Insert menu</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameMenu" class="form-control" placeholder="Enter name"></td>
                  <td><input type="text" id="hrefMenu" class="form-control" placeholder="Enter href"></td>
                  <td><input type="number" id="showMenu" class="form-control" placeholder="Enter show_menu"></td>
                  <td><a href="#" id="insertMenu">Insert</a></td>
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
