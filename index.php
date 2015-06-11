<?php
//--
//-- Written by Christian Eckl, Berlin, June 2015
//--
//-- Include configuration
include('./functions/config.inc.php');
//-- Include functions
include('./functions/functions.inc.php');
//-- Include language file
include('./functions/lang.inc.php');

//-- DB Connect
connect_db($database,$datahost,$username,$password);

//-- Read values of the tvshows from the mysql database
$sql1='SELECT totalCount,totalSeasons FROM tvshowview ORDER BY c00 ASC';
$query1=mysql_query($sql1) or die (mysql_error());
//-- Sum up the seasons and episodes in the database for the overview
while ($row = mysql_fetch_array($query1)) {
$seasons=$seasons+$row['totalSeasons'];
$episodes=$episodes+$row['totalCount'];
}
//-- Read values of the movies from the mysql database
$sql2='SELECT c11 FROM movie';
$query2=mysql_query($sql2) or die (mysql_error());
//-- Sum up the running time of each movie in the database
while ($row = mysql_fetch_array($query2)) {
$time2=$time2+$row['c11'];
}

//-- HTML head
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
echo "<head>\n";
echo "<meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\" />\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">\n";
echo "<title>".$text[$lang][0]."</title>\n";
echo "</head>\n";

echo "<body>\n";

//-- Navigation menue
echo "<div id=\"navi\">\n";
echo "<table align=\"center\">\n";
echo "<tr>\n";
echo "<td rowspan=\"4\" width=\"150px\" align=\"center\"><a href=\"http://kodi.tv\" target=\"_blank\"><img src=\"./kodi.png\" width=\"150px\"></a></td>\n";
echo "<td>&nbsp;</td>\n";
echo "<td>&nbsp;</td>\n";
echo "<td>&nbsp;</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td colspan=\"3\" align=\"right\">".$text[$lang][0]."</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td width=\"150px\" align=\"right\"><a href=\"index.php\"><h3>".$text[$lang][1]."</h3></a></td>\n";
echo "<td width=\"150px\" align=\"right\"><a href=\"movies.php\"><h3>".$text[$lang][2]."</h3></a></td>\n";
echo "<td width=\"150px\" align=\"right\"><a href=\"tvshows.php\"><h3>".$text[$lang][3]."</h3></a></td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</div>\n";

//-- Short Information about the Database
echo "<div id=\"content\">\n";
echo "<table align=\"center\">\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<td width=\"50%\" colspan=\"2\"><b>".$text[$lang][2]."</b></td>\n";
echo "<td width=\"50%\" colspan=\"2\"><b>".$text[$lang][3]."</b></td>\n";
echo "</tr>\n";
echo "</thead>\n";
echo "<tr>\n";
echo "<td colspan=\"2\"><h3>".mysql_num_rows($query2)." ".$text[$lang][2]."</h1></td>\n";
echo "<td colspan=\"2\"><h3>".mysql_num_rows($query1)." ".$text[$lang][3]."</h1></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td colspan=\"2\"><h3>".secondsToTimeDay($time2,$lang)." ".$text[$lang][13]."</h1></td>\n";
echo "<td colspan=\"2\"><h3>".$seasons." ".$text[$lang][14]."</h1></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td colspan=\"2\"><h3>&nbsp;</h1></td>\n";
echo "<td colspan=\"2\"><h3>".$episodes." ".$text[$lang][15]."</h1></td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</div>\n";

echo "</body>\n";
echo "</html>\n";
?>