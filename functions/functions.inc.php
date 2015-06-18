<?php
function connect_db($database,$datahost,$username,$password) 
{ 
    $con= mysql_connect($datahost,$username,$password) or die(mysql_error()); 
    mysql_select_db($database,$con) or die(mysql_error());
}
function secondsToTime($seconds,$text) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format($text);
}
?>
