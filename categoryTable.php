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
  //include "modals/functions.php";

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

  $category=getAllFromTabel("category");
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
            <a class="navbar-brand" href="adminPanel.php">Category Table</a>
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
        <h3>Category</h3>
        <div id="category">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_category</th>
                  <th scope="col">name</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($category as $c):
              ?>
                <tr>
                  <th scope="row"><?=$c->id_category?></th>
                  <td><input type="text" id="nameCategory<?=$c->id_category?>" class="form-control" value="<?=$c->name_category?>"></td>
                  <td><a href="#" data-id="<?=$c->id_category?>" class="updateCategory">Update</a></td>
                  <td><a href="#" data-id="<?=$c->id_category?>" class="deleteCategory">Delete</a></td>
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
            <h3>Insert category</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameCategory" class="form-control" placeholder="Enter name"></td>
                  <td><a href="#" id="insertCategory">Insert</a></td>
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
