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

  function getProducts(){
    global $conn;

    try{
        $query="SELECT * FROM product p INNER JOIN category c ON p.id_category=c.id_category 
        INNER JOIN brand b ON p.id_brand=b.id_brand INNER JOIN price r ON p.id_price=r.id_price 
        INNER JOIN picture pc ON p.id_picture=pc.id_picture ORDER BY p.id_product";
        $products=$conn->query($query)->fetchAll();
        return $products;
    }
    catch(PDOException $e){
        $message="Server error";
    }
}
////
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
  $products=getProducts();
  $categories=getAllFromTabel("category");
  $artist=getAllFromTabel("brand");
  $price=getAllFromTabel("price");
  $brand=getAllFromTabel("brand");
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
            <a class="navbar-brand" href="adminPanel.php">Products Table</a>
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
        <h3>Products</h3>
        <div id="productss">
        <form action="#" enctype="multipart/form-data">
            <table class="table"> 
              <thead>
                <tr>
                  <th scope="col">id_products</th>
                  <th scope="col">name</th>
                  <th scope="col">picture</th>
                  <th scope="col">change src</th>
                  <th scope="col">category_name</th>
                  <th scope="col">description</th>
                  <th scope="col">brand_name</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($products as $p):
              ?>
                <tr>
                  <th scope="row"><?=$p->id_product?></th>
                  <td><input type="text" id="nameProducts<?=$p->id_product?>" class="form-control" value="<?=$p->name?>"></td>
                  <td><input type="text" id="srcProducts<?=$p->id_product?>" class="form-control" value="<?=$p->path?>" disabled></td>
                  <td><input type="file" id="fileProducts<?=$p->id_product?>" class="form-control-file"></td>
                  <td>
                      <!-- padajuca lista -->
                      <div class="form-group">
                             <select class="form-select product<?=$p->id_product?>"  aria-label="Default select example">
                              <option selected value="<?=$p->id_category?>"><?=$p->name_category?></option>
                                <?php
                                foreach($categories as $c):
                                ?>
                              <option value="<?=$c->id_category?>"><?=$c->name_category?></option>
                                <?php
                                  endforeach;
                                ?>
                            </select>
                        </div>
                      <!-- kraj padajuce liste -->
                  </td>
                  <td><input type="text" id="deliveryProducts<?=$p->id_product?>" class="form-control" value="<?=$p->description?>"></td>
                  <td><input type="text" id="artistProducts<?=$p->id_product?>" class="form-control" value="<?=$p->brand_name?>" disabled></td>
                  <td><a href="#" data-id="<?=$p->id_product?>" class="updateProduct">Update</a></td>
                  <td><a href="#" data-id="<?=$p->id_product?>" class="deleteProduct">Delete</a></td>
                </tr>
              <?php
                endforeach;
              ?>
            </tbody>
            </table>
            </form>
            <p id="write"></p>
          </div>
          </div>
		    </div>
      <!-- kraj update i delete -->
      <!-- insert -->
      <div class="row">
      <div class="col-md-12 mt-5">   
      <form action="#" enctype="multipart/form-data">
      <table class="table">
            <h3>Insert product</h3>
              <tbody>
                <tr>
                  <td><input type="text" id="nameProduct" class="form-control" placeholder="Enter name"></td>
                </tr>                
                <td><input type="text" id="descProduct" class="form-control" placeholder="Description"></td>
                </tr>
                <tr>
                <td><div class="form-group">
                             <select class="form-select catInsert" id="catInsert" aria-label="Default select example">
                              <option selected value="0">Choose category</option>
                                
                                <?php
                                foreach($categories as $c):
                                ?>
                              <option value="<?=$c->id_category?>"><?=$c->name_category?></option>
                                <?php
                                  endforeach;
                                ?>
                            </select>
                    </div></td>
                </tr>
                <tr>
                <td><div class="form-group">
                             <select class="form-select catInsert" id="priceInsert" aria-label="Default select example">
                              <option selected value="0">Choose price</option>
                              <?php
                                foreach($price as $p):
                                ?>
                              <option value="<?=$p->id_price?>"><?=$p->price?></option>
                                <?php
                                  endforeach;
                                ?>
                            </select>
                    </div></td>
                </tr>
                <tr>
                <td><div class="form-group">
                             <select class="form-select artistInsert" id="artistInsert" aria-label="Default select example">
                              <option selected value="0">Choose brand</option>
                                <?php
                                foreach($brand as $b):
                                ?>
                              <option value="<?=$b->id_brand?>"><?=$b->brand_name?></option>
                                <?php
                                  endforeach;
                                ?>
                            </select>
                    </div></td>
                </tr>
               
                <tr>
                  <td><input type="file" id="fileProducts" class="form-control-file"></td>
                  <td><a href="#" id="insertProduct">Insert</a></td> 
                </tr>
              </tbody>
      </table>
      </form>  
		  </div>
      </div>
      <!-- kraj inserta -->
		</div>
    </div>
<?php
  }
  include "includes/footerAdmin.php";
?>
