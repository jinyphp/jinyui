$(function () {

    // Cart Loading...
    $(document).ready(function(){ 

    });

});

function cart_delete(){
    //document.cart.action = "./cart.php";
    document.cart.mode.value = "delete";
    // document.cart.submit();
    $.ajax({
        url:'/ajax_cart.php',
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $('.mainbody').html(data);
        }
    });                             
} 

function cart_remove(uid){
    document.cart.mode.value = "remove";
    document.cart.UID.value = uid;
    
    $.ajax({
        url:'/ajax_cart.php',
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $('.mainbody').html(data);
        }
    });                           
} 


function cart_seller(seller){
    document.cart.seller.value = seller;
    document.cart.action = "./orders.php";
    document.cart.submit();                             
}   

function cart_order(){
    $.ajax({
        url:'/ajax_ordernow.php?mode=cart',
        type:'post',
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $('.mainbody').html(data);
        }
    });                          
} 


function cart_num(uid){
    document.cart.mode.value = "change";
    document.cart.UID.value = uid;
    alert("change");
    $.ajax({
        url:'/ajax_cart.php',
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $('.mainbody').html(data);
        }
    });

                         
}
