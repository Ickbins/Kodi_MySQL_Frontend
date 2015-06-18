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

//-- HTML head und body start
include 'templates/head.tpl';

//-- Navigation menue
include 'templates/navigation.tpl';

//-- Short Information about the Database
include 'templates/overview.tpl';

//-- Footer
include 'templates/footer.tpl';
?>