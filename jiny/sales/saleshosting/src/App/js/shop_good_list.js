$(function () {

    $(document).ready(function(){ 
        
    });
                        
    $('#listview').on('change',function(){
        good_list();
    });

    $('#cate_search').on('keydown',function(e){
                            
        if(e.keyCode == 13){
            e.preventDefault();
            good_list();
        }
                            
    });

    $('#btn_search').on('click',function(){
        alert("search");
        good_list();
    });

    function good_list(){
        //모든 웹페이지의 항목들이 로딩이 완료되었을때 처리해줄 내용
        $.ajax({
            url:'/ajax_goodlist.php',
            type:'post',
            data:$('form').serialize(),
            success:function(data){
                $('.mainbody').html(data);
            }
        })
    }

});


    function login(cate){
        var url = "login.php?call=cate_list&cate="+cate;
        document.location.href = url; // 로그인 주소 이동
    }


    function reseller_join(cate){
         alert("reseller_join " + cate);

    }

    function scm_login(cate){
         alert("scm_login " + cate);

    }

    function scm_goods(cate){
        var url = "./scm/scm_shop_goods_edit.php?cate="+cate+"&call=shop_list&call_id="+cate;
        alert(url);
        document.location.href = url; // 로그인 주소 이동

    }


