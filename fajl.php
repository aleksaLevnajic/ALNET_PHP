<?php
   include("../config/connection.php");
   //include "config/connection.php";
   
   function redirect($path)
    {
        header("Location: $path");
    }
    
    function getSingleProduct($id)
    {
        global $conn;
        try{
            $upit="SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
             JOIN picture pi ON pi.id_picture = p.id_picture WHERE id_product=$id";
            $data=$conn->query($upit)->fetchAll();
            return $data;
            
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }
    function getProducts(){
        global $conn;
        try{
            $upit="SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
             JOIN picture pi ON pi.id_picture = p.id_picture";
            $data=$conn->query($upit)->fetchAll();
            return $data;
            
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }
    function getCategories()
    {
        global $conn;
        try{
            $upit = "SELECT * FROM category";
            $data = $conn->query($upit)->fetchAll();
            return $data;
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }
    function getBrands()
    {
        global $conn;
        try{
            $upit = "SELECT * FROM brand";
            $data = $conn->query($upit)->fetchAll();
            return $data;
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }



    //ANKETA
    function surveyQuestion(){
        global $conn;
        try{
            $upit="SELECT * FROM survey WHERE active=1";
            $result=$conn->query($upit)->fetchAll();
            //var_dump($result);
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function surveyAnswer(){
        global $conn;
        try{
            $upit="SELECT * FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey";
            $result=$conn->query($upit)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function alreadyAnswered($id, $user){
        global $conn;

        try{
            $upit="SELECT * FROM surveyvotes v INNER JOIN answer a ON v.id_answer=a.id_answer WHERE v.id_user=:user AND a.id_survey=:id";
            $send=$conn->prepare($upit);
            $send->bindParam(":user", $user);
            $send->bindParam(":id", $id);

            $send->execute();
            $result=$send->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function sendSurvey($value, $user){
        global $conn;
        var_dump($conn);
        try{
            $upit="INSERT INTO surveyvotes (id_user, id_answer) VALUES(:idU, :idA)";
            $send=$conn->prepare($upit);
            $send->bindParam(":idU", $user);
            $send->bindParam(":idA", $value);

            $result= $send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function proveraRegEx($input, $regEx)
        {
            if($input = "")
            {
                $ispravno = false;
                $message = "Error occurred while data was processed. Try again.";
                $statusCode = 500;
            }
            else if(!preg_match($regEx, $input))
            {
                $ispravno = false;
                $message = "Error occurred while data was processed. Try again.";
                $statusCode = 500;
            }
        }

////////
    function getAdmin(){
        global $conn;

        try{
            $query="SELECT * FROM user WHERE id_role=1";
            $result=$conn->query($query)->fetch();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

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

    ///////////
    function messagesReturn(){
        global $conn;

        try{
            $query="SELECT * FROM messagecontact";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    ////////
    function catchAnswer($id){
        global $conn;

        try{
            $query="SELECT a.* FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey WHERE s.id_survey=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $result=$send->execute();
            $result=$send->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }
    ////////
    function catchSurvey($id){
        global $conn;

        try{
            $query="SELECT s.id_survey FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey WHERE a.id_answer=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }
    ////////
    function countAllS($idS){
        global $conn;

        try{
            $query="SELECT COUNT(v.id_answer) as surv FROM survey s INNER JOIN answer a ON s.id_survey=a.id_survey
             INNER JOIN surveyvotes v ON v.id_answer=a.id_answer WHERE s.id_survey=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $idS);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;
        }

        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }
    ////////
    function countAll($id){
        global $conn;

        try{
            $idS=catchSurvey($id);
            $idS=$idS->id_survey;
            $countAllS=countAllS($idS);
            $countAlls=$countAllS->surv;
            $query="SELECT ROUND((SELECT COUNT(v.id_answer) FROM surveyvotes v INNER JOIN 
            answer a ON v.id_answer=a.id_answer WHERE v.id_answer=:id)/:countAlls*100)
            as numb";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $send->bindParam(":countAlls", $countAlls);
            $result=$send->execute();
            $result=$send->fetch();
            return $result;

        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

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

    function usersAll(){
        global $conn;
    
        try{
            $query="SELECT * FROM user u INNER JOIN roles r ON u.id_role=r.id_role";
            $products=$conn->query($query)->fetchAll();
            return $products;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function delete($table, $column, $id){
        global $conn;
        
        try{
            $query="DELETE FROM $table WHERE $column=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            $message="Server error";
        }
    }

    function deleteMenu($dataMenu){
        global $conn;
        
        try{
            $query="DELETE FROM menu WHERE id_menu=:menu";
            $send=$conn->prepare($query);
            $send->bindParam(":menu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function deleteMessage($idMessage){
        global $conn;
        
        try{
            $query="DELETE FROM messagecontact WHERE id_message=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $idMessage);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

     function messagesReturn(){
        global $conn;

        try{
            $query="SELECT * FROM messagecontact";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function filterCat($id){
        global $conn;

        try{
            $query="SELECT * FROM product p INNER JOIN category c ON p.id_category=c.id_category
            INNER JOIN brand b ON p.id_brand=b.id_brand INNER JOIN price pr ON p.id_price=pr.id_price
             WHERE c.id_category=:id";
            $send=$conn->prepare($query);
            $send->bindParam(":id", $id);
            $send->execute();
            $result=$send->fetchAll();
            return $result;

        }
        catch(PDOException $e){
            $message="Server error";
        }
    
    }

    function insertBrand($nameBrand){
        global $conn;
        
        try{
            $query="INSERT INTO brand(id_brand, brand_name) VALUES(NULL, :nameBrand)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameBrand", $nameBrand);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function insertUser($idUser){
        global $conn;
        
        try{
            $query="INSERT INTO finishshopping(id_finishshop, id_user) VALUES(NULL, :idUser)";
            $send=$conn->prepare($query);
            $send->bindParam(":idUser", $idUser);

            $result=$send->execute();
            if($result){
                $lastId=$conn->lastInsertId();
                return $lastId;
            }
            else{
                return $result;
            }
           
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }


    function insertToCart($insertUser, $quantity, $idProducts){
        global $conn;
        
        try{
            $query="INSERT INTO cart(id_cart, id_finishshop, id_product, quantity) VALUES(NULL, :insertUser, :idProducts, :quantity)";
            $send=$conn->prepare($query);
            $send->bindParam(":insertUser", $insertUser);
            $send->bindParam(":idProducts", $idProducts);
            $send->bindParam(":quantity", $quantity);


            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function insertCategory($nameCategory){
        global $conn;
        
        try{
            $query="INSERT INTO category(id_category, name_category) VALUES(NULL, :nameCategory)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function insertMenu($nameMenu, $hrefMenu, $showMenu){
        global $conn;
        
        try{
            $query="INSERT INTO menu(id_menu, name_menu, path_m, display) VALUES(NULL, :nameMenu, :path_m, :display)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":path_m", $hrefMenu);
            $send->bindParam(":display", $showMenu);
            //$send->bindParam(":priorityMenu", $priorityMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function insertRole($nameRole){
        global $conn;
        
        try{
            $query="INSERT INTO roles(id_role, role_name) VALUES(NULL, :nameRole)";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function getSingleProduct($id)
    {
        global $conn;
        try{
            $upit="SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
             JOIN picture pi ON pi.id_picture = p.id_picture WHERE id_product=$id";
            $data=$conn->query($upit)->fetch();
            return $data;
            
        }
        catch(PDOException $e){
            $data="Error";
            $code=500;
        }
    }

    function search($valueS){
        global $conn;

        try{
            $query="SELECT * FROM product p INNER JOIN category c ON p.id_category=c.id_category INNER JOIN brand b ON p.id_brand=b.id_brand
             INNER JOIN price r ON p.id_price=r.id_price INNER JOIN picture pc ON p.id_picture=pc.id_picture
              WHERE p.name LIKE '%$valueS%' OR b.brand_name LIKE '%$valueS%'";
            $result=$conn->query($query)->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        }
    }

    function updateBrand($dataBrand, $nameBrand){
        global $conn;

        try{
            $query="UPDATE brand SET brand_name = :nameBrand WHERE id_brand=:dataBrand";
            $send=$conn->prepare($query);
            $send->bindParam(":nameBrand", $nameBrand);
            $send->bindParam(":dataBrand", $dataBrand);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function updateCategory($dataCategory, $nameCategory){
        global $conn;

        try{
            $query="UPDATE category SET name_category = :nameCategory 
            WHERE id_category=:dataCategory";
            $send=$conn->prepare($query);
            $send->bindParam(":nameCategory", $nameCategory);
            $send->bindParam(":dataCategory", $dataCategory);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function updateMenu($dataMenu, $nameMenu, $hrefMenu, $showMenu){
        global $conn;

        try{
            $query="UPDATE menu SET name_menu = :nameMenu, path_m = :hrefMenu, display = :showMenu 
            WHERE id_menu=:dataMenu";
            $send=$conn->prepare($query);
            $send->bindParam(":nameMenu", $nameMenu);
            $send->bindParam(":hrefMenu", $hrefMenu);
            $send->bindParam(":showMenu", $showMenu);
            $send->bindParam(":dataMenu", $dataMenu);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function updatePrice($dataPrice, $price){
        global $conn;

        try{
            $query="UPDATE price SET price = :price WHERE id_price=:dataPrice";
            $send=$conn->prepare($query);
            $send->bindParam(":price", $price);
            $send->bindParam(":dataPrice", $dataPrice);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function updateProduct($dataProducts, $nameProducts, $catValue, $description, $brand, $name){
        global $conn;

        try{
            $query="UPDATE product SET name = :nameProducts, description = :descriptionn, id_category = :catValue, id_brand = :brandValue,
             path=:name WHERE id_product=:dataProduct";
            $send=$conn->prepare($query);
            $send->bindParam(":nameProducts", $nameProducts);
            //$send->bindParam(":name", $name);
            $send->bindParam(":catValue", $catValue);
            $send->bindParam(":descriptionn", $description);
            $send->bindParam(":brand", $description);
            $send->bindParam(":dataProducts", $dataProducts);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message=$e->getMessage();
            echo $e->getMessage();
        } 
    }

    function updateRoleUser($dataRole, $nameRole){
        global $conn;

        try{
            $query="UPDATE roles SET role_name = :nameRole WHERE id_role=:dataRole";
            $send=$conn->prepare($query);
            $send->bindParam(":nameRole", $nameRole);
            $send->bindParam(":dataRole", $dataRole);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }

    function updateRole($dataUser, $role){
        global $conn;

        try{
            $query="UPDATE user SET id_role = :dataId WHERE id_user=:dataUser";
            $send=$conn->prepare($query);
            $send->bindParam(":dataId", $role);
            $send->bindParam(":dataUser", $dataUser);

            $result=$send->execute();
            return $result;
        }
        catch(PDOException $e){
            $message="Server error";
        } 
    }


?>