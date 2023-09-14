$(document).ready(function(){  
console.log("proba");


function ajaxCallBAck(url, method, data, result){
    $.ajax({
        url:url,
        method:method,
        dataType:"json",
        data:data,
        success:result,
        error:function(xhr){
            console.log(xhr);
        }
    });
}



$(document).ready(function(){
    $('#succ').css('display','none');
});


//REGISTRACIJA PROVERA
$(document).on('click','#register',function(e){
    e.preventDefault();
    console.log("PROSO");


    var ime = $("#first-Name");
    var prezime = $("#last-Name");
    var email = $("#emailAdd");
    var password = $("#pass");
    var rePassword = $("#rePass");

   // ime.focus().attr("placeholder", "");
    //mail.focus().attr("placeholder", "");
    
    let imeProvera = /^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/;
    let prezimeProvera = /^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/;
    let emailProvera = /^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    let passwordProvera = /^\w.{8,20}$/;

    var ispravno = true;

    function proveraReqEx(data,messgEmpty,messgWrong,regEx)
    {
        if(data.val() == '')
        {
            data.val('');
            data.attr('placeholder', messgEmpty);
            ispravno = false;
        }
        else if(regEx.test(data.val()))
        {
           ispravno = true;
        }
        else
        {
            data.val('');
            data.attr('placeholder', messgWrong);
            ispravno = false;
            //ime.val("");
            //ime.attr('placeholder', 'First name');
        }
    }

    if(password.val() == rePassword.val())
    {
        ispravno = true;
    }
    else
    {
        ispravno = false;
        password.attr('placeholder', 'Password dosen\'t match');
        rePassword.attr('placeholder', 'Password dosen\'t match');
    }

    proveraReqEx(ime,'First name can\'t be empty. ','You didn\'t fill your name correctly (eg. Chris). ',imeProvera);
    proveraReqEx(prezime,'Last name can\'t be empty. ','You didn\'t fill your last name correctly (eg. Prath). ',prezimeProvera);
    proveraReqEx(email,'Email can\'t be empty. ','You didn\'t fill your email correctly (eg. something@gmail.com). ',emailProvera);
    proveraReqEx(password,'Password is required ','You didn\'t fill your password correctly (eg. ABCdef123). ',passwordProvera);

    var imeVal = ime.val();
    var prezimeVal = prezime.val();
    var emailVal = email.val();
    var passwordVal = password.val();

    if(ispravno)
    {
        console.log("uspeh")
        $(document).ready(function(){
            $('#succ').css('display','block');
        });

        $.ajax({
            url:"models/register.php",
            method:'POST',
            dataType:'json',
            data:{
                'ime': imeVal,
                'prezime': prezimeVal,
                'email':emailVal,
                'password':passwordVal ,
                'btn':true      
               },
               success:function(data){
                    console.log("poslato");
                   // console.log(data)
                   //$("#success").html(data);
                   
               },
               error:function(xhr){
                    console.log("greska");
                   //$("#error").html(xhr.responseText);
                  
               }
        });        
    }
    else
    {
        $(document).ready(function(){
            $('#succ').css('display','none');
        });
    }
});



//LOGOVANJE PROVERA
$(document).ready(function(){
    $('#err').css('display','none');
});
$(document).on('click','#logIn',function(e){
    e.preventDefault(e);
    var ispravno = true;

    var email = $("#emailLog");
    var password = $("#passwordLog");

    let emailProveraLog = /^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;
    let passwordProveraLog = /^\w.{8,20}$/;

    function proveraReqEx(data,messgEmpty,messgWrong,regEx)
    {
        if(data.val() == '')
        {
            data.val('');
            data.attr('placeholder', messgEmpty);
            ispravno = false;
        }
        else if(regEx.test(data.val()))
        {
           ispravno = true;
        }
        else
        {
            data.val('');
            data.attr('placeholder', messgWrong);
            ispravno = false;
            //ime.val("");
            //ime.attr('placeholder', 'First name');
        }
    }

    proveraReqEx(email,'Email can\'t be empty. ','You didn\'t fill your email correctly (eg. something@gmail.com). ',emailProveraLog);
    proveraReqEx(password,'Password is required ','You didn\'t fill your password correctly (eg. ABCdef123). ',passwordProveraLog);

    var emailVal = email.val();
    var passwordVal = password.val();

    if(ispravno)
    {
        console.log("uspeh")
       // $(document).ready(function(){
      //      $('#err').css('display','none');
      //  });


        $.ajax({
            url:"models/login.php",
            method:'POST',
            dataType:'json',
            data:{
                'email':emailVal,
                'password':passwordVal ,
                'btn':true      
               },
               success:function(data){
                    console.log("poslato");
                    if(data == "You have successfully logged in!")
                    {
                        window.location.href="index.php";
                    }
                   
               },
               error:function(xhr){
                    console.log("greska");
                   //$("#error").html(xhr.responseText);
                  
               }
        });        
    }
    else
    {
       // console.log("uspeh")
      //  $(document).ready(function(){
       //     $('#err').css('display','block');
      //  });
    }
});

//funkcija za pretragu proizvoda

function writeProductsPag(arrayP){
    var html="";
    if(arrayP.length==0){
        html5+=`<div class="col-12">
        <div class="alert text-center mt-5">Sorry, we will be back in stock soon with new arrivals.</div>
        </div>`
    }
    else{
       for(var obj2 of arrayP){
           html+=`<a href="single.php"><div class="product-grid">
           <div class="more-product"><span> </span></div>						
           <div class="product-img b-link-stripe b-animate-go  thickbox productL" >
               <img src="${obj2.path}" class="img-responsive" alt="${obj2.alt}">
               <div class="b-wrapper">
               <h4 class="b-animate b-from-left  b-delay03">							
               <button><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Quick View</button>
               </h4>
               </div>
           </div></a>						
           <div class="product-info simpleCart_shelfItem">
               <div class="product-info-cust prt_name" >
                   <h4>${obj2.name}</h4>								
                   <span class="item_price">${obj2.price}$</span>
                   <input type="text" class="item_quantity" value="1" />
                   <input type="button" class="item_add items" value="ADD" id="buttonAdd" data-id="${obj2.id_product}" />
                   <div class="clearfix"> </div>
               </div>												
               
           </div>
       </div>	`
       }
    }
    $(".productss").html(html);
    //$('.addToCart').click(toCart);
}
    
function writeProduct(obj2)
{
    var  html=`<div class="col-md-7 single-top">	
					 <div class="flexslider">
						<ul class="slides">
							<li data-thumb="${obj2.path}">
								<div class="thumb-image"> <img src="${obj2.path}" data-imagezoom="true" class="img-responsive" alt="${obj2.alt}"/> </div>
							</li>
						</ul>
					</div>
				 </div>	
           <div class="col-md-5 single-top-in simpleCart_shelfItem">
           <div class="single-para ">
              <h4>${obj2.name}</h4>							
                 <h5 class="item_price">${obj2.price}$</h5>							
                 <p class="para">${obj2.description} </p>
                 <div class="prdt-info-grid">
                      <ul>
                          <li>- Brand : ${obj2.brand_name}</li>
                          <li>- Category : ${obj2.name_category}</li>
                      </ul>
                 </div>
                 <a href="#" class="add-cart item_add">ADD TO CART</a>							
          </div>
      </div>
      <div class="clearfix"> </div>	`
       
    
    $(".productss").html(html);
    //$(".product-price1").html(html);productss
    //$(".productss").html(html);productss
}

$(document).on("click", ".quickView", function(e){
    console.log("uso");
    e.preventDefault();
    let id = $(this).data('id');
    //var id = $(this).attr("data-idQ");
    var valueToSend={
        valueId:id
    };
    console.log(valueToSend);
    ajaxCallBAck("models/quickView.php", "post", valueToSend, function(result){
       
        writeProduct(result);
        //window.location.href="single.php";
        //console.log(result);
    });
});



function searchProducts(){
    var valueSearch=$(this).val().toLowerCase();
    var valueSearchToSend={
        valueS:valueSearch
    };
    ajaxCallBAck("models/search.php", "post", valueSearchToSend, function(result){
        writeProductsPag(result);
    });
}
$("#search").keyup(searchProducts);


function filterCat(){
    //console.log("uso");
    var valueCat=$("input[id='cat']:checked").val();
    //console.log(valueCat);
    var valueToSend={
        value:valueCat
    };
    ajaxCallBAck("models/filterCat.php", "post", valueToSend, function(result){
        writeProductsPag(result);
    });
}
$(".cat").change(filterCat);

//funckija za anketu
$(document).on('click','.send',function(e){
    e.preventDefault(e);
    console.log("uso");
    var logedIn=$("#logedIn").val();
    var idSurvey=this.dataset.id;
    var value=$("input[name='survey?"+idSurvey+"']:checked").val();

    var sendId = parseInt(idSurvey);
    console.log(sendId);
    var sendValue = parseInt(value);

   $.ajax({
    url:"models/survey.php",
    method:'POST',
    dataType:'json',
    data:{
        "id":idSurvey,
        "value":value,
        "user":logedIn    
       },
       success:function(result){
        console.log("success");
        alert(result);
        $('.survey').prop('checked', false);
           
       },
       error:function(xhr){
            console.log("greska");
            console.error(xhr);
           //$("#error").html(xhr.responseText);
          
       }
    });     
    
    
});




$(document).on("click", "#applyCupons", function(e)
{
    e.preventDefault(e);
    console.log("uso");
    alert("Soryy, this action is not currently available.");
});

//DOHVATANJE PODATAKA IZ LOCAL STORAGE

function LocalStorageDohvatanje(name){
    return JSON.parse(localStorage.getItem(name));
}
//console.log(LocalStorageDohvatanje("simpleCart_items"));
function LocalStorageUpis(name, data){
    localStorage.setItem(name, JSON.stringify(data));
}

function orderNow(id){
    //let id = $(this).data('id');
    var porudzbine = LocalStorageDohvatanje("productsCart");
    
    if(porudzbine){
        if(proizvodiVecUKorpi())
        {
            let porudzbineLS = LocalStorageDohvatanje("productsCart");
            for(let poruObj of porudzbineLS)
            {
                if(poruObj.id == id) 
                {
                    poruObj.quantity++;
                    break;
                }      
            }

            LocalStorageUpis("productsCart", porudzbineLS)
        } 
        else
        {
            dodavanjeLS();
            //orderNavBroj();
        }
    }
    else
    {
        dodavanjePrvogProizvoda();
        //orderNavBroj();
    }

    function dodavanjePrvogProizvoda(){
        let porudzbina = [];
        porudzbina[0] = {
            id : id,
            quantity : 1
        };

        
        LocalStorageUpis("productsCart", porudzbina);
        
    }

    function proizvodiVecUKorpi(){
        //console.log(porudzbine);
        return porudzbine.filter(p => p.id == id).length;      
    }


    function dodavanjeLS(){
        let hranaLS = LocalStorageDohvatanje("productsCart");
        hranaLS.push({
            id : id,
            quantity : 1
        });
        
        LocalStorageUpis("productsCart", hranaLS);
    }
    //console.log(porudzbine);
}
$(document).on("click", "#buttonAdd", function(e){
    console.log("uso");
    e.preventDefault();
    let id = $(this).data('id');
    orderNow(id);
});

$(document).on("click", ".simpleCart_empty", function(e){
    e.preventDefault();
    localStorage.removeItem("productsCart");
    location.reload();
    $("#cartWrite").html("<h2>Your order cart is empty</h2>");
});
console.log(LocalStorageDohvatanje("productsCart"));
//var slanjeZaPhp = LocalStorageDohvatanje("prductsCart")[0];
//console.log(slanjeZaPhp);

$.ajax({
    url:"models/getProducts.php",
    method:"get",
    dataType:"json",
    success:function(result){
        LocalStorageUpis("products", result);
    },
    error:function(xhr){
        console.log(xhr);
    }
});


if(document.URL.includes("checkout.php")){
    console.log("radiCart");
    var cartItems=LocalStorageDohvatanje("productsCart");
    console.log(cartItems);
    if(cartItems==null){
        $("#cartError").html("Your cart is empty - go back to shopping.");
    }
    else{
        checkCart();
        //console.log("jjb")
    } 

    function checkCart(){
        var productsC = LocalStorageDohvatanje("products");
        var cartItems=LocalStorageDohvatanje("productsCart");
        html8="";
        console.log(cartItems)
        for(var obj1 of cartItems){
            for(var obj2 of productsC){
            if(obj1.id == obj2.id_product)
            html8+= `
            <div class="close1"> </div>
            <div class="cart-sec simpleCart_shelfItem">
                        <div class="cart-item cyc">
                            <img src="${obj2.path}" class="img-responsive" alt="${obj2.alt}"/>
                        </div>
                        <div class="cart-item-info">
                        <h3><a href="single.php">${obj2.name}</a><span>Brand : ${obj2.brand_name}</span></h3>
                        <ul class="qty">
                            <li><p>Price : ${obj2.price}$</p></li>
                            <li><p>Quantity : ${obj1.quantity}</p></li>
                        </ul>
                        <div class="delivery">
                            <span>Delivered in 2-3 bussiness days</span>
                            <div class="clearfix"></div>
                        </div>								
                        </div>
                        <div class="clearfix"></div>
                                        
                    </div>`;
                    //console.log(obj.name)
        }
    }
        //console.log("mm")
        //console.log(html8);
        $("#cartWrite").html(html8);
    }
}
$(document).on("click", "#clearCart", function(e){
    e.preventDefault();
    localStorage.removeItem("productsCart");
    $("#cartWrite").html("<h2>Empty your cart!</h2>");    
});

function emptyCheckout()
{
    var ls = LocalStorageDohvatanje("productsCart");
    if(ls == null)
    {
        $("#cartWrite").html("<h2>Your order cart is empty!</h2>");
    }
}
emptyCheckout();


function alertFinish(e){
    e.preventDefault();
    //var cartItems=LocalStorageDohvatanje("productsCart");
    if(cartItems.length!=0){
        var idUser=$("#cartUser").val();
        var data={
            idUser:idUser
        };
        let cart;
        for(let i=0; i<cartItems.length; i++){
            cart="cart"+i;
            data[cart]=cartItems[i];
        }
        ajaxCallBAck("models/insertCart.php", "POST", data, function(result){
        alert(result);
        localStorage.removeItem("productsCart");
        location.reload();
        })    
    }
}
$("#order").click(alertFinish);

function disabled(){
    var html="";
    var session = $('#session').val();
   
    if(session=="0"){
       html+="disabled";
    }
    else{
        html+="";
    }
    return html;
}
///////

//ADMIN PANEL

     //funkcija za update admin profila
     if(document.URL.includes("admin.php")){

        $("#updateAdmin").click(updateAdmin);

        function updateAdmin(){
           var nameAdmin=$("#nameInputAdmin").val();
           var lastNameAdmin=$("#lastNameInputAdmin").val();
           var emailAdmin=$("#emailInputAdmin").val();
           var valid=true;
           if(nameAdmin=="" || lastNameAdmin=="" || emailAdmin==""){
               valid=false;
           }
           else{
               valid=true;
           }

           if(valid){
                var dataToSendA={
                    nameAdmin:nameAdmin,
                    lastNameAdmin:lastNameAdmin,
                    emailAdmin:emailAdmin
             }

            ajaxCallBAck("models/updateAdmin.php", "post", dataToSendA, function(result){
                alert(result);
                location.reload();
              });
           }
        }
    }

    // funckija za poruke(delete) i statistika ankete
    if(document.URL.includes("messageSurvey.php")){
        $(document).on("click", ".idDelete", function(e){
            e.preventDefault();
            var idMessage=$(this).attr("data-id");
            var idToSend={
                id:idMessage
            }
    
            ajaxCallBAck("models/deleteMessage.php", "post", idToSend, function(result){
               writeMsgAfterDelete(result);
             });
         })
         
         //delete poruke
         function writeMsgAfterDelete(arrayMsg){
             var html9="";
             var rb=1;
             html9+=`<table class="table">
             <thead>
               <tr>
                 <th scope="col">#</th>
                 <th scope="col">First Name</th>
                 <th scope="col">Last Name</th>
                 <th scope="col">Email</th>
                 <th scope="col">Message</th>
               </tr>
             </thead>
             <tbody>`;
             for(var obj9 of arrayMsg){
                 html9+=`<tr>
                 <th scope="row">${rb}</th>
                 <td>${obj9.name}</td>
                 <td>${obj9.email}</td>
                 <td>${obj9.phone}</td>
                 <td>${obj9.subject}</td>
                 <td>${obj9.datOfMessage}</td>
                 <td><a href="#" data-id="${obj9.id_message}" class="idDelete">Delete</a></td>
               </tr>`
               rb++;
             }
             html9+=`</tbody>
             </table>`;
             $("#messages").html(html9);
         }
    }

    //anketa
    ajaxCallBAck("models/getActivNoActiv.php", "get", {button:true}, function(result){
        var valueC;
        for(var obj16 of result){
            valueC=$("#chb"+obj16.idSurvey).val();
            if(obj16.idSurvey==valueC){
                if(obj16.activ==1){
                    $("#chb"+obj16.idSurvey).prop('checked', true);
                }
                else{
                    $("#chb"+obj16.idSurvey).prop('checked', false);
                }
            }
        }
    });

    $(document).on("click", ".activ", function(){
        var value=$(this).val();
        var check;
        if($('.activ').is(':checked')){
            console.log("da")
            check=1;
        }
        else{
            console.log("ne")
            check=0;
        }

        var dataToSendA={
            value:value,
            check:check
        }
        
        ajaxCallBAck("models/activeSurvey.php", "post", dataToSendA, function(result){
            alert(result);
        });
     })

    //funkcija za update admin profila
    if(document.URL.includes("adminPanel.php")){

        $("#updateAdmin").click(updateAdmin);

        function updateAdmin(){
           var nameAdmin=$("#nameInputAdmin").val();
           var lastNameAdmin=$("#lastNameInputAdmin").val();
           var emailAdmin=$("#emailInputAdmin").val();
           var valid=true;
           if(nameAdmin=="" || lastNameAdmin=="" || emailAdmin==""){
               valid=false;
           }
           else{
               valid=true;
           }

           if(valid){
                var dataToSendA={
                    nameAdmin:nameAdmin,
                    lastNameAdmin:lastNameAdmin,
                    emailAdmin:emailAdmin
             }

            ajaxCallBAck("modals/updateAdmin.php", "post", dataToSendA, function(result){
                alert(result);
                location.reload();
              });
           }
        }
    }

    //funckija za menu(delete, insert, update)
    if(document.URL.includes("menuTable.php")){
        //delete menu
        $(document).on("click", ".deleteMenu", function(e){
            e.preventDefault();
            var dataMenu=$(this).attr("data-id");
            var dataToSendM={
                dataMenu:dataMenu
            }

            ajaxCallBAck("models/deleteMenu.php", "post", dataToSendM, function(result){
                writeMenu(result);
            });
        })
        function writeMenu(arrayMenu){
            var html10="";
            html10+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_menu</th>
                <th scope="col">name_menu</th>
                <th scope="col">href_menu</th>
                <th scope="col">show_menu</th>
                <th scope="col">priority_menu</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj10 of arrayMenu){
                html10+=`<tr>
                <th scope="row">${obj10.id_menu}</th>
                <td><input type="text" id="nameMenu${obj10.id_menu}" class="form-control" value="${obj10.name_menu}"></td>
                <td><input type="text" id="hrefMenu${obj10.id_menu}" class="form-control" value="${obj10.path_m}"></td>
                <td><input type="text" id="showMenu${obj10.id_menu}" class="form-control" value="${obj10.display}"></td>
                <td><a href="#" data-id="${obj10.id_menu}" class="updateMenu">Update</a></td>
                <td><a href="#" data-id="${obj10.id_menu}" class="deleteMenu">Delete</a></td>
              </tr>`
            }
            html10+=` </tbody>
            </table`;
            $("#menu").html(html10);
        }
        //update menu
        $(document).on("click", ".updateMenu", function(e){
            e.preventDefault();
            var dataMenu=$(this).attr("data-id");
            var nameMenu=$("#nameMenu"+dataMenu).val();
            var hrefMenu=$("#hrefMenu"+dataMenu).val();
            var showMenu=$("#showMenu"+dataMenu).val();
            //var priorityMenu=$("#priorityMenu"+dataMenu).val();

            var dataToSendM={
                dataMenu:dataMenu,
                nameMenu:nameMenu,
                hrefMenu:hrefMenu,
                showMenu:showMenu,
                //priorityMenu:priorityMenu
            }

            ajaxCallBAck("models/updateMenu.php", "post", dataToSendM, function(result){
                writeMenu(result);
              });
        })
        //insert menu
        $(document).on("click", "#insertMenu", function(e){
           e.preventDefault();
           var nameMenu=$("#nameMenu").val();
           var hrefMenu=$("#hrefMenu").val();
           var showMenu=$("#showMenu").val();
           //var priorityMenu=$("#priorityMenu").val();
           var valid=true;

           if(nameMenu=="" || hrefMenu=="" || showMenu==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendM={
                    nameMenu:nameMenu,
                    hrefMenu:hrefMenu,
                    showMenu:showMenu,
                    //priorityMenu:priorityMenu
                }
            }
           
        ajaxCallBAck("models/insertMenu.php", "post", dataToSendM, function(result){
            alert(result);
            location.reload();
        });

        })
    }

    //funckija za category(delete, insert, update)
    if(document.URL.includes("categoryTable.php")){
        //delete category
        $(document).on("click", ".deleteCategory", function(e){
            e.preventDefault();
            var dataCat=$(this).attr("data-id");
            var dataToSendC={
                dataCat:dataCat
            }

            ajaxCallBAck("models/deleteCategory.php", "post", dataToSendC, function(result){
                writeCategory(result);
            });
        })
        function writeCategory(arrayCat){
            var html11="";
            html11+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_cat</th>
                <th scope="col">name_cat</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj11 of arrayCat){
                html11+=` <tr>
                <th scope="row">${obj11.id_category}</th>
                <td><input type="text" id="nameCategory${obj11.id_category}" class="form-control" value="${obj11.name_category}"></td>
                <td><a href="#" data-id="${obj11.id_category}" class="updateCategory">Update</a></td>
                <td><a href="#" data-id="${obj11.id_category}" class="deleteCategory">Delete</a></td>
              </tr>`
            }
            html11+=` </tbody>
            </table`;
            $("#category").html(html11);
        }
        //update category
        $(document).on("click", ".updateCategory", function(e){
            e.preventDefault();
            var dataCategory=$(this).attr("data-id");
            var nameCategory=$("#nameCategory"+dataCategory).val();

            var dataToSendC={
                dataCategory:dataCategory,
                nameCategory:nameCategory,
            }

            ajaxCallBAck("models/updateCategory.php", "post", dataToSendC, function(result){
                writeCategory(result);
              });
        })
        //insert category
        $(document).on("click", "#insertCategory", function(e){
           e.preventDefault();
           var nameCategory=$("#nameCategory").val();
           var valid=true;

           if(nameCategory==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendC={
                    nameCategory:nameCategory,
                }
            }
           
        ajaxCallBAck("models/insertCategory.php", "post", dataToSendC, function(result){
            alert(result);
            location.reload();
        });

        })
    }

    //funckija za artist(delete, insert, update)
     if(document.URL.includes("brandTable.php")){
        //delete brand
        $(document).on("click", ".deleteArtist", function(e){
            e.preventDefault();
            var dataBrand=$(this).attr("data-id");
            var dataToSendA={
                dataBrand:dataBrand
            }

            ajaxCallBAck("models/deleteBrand.php", "post", dataToSendA, function(result){
                writeArtist(result);
            });
        })
        function writeArtist(arrayBrand){
            var html12="";
            html12+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_cat</th>
                <th scope="col">name_cat</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj12 of arrayBrand){
                html12+=` <tr>
                <th scope="row">${obj12.id_brand}</th>
                <td><input type="text" id="nameArtist${obj12.name_category}" class="form-control" value="${obj12.brand_name}"></td>
                <td><a href="#" data-id="${obj12.id_brand}" class="updateArtist">Update</a></td>
                <td><a href="#" data-id="${obj12.id_brand}" class="deleteArtist">Delete</a></td>
              </tr>`
            }
            html12+=` </tbody>
            </table`;
            $("#artist").html(html12);
        }
        //update brand
        $(document).on("click", ".updateArtist", function(e){
            e.preventDefault();
            var dataArtist=$(this).attr("data-id");
            var nameArtist=$("#nameArtist"+dataArtist).val();
            var dataToSendA={
                dataArtist:dataArtist,
                nameArtist:nameArtist,
            }

            ajaxCallBAck("models/updateBrand.php", "post", dataToSendA, function(result){
                writeArtist(result);
              });
        })
        //insert brand
        $(document).on("click", "#insertArtist", function(e){
           e.preventDefault();
           var nameArtist=$("#nameArtist").val();
           var valid=true;

           if(nameArtist==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendA={
                    nameArtist:nameArtist,
                }
            }
           
        ajaxCallBAck("models/insertBrand.php", "post", dataToSendA, function(result){
            alert(result);
            location.reload();
        });

        })
    }

    //funckija za price(insert)
    if(document.URL.includes("priceTable.php")){
        //update price
        $(document).on("click", ".updatePrice", function(e){
            e.preventDefault();
            var dataPrice=$(this).attr("data-id");
            var priceOld=$("#priceOld"+dataPrice).val();
            //var priceNow=$("#priceNow"+dataPrice).val();
            var dataToSendP={
                dataPrice:dataPrice,
                priceOld:priceOld,
            }

            ajaxCallBAck("models/updatePrice.php", "post", dataToSendP, function(result){
                alert(result);
            });
        })
    }

    //funckija za usere(delete)
    if(document.URL.includes("usersTable.php")){
        //delete artist
        $(document).on("click", ".deleteUser", function(e){
            e.preventDefault();
            var dataUser=$(this).attr("data-id");
            var dataToSendU={
                dataUser:dataUser
            }

            ajaxCallBAck("models/deleteUser.php", "post", dataToSendU, function(result){
                writeUsers(result);
            });
        })

        function writeUsers(arrayUsers){
            var html13="";
            html13+=`<table class="table"> 
            <thead>
              <tr>
              <th scope="col">id_user</th>
              <th scope="col">name</th>
              <th scope="col">last name</th>
              <th scope="col">email</th>
              <th scope="col">role</th>
              <th scope="col">time</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj13 of arrayUsers){
                html13+=` <tr>
                <th scope="row">${obj13.id_user}</th>
                <td id="nameUser${obj13.id_user}">${obj13.firstName}</td>
                <td id="lastNameUser${obj13.id_user}">${obj13.lastName}</td>
                <td id="emailUser${obj13.id_user}">${obj13.email}</td>
                <td id="roleUser${obj13.id_user}">${obj13.role_name}</td>
                <td id="timeUser${obj13.id_user}">${obj13.dateOfRegistration}</td>
                <td><a href="#" data-id="${obj13.id_user}" class="updateUser">Update role</a></td>
                <td><a href="#" data-id="${obj13.id_user}" class="deleteUser">Delete</a></td>
                </tr>`
            }
            html13+=` </tbody>
            </table`;
            $("#users").html(html13);
        }
    }

    //funckija za roles(delete, insert, update)
    if(document.URL.includes("rolesTable.php")){
        //delete role
        $(document).on("click", ".deleteRole", function(e){
            e.preventDefault();
            var dataRole=$(this).attr("data-id");
            var dataToSendR={
                dataRole:dataRole
            }

            ajaxCallBAck("models/deleteRole.php", "post", dataToSendR, function(result){
               writeRoles(result);
            });
        })
        function writeRoles(arrayRoles){
            var html13="";
            html13+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_roles</th>
                <th scope="col">role</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj13 of arrayRoles){
                html13+=`<tr>
                <th scope="row">${obj13.id_role}</th>
                <td><input type="text" id="nameRole${obj13.id_role}" class="form-control" value="${obj13.role_name}"></td>
                <td><a href="#" data-id="${obj13.id_role}" class="updateRole">Update</a></td>
                <td><a href="#" data-id="${obj13.id_role}" class="deleteRole">Delete</a></td>
              </tr>`
            }
            html13+=` </tbody>
            </table`;
            $("#roles").html(html13);
        }
        //update role
        $(document).on("click", ".updateRole", function(e){
            e.preventDefault();
            var dataRole=$(this).attr("data-id");
            var nameRole=$("#nameRole"+dataRole).val();
            var dataToSendR={
                dataRole:dataRole,
                nameRole:nameRole,
            }

            ajaxCallBAck("models/updateRoleUser.php", "post", dataToSendR, function(result){
                writeRoles(result);
            });
        })
        //insert role
        $(document).on("click", "#insertRole", function(e){
           e.preventDefault();
           var nameRole=$("#nameRole").val();
           var valid=true;

           if(nameRole==""){
               valid=false;
            }
           else{
               valid=true;
            }

            if(valid){
                var dataToSendR={
                    nameRole:nameRole,
                }
            }
           
        ajaxCallBAck("models/insertRole.php", "post", dataToSendR, function(result){
            alert(result);
            location.reload();
        });
        })
    }

    //funckija za products(delete, insert, update)
    if(document.URL.includes("productsTable.php")){
        //delete product
        $(document).on("click", ".deleteProduct", function(e){
            e.preventDefault();
            var dataProduct=$(this).attr("data-id");
            var dataToSendP={
                dataProduct:dataProduct
            }

            ajaxCallBAck("models/deleteProduct.php", "post", dataToSendP, function(result){
                writeProducts(result.products, result.cat);
            });
        })
        function writeProducts(arrayProducts, arrayCat){
            var html14="";
            html14+=`<table class="table"> 
            <thead>
              <tr>
                <th scope="col">id_products</th>
                <th scope="col">name_products</th>
                <th scope="col">picture_src</th>
                <th scope="col">change src</th>
                <th scope="col">name_cat</th>
                <th scope="col">delivery</th>
                <th scope="col">name_artist</th>
              </tr>
            </thead>
            <tbody>`;
            for(var obj14 of arrayProducts){
                html14+=`  <tr>
                <th scope="row">${obj14.id_product}</th>
                <td><input type="text" id="nameProducts${obj14.id_product}" class="form-control" value="${obj14.name}"></td>
                <td><input type="text" id="srcProducts${obj14.id_product}" class="form-control" value="${obj14.path}" disabled></td>
                <td><input type="file" id="fileProducts${obj14.id_product}" class="form-control-file"></td>
                <td>
                    <div class="form-group">
                           <select class="form-select product${obj14.id_product}" aria-label="Default select example">
                            <option selected value="${obj14.id_category}">${obj14.name_category}</option>`
                for(var obj15 of arrayCat){
                    html14+=`<option value="${obj15.id_category}">${obj15.name_category}</option>`
                }
                html14+=` </select>
                </div>
                </td>
                <td><input type="number" id="deliveryProducts${obj14.id_product}" class="form-control" value="${obj14.description}"></td>
                <td><input type="text" id="artistProducts${obj14.id_product}" class="form-control" value="${obj14.brand_name}" disabled></td>
                <td><a href="#" data-id="${obj14.id_product}" class="updateProduct">Update</a></td>
                <td><a href="#" data-id="${obj14.id_product}" class="deleteProduct">Delete</a></td>
              </tr>`
            }
            html14+=` </tbody>
            </table`;
            $("#productss").html(html14);
        }
        //update products
        $(document).on("click", ".updateProduct", function(e){
            e.preventDefault();
            var dataProducts=$(this).attr("data-id");
            var nameProducts=document.getElementById("nameProducts"+dataProducts).value;
            // var catValue=getItemFromLocalStorage("catValue");
            // var catValue=document.getElementById("product").value;
            var catValue=$(".product"+dataProducts).val();
            console.log(catValue)
            var delivery=document.getElementById("deliveryProducts"+dataProducts).value;
            var filePicture=document.getElementById("fileProducts"+dataProducts).files[0];
            var srcProducts=document.getElementById("srcProducts"+dataProducts).value;
            var picture;
            var valid=true;

            if(nameProducts==""){
                valid=false;
            }
            else{
                valid=true;
            }   
            if(filePicture==undefined){
                picture=srcProducts;
            }
            else{
                picture=filePicture;
            } 

            if(valid){
                var dataToSend=new FormData();
                dataToSend.append("dataProducts",dataProducts) 
                dataToSend.append("nameProducts",nameProducts) 
                dataToSend.append("catValue",catValue) 
                dataToSend.append("delivery",delivery) 
                dataToSend.append("filePicture",picture) 
               }

               $.ajax({
                url:"modals/updateProduct.php",
                method:"post",
                dataType:"json",
                data:dataToSend,
                processData:false,
                contentType:false,
                success:function(result){
                    alert(result.msg);
                    writeProducts(result.products, result.cat);
                    localStorage.removeItem("catValue");
                },
                error:function(xhr){
                   console.log(xhr);
                }
            });
        })

        $(document).on("change", "#catInsert", function(){
            var catValueInsert=document.getElementById("catInsert").value;
            LocalStorageUpis("catValueInsert", catValueInsert);
        })
        $(document).on("change", "#priceInsert", function(){
            var priceValueInsert=document.getElementById("priceInsert").value;
            LocalStorageUpis("priceValueInsert", priceValueInsert);
        })
        $(document).on("change", "#artistInsert", function(){
            var artistValueInsert=document.getElementById("artistInsert").value;
            LocalStorageUpis("artistValueInsert", artistValueInsert);
        })
        //insert product
        $(document).on("click", "#insertProduct", function(e){
           e.preventDefault();
           var nameProduct=document.getElementById("nameProduct").value;
           var descProduct=document.getElementById("descProduct").value;
           //var catValue=LocalStorageDohvatanje("catValueInsert").value;
           //var priceValue=LocalStorageDohvatanje("priceInsert").value;
           //var brandValue=LocalStorageDohvatanje("artistInsert").value;
           var catValue=document.getElementById("catInsert").value;
           var priceValue=document.getElementById("priceInsert").value;
           var brandValue=document.getElementById("artistInsert").value;

           var filePicture=document.getElementById("fileProducts").files[0];
           var valid=true;

           if(nameProduct=="" || descProduct ==""){
               valid=false;
                if(catValue=="0" || brandValue=="0" || priceValue=="0"){
                    valid=false;
                }
                else{
                    valid=true;
                }
            }
            else{
                valid=true;            
            }
           
           if(valid){
            var dataToSendP=new FormData();
            dataToSendP.append("filePicture",filePicture) 
            dataToSendP.append("nameProduct",nameProduct) 
            dataToSendP.append("descProduct",descProduct) 
            dataToSendP.append("priceValue",priceValue) 
            dataToSendP.append("catValue",catValue) 
            dataToSendP.append("brandValue",brandValue) 
           }
               
           $.ajax({
            url:"models/insertProduct.php",
            method:"post",
            dataType:"json",
            data:dataToSendP,
            processData:false,
            contentType:false,
            success:function(result){
                alert(result);
            location.reload();
            localStorage.removeItem("catValueInsert");
            localStorage.removeItem("artistValueInsert");
            },
            error:function(xhr){
                console.log(xhr);
            }
        });
        })
    }
    







});