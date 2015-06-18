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

//-- HTML head und body start
include 'templates/head.tpl';

//-- Navigation menue
include 'templates/navigation.tpl';

//-- Movies, thead
include 'templates/movie_thead.tpl';

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

//-- Movies, thead
include 'templates/movie_while.tpl';

//-- Unset variables
unset($audio);
}

//-- Movies, end
include 'templates/movie_end.tpl';

//-- Footer
include 'templates/footer.tpl';
?>