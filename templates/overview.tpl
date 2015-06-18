<div id="content">
<table align="center">
<thead>
<tr>
<td width="50%" colspan="2"><b><?php echo $text[$lang][2];?></b></td>
<td width="50%" colspan="2"><b><?php echo $text[$lang][3];?></b></td>
</tr>
</thead>
<tr>
<td colspan="2"><h3><?php echo mysql_num_rows($query2)." ".$text[$lang][2];?></h1></td>
<td colspan="2"><h3><?php echo mysql_num_rows($query1)." ".$text[$lang][3];?></h1></td>
</tr>
<tr>
<td colspan="2"><h3><?php echo secondsToTime($time2,$text[$lang][16])." ".$text[$lang][13];?></h1></td>
<td colspan="2"><h3><?php echo $seasons." ".$text[$lang][14];?></h1></td>
</tr>
<tr>
<td colspan="2"><h3>&nbsp;</h1></td>
<td colspan="2"><h3><?php echo $episodes." ".$text[$lang][15];?></h1></td>
</tr>
</table>
</div>