<tr>
<td valign="top" rowspan="2"><img width="180px" src="<?php echo $match[0][0];?>"></td>
<td valign="bottom" rowspan="2">

<!-- Table with audio and codec information -->
<div id="codec">
<table align="center">
<tr>
<td><?php echo $res;?></td>
</tr>
<tr>
<td><?php echo $codec;?></td>
</tr>
<tr>
<td><?php echo $audio;?></td>
</tr>
</table>
</div>
<!-- End of the audio and codec information table -->

</td>

<td valign="top"><h1><?php echo $row['c00'];?></h1><br /><?php echo $row['c16'];?></td>
<td valign="top"><?php echo $row['c01'];?></td>
<td valign="top"><?php echo $row['c07'];?></td>
<td valign="top"><?php echo secondsToTime($row['c11'],$text[$lang]['17']);?></td>
</tr>
<div id="filename">
<tr>
<td>&nbsp;</td>
<td><?php echo $filename['strFilename'];?></td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr>
</div>
