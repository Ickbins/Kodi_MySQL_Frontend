<?php
function connect_db($database,$datahost,$username,$password) 
{ 
    $con= mysql_connect($datahost,$username,$password) or die(mysql_error()); 
    mysql_select_db($database,$con) or die(mysql_error());
}
function secondsToTimeDay($seconds,$lang) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    if($lang=='de') {
    return $dtF->diff($dtT)->format('%a Tage, %h Stunden und %i Minuten');
    } else {
    return $dtF->diff($dtT)->format('%a days, %h hours and %i minutes');
    }
}
function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%h:%i:00');
}
?>
