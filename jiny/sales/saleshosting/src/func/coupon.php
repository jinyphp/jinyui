<?php

	function _coupon_serialkey_gen($length){
        $length +=3;
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

        #str = "";
        $size = strlen($chars);
        for($i=0;$i<$length;$i++){
            if($i==5 || $i==11 || $i==17) $str .="-"; else $str .= $chars[ rand(0,$size-1) ];
        }

        return $str;
    }

    function _securekey_gen($length){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $size = strlen($chars);
        for($i=0,$str="";$i<$length;$i++){
            $str .= $chars[ rand(0,$size-1) ];
        }

        return $str;
    }

?>