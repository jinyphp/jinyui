<?php

	function _ajax_script($class,$url){
		$script = "$.ajax({
            			url:'".$url."',
            			type:'post',
            			data:$('form').serialize(),
            			success:function(data){
            				$('".$class."').html(data);
            			}
        			});";
		return $script;
	}

    function _ajax_alert($class,$url,$msg){

        $script = "<script>
            alert(\"$msg\");
            $.ajax({
                url:'".$url."',
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('".$class."').html(data);
                }
            });
        <script>";
        return $script;
    }


?>