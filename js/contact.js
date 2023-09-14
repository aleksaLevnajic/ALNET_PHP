console.log("proba");


let obradaForme = [];
let dugme = $('#submitContact');

//$(document).ready(function(){
//    $('#spanSuccess').css('display','none');
//});
$(document).ready(function(){
    $('#succ').css('display','none');
});

$(document).on('click','#submitContact',function(e){
    e.preventDefault();
    console.log("PROSO");

    var ispravno = true;

    let ime = $('#name');
    let mail = $('#email');
    let mobile = $('#mobile');
    let subject = $('#subject');

    ime.focus().attr("placeholder", "");
    mail.focus().attr("placeholder", "");
    
    let imeProvera = /^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/;
    let emailProvera = /^\w[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/;    
    let mobileProvera = /^(\+\d{1,3}[- ]?)?\d{10}$/;
    let subjectProvera = /^[\w\d\s.]{5,150}$/;

    //IME
    if(ime.val() == '')
    {
        ime.val('');
        ime.attr('placeholder', 'First name can\'t be empty. ');
        ispravno = false;
    }
    else if(imeProvera.test(ime.val()))
    {
        //obradaForme.push(ime.val());    
        var imeVal = ime.val();
        ispravno = true;
    }
    else
    {
        ispravno = false;
        ime.val('');
        ime.attr('placeholder', 'You didn\'t fill yor name correctly (eg. Chris). ');
        //ime.val("");
        //ime.attr('placeholder', 'First name');
    }
    //EMAIL
    if(mail.val() == "")
    {
        mail.val('');
        mail.attr('placeholder', 'Email is requierd');
        ispravno = false;
    }
    else if(emailProvera.test(mail.val()))
    {   
        //obradaForme.push(mail.val());   
        var emailVal = mail.val();
        ispravno = true;      
    }
    else
    {
        mail.val('');
        mail.attr('placeholder', 'Fill your email correctly (eg. something@gmail.com). ');
        mail.addClass("error");
        ispravno = false;
    }
    //MOBILNI
    if(mobile.val() == '')
    {
        mobile.val('');
        mobile.attr('placeholder', 'Mobile can\'t be empty. ');
        ispravno = false;
    }
    else if(mobileProvera.test(mobile.val()))
    {
        //obradaForme.push(mobile.val());   
        var telefonVal = mobile.val(); 
        ispravno = true;
    }
    else
    {
        mobile.val('');
        mobile.attr('placeholder', 'You didn\'t fill yor mobile correctly (eg. +912 8087339090 or 8087339090). ');
        ispravno = false;
        //ime.val("");
        //ime.attr('placeholder', 'First name');
    }
    //SUBJECT
    if(subject.val() == '')
    {
        subject.val('');
        subject.attr('placeholder', 'Write a message to administrator. ');
        ispravno = false;
    }
    else if(subjectProvera.test(subject.val()))
    {
        //obradaForme.push(subject.val());    
        var subjectVal = subject.val();
        ispravno = true;
    }
    else
    {
        subject.val('');
        subject.attr('placeholder', 'Subject field is limited(5-150 characters).');
        ispravno = false;
        //ime.val("");
        //ime.attr('placeholder', 'First name');
    }




    
    


    //ZA PRIKAZIVANJE SPAN TAGA
    if(ispravno)
    {
        $(document).ready(function(){
            $('#succ').css('display','block');
        });

        $.ajax({
            url:"models/message.php",
            method:'POST',
            dataType:'json',
            data:{
                'ime':imeVal,
                'email':emailVal,
                'phone':telefonVal,
                'subject':subjectVal,
                'btn':true      
               },
               success:function(data){
                    console.log("poslato");
                    $(document).ready(function(){
                        $('#spanSuccsess').html('<p>Your message nas been sent. We will contact you as soon as possible!</p>')
                   });
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
       // $(document).ready(function(){
       //     $('#spanSuccess').css('display','none');
       // });
       $(document).ready(function(){
        $('#succ').css('display','none');
    });
    
    }
});