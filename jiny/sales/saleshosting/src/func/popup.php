<?php

	function _popup_title($title,$width){
        $bgcolor = "#16a086";
        $font_color = "#ffffff";

        $style = "style='border-bottom:1px solid #E9E9E9;font-size:15px;padding:10px;color:$font_color;'";
        $html = "<table border=\"0\" width=\"$width\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"$bgcolor\" id=\"popup_headTitle\">
                <tr>
                <td $style><b>$title</b></td>
                <td $style width=\"10\"><span id=\"popup_close\">X</span></td>
                </tr>
                </table>";
        return $html;
    }

    function _popup_body($title,$width,$body){
        $html = _popup_title($title,$width);
        $html .= $body;
        return $html;
    }


?>