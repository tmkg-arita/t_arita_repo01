<?php

function xss($a){
    htmlspecialchars($a,ENT_QUOTES,'utf-8');
    
}


?>