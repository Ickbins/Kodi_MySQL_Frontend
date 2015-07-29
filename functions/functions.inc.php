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
function get_letters($text) {
	$sql2 = "SELECT DISTINCT SUBSTRING(c00 FROM 1 FOR 1) AS firstletter, COUNT(*) AS counter FROM movie GROUP BY firstletter";
	$query2=mysql_query($sql2) or die (mysql_error());
	echo "<div id=\"pagination\">\n";
	echo "<table align=\"center\">\n";
	echo "<tr>";
	while ($row = mysql_fetch_array($query2)) {
		echo "<td><a href=\"index.php?letter=".$row['firstletter']."&count=".$row['counter']."\" title=\"".$row['counter']." ".$text."\" target=\"_parent\">".$row['firstletter']."</a></td>\n";
	}
	echo "</tr>\n";
	echo "</table>\n";
	echo "</div>\n";
}

function show_subnav($letter,$count,$width,$text) {
	$button_count=ceil($count/$width);
	echo "<div id=\"pagination_pages\">\n";
	echo "<table align=\"center\">\n";
	echo "<tr>";
	for ($i = 1; $i <= $button_count; $i++) {
		$page=($i-1)*$width;
		echo "<td><a href=\"index.php?letter=".$letter."&count=".$count."&page=".$page."\" title=\"".$text." ".$i."\" target=\"_parent\">Seite ".$i."</a></td>\n";
	}
	echo "</tr>\n";
	echo "</table>\n";
	echo "</div>\n";
}
?>
