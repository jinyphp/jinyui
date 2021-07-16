$(function () {

    // Cart Loading...
    $(document).ready(function(){ 
       
    });




});

function wish_delete(){
    alert("delete");
    // document.wish.action = "wish.php";
    document.wish.mode.value = "delete";
    // document.wish.submit(); 

     $.ajax({
        url:'./ajax_wish.php',
        type:'post',
        data:$('form').serialize(),
        success:function(data){
            $('#wish_list').html(data);
        }
    });

} 



