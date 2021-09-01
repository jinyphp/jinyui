<?php
$javascript = "<script>
function mode(mode,uid,limit){
var url = \"ajax_".$_tableName."_editup.php\";
var form = document.sales;
form.action = url;  //이동할 페이지
form.mode.value = mode;
form.uid.value = uid;
form.limit.value = limit;
ajax_html('#mainbody',url);         	
}

function edit(mode,uid,limit){
var url = \"".$_tableName."_edit.php\";		
var form = document.sales;
form.action = url;  //이동할 페이지
form.mode.value = mode;
form.uid.value = uid;
form.limit.value = limit;
form.submit();	
}

function list(limit){
var url = \"ajax_".$_tableName.".php\";
var form = document.sales;
form.limit.value = limit;
alert(limit);
ajax_html('#mainbody',url);
}

// 상단버튼
$('#check_all').on('click',function(){
trans_chkall();
});	

function trans_chkall(){
var submit = false;
var chk = document.getElementsByName('TID[]');
       				
for(var i=0;i<chk.length;i++){
if(document.sales.chk_all.checked == true) chk[i].checked = true;
else chk[i].checked = false;
}
} 

// 리스트 변경
$('#list_num').on('change',function(){
list(0);
});

// 국가
$('#country').on('change',function(){
list(0);
});
                
</script>";

?>