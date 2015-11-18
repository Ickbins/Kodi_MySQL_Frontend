<?php
//--
//-- Written by Christian Eckl, Berlin, October 2015
//--
//-- Movie Set List of the Kodi Database
//-- Only Movie Sets with more than one movie will appear in the list!
//--
//-- Include configuration
include('./functions/config.inc.php');
//-- Include functions
include('./functions/functions.inc.php');
//-- Include language file
include('./functions/lang.inc.php');

//-- DB Connect
connect_db($database,$datahost,$username,$password);

//-- If the variable "set" is NOT set, show all movie sets
if (!isset($_GET['set'])){
	$sql='SELECT idSet,strSet FROM sets ORDER BY strSet ASC';
	
	$query=mysql_query($sql) or die (mysql_error());

	//-- HTML head und body start
	include 'templates/head.tpl';

	//-- Navigation menue
	include 'templates/navigation.tpl';

	//-- Output of the Movie Sets, thead
	include 'templates/movie_sets_thead.tpl';

	//-- While-Loop will now generate a formatted output of all Movie Sets in the database
	while ($row = mysql_fetch_array($query)) {
		//-- Count the number of movies of each set
		$sql2='SELECT COUNT(idSet) FROM movie WHERE idSet='.$row['idSet'];
		$query2=mysql_query($sql2) or die (mysql_error());
		$num_set_movies=mysql_result($query2,0);
		
	//-- Only Movie Sets with more than one movie will appear
	if ( $num_set_movies > 1) {
		//-- Output of the TV Shows, while loop
		include 'templates/movie_sets_while.tpl';
	}
	}
	
	//-- Output of the Movie Sets, end
	include 'templates/movie_sets_end.tpl';
}
else {
	$set=$_GET['set'];
	//-- If the variable "set" is set, show all films of the Movie Set
	$sql="SELECT idMovie,c00,c01,c07,c08,c11,c16,idSet,idFile FROM movie WHERE idSet = ".$set." ORDER BY c00";
	
	$query=mysql_query($sql) or die (mysql_error());
	
	//-- HTML head und body start
	include 'templates/head.tpl';

	//-- Navigation menue
	include 'templates/navigation.tpl';

	//-- Reuse Movies, thead
	include 'templates/movie_thead.tpl';

	//-- While-Loop will now generate a formatted output of all films in the Movie Set
	while ($row = mysql_fetch_array($query)) {
		$id=$row['idFile'];
		//-- Read from the streamdetails database all the information about codec, resolution and so on
		$sql_stream='SELECT idFile,iStreamType,strVideoCodec,iVideoWidth,strAudioCodec,strAudioLanguage FROM streamdetails WHERE idFile='.$id.'';
		$query_stream=mysql_query($sql_stream) or die (mysql_error());

		//-- While-Loop will now generate a formatted output of audio codecs and movie resolution
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

		//--Read the filename from database
		$sql_file='SELECT idFile,strFilename FROM files WHERE idFile='.$id.'';
		$query_stream=mysql_query($sql_file) or die (mysql_error());
		$filename=mysql_fetch_array($query_stream);

		//--Extract Thumbnail-URLs, we will always use the first one, this may sometimes end in a missed picture
		preg_match_all('#\bhttp?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $row['c08'], $match);

		//-- Movie Sets, thead
		include 'templates/movie_while.tpl';

		//-- Unset variables
		unset($audio);
	}

	//-- Movie Sets, end
	include 'templates/movie_end.tpl';
}

//-- Footer
include 'templates/footer.tpl';
?>