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

//-- Read all needed values from the movie database
$sql='SELECT c00,c01,c07,c08,c11,idFile FROM movie ORDER BY c00 ASC';
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

//-- Movies
echo "<div id=\"movie\">\n";
echo "<table align=\"center\">\n";
echo "<thead>\n";
echo "<tr>\n";
echo "<td colspan=\"2\"><b>".$text[$lang][4]."</b></td>\n";
echo "<td width=\"15%\"><b>".$text[$lang][5]."</b></td>\n";
echo "<td><b>".$text[$lang][6]."</b></td>\n";
echo "<td><b>".$text[$lang][7]."</b></td>\n";
echo "<td><b>".$text[$lang][8]."</b></td>\n";
echo "</tr>\n";
echo "</thead>\n";

while ($row = mysql_fetch_array($query)) {
$id=$row['idFile'];
//-- Read from the streamdetails database all the information about codec, resolution and so on
$sql_stream='SELECT idFile,iStreamType,strVideoCodec,iVideoWidth,strAudioCodec,strAudioLanguage FROM streamdetails WHERE idFile='.$id.'';
$query_stream=mysql_query($sql_stream) or die (mysql_error());

//-- While-Loop will now generate a formatted output of all films in the database
while ($row_stream = mysql_fetch_array($query_stream))
{
//-- Building the table with the information about the used codec, resolution...
//-- Getting codec and resolution information 
if($row_stream['iStreamType']=='0'){
//-- codec
$codec=strtoupper($row_stream['strVideoCodec']);
	//-- resolution
	if($row_stream['iVideoWidth']>='1920'){
	$res="HD";}
	else {
	$res="SD";}
}
//-- Audio information
elseif($row_stream['iStreamType']=='1')
{
if($audio!=''){$audio=$audio."</td></tr><tr><td>";}
$audio=$audio.strtoupper($row_stream['strAudioCodec']);
if($row_stream['strAudioLanguage']!='') {$audio=$audio."<br>".strtoupper($row_stream['strAudioLanguage']);}
}
}

//--Extract Thumbnail-URLs, we will always use the first one, this may sometimes end in a missed picture
preg_match_all('#\bhttp?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $row['c08'], $match);

echo "<tr>\n";
echo "<td valign=\"top\"><img width=\"180px\" src=\"".$match[0][0]."\"></td>\n";
echo "<td valign=\"bottom\">";
//-- Table with Audio und Codec Information
echo "<div id=\"codec\">\n";
echo "<table align=\"center\">\n";
echo "<tr>\n";
echo "<td>".$res."</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>".$codec."</td>\n";
echo "</tr>\n";
echo "<tr>\n";
echo "<td>".$audio."</td>\n";
echo "</tr>\n";
echo "</table>\n";
echo "</div>\n";
//-- End of the audio and codec information table

echo "</td>\n";
echo "<td valign=\"top\"><h1>".$row['c00']."</h1></td>\n";
echo "<td valign=\"top\">".$row['c01']."</td>\n";
echo "<td valign=\"top\">".$row['c07']."</td>\n";
echo "<td valign=\"top\">".secondsToTime($row['c11'])."</td>\n";
echo "</tr>\n";
//-- Unset variables
unset($audio);
}
echo "</table>\n";
echo "</div>\n";
echo "</body>\n";
echo "</html>\n";
?>