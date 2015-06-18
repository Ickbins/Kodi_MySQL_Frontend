<tr>
<td valign="top"><img width="180px" src="<?php echo $match[0][0];?>"></td>
<td valign="bottom">";

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
<td valign="top"><h1><?php echo $row['c00'];?></h1></td>
<td valign="top"><?php echo $row['c01'];?></td>
<td valign="top"><?php echo $row['c07'];?></td>
<td valign="top"><?php echo secondsToTime($row['c11'],$text[$lang]['17']);?></td>
</tr>