<?php

function gen($b){
    if($b === 0){
        $b = "男性";

    }else{
        $b = "女性";
      
    }return $b;
}





function xss($a){
    htmlspecialchars($a,ENT_QUOTES,'utf-8');
    return $a;
}


?>