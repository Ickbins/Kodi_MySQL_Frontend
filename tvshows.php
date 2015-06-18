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

//-- HTML head und body start
include 'templates/head.tpl';

//-- Navigation menue
include 'templates/navigation.tpl';

//-- Output of the TV Shows, thead
include 'templates/tvshow_thead.tpl';

//-- While-Loop will now generate a formatted output of all tvseries in the database
while ($row = mysql_fetch_array($query)) {
	
//--Extract Thumbnail-URLs, we will always use the first one, this may sometimes end in a missed picture
preg_match_all('#\bhttp?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $row['c06'], $match);

//-- Output of the TV Shows, while loop
include 'templates/tvshow_while.tpl';

}

//-- Output of the TV Shows, end
include 'templates/tvshow_end.tpl';

//-- Footer
include 'templates/footer.tpl';
?>