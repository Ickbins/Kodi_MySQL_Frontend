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

//-- Read all needed values from the tvshowview
$sql='SELECT c00,c01,c06,totalCount,totalSeasons FROM tvshowview ORDER BY c00 ASC';
$query=mysql_query($sql) or die (mysql_error());

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

//-- Output of the TV Shows
echo "<div id=\"movie\">\n";
echo "<table style=\"width: 1000px\" cellpadding=\"10\" align=\"center\">\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<td width=\"15%\"><b>".$text[$lang][9]."</b></td>\n";
echo "<td><b>".$text[$lang][10]."</b></td>\n";
echo "<td><b>".$text[$lang][14]."</b></td>\n";
echo "<td><b>".$text[$lang][15]."</b></td>\n";
echo "</tr>\n";
echo "</thead>\n";

//-- While-Loop will now generate a formatted output of all tvseries in the database
while ($row = mysql_fetch_array($query)) {
	
//--Extract Thumbnail-URLs, we will always use the first one, this may sometimes end in a missed picture
preg_match_all('#\bhttp?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $row['c06'], $match);

echo "<tr>\n";
echo "<td valign=\"top\"><h1>".$row['c00']."</h1></td>\n";
echo "<td valign=\"top\">".$row['c01']."</td>\n";
echo "<td valign=\"top\">".$row['totalSeasons']."</td>\n";
echo "<td valign=\"top\">".$row['totalCount']."</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td colspan =\"4\"><img width=\"100%\" src=\"".$match[0][0]."\"></td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td colspan=\"4\" align=\"right\"><hr></td>\n";
echo "</tr>\n";
}
echo "</div>\n";
echo "</table>\n";
echo "</body>\n";
echo "</html>\n";
?>