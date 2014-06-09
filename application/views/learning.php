<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*  Learning Center View
* $filenames = (all files in the upload folder); 
* $counted = (all files that are in both the db and the folder); 
* $badfiles = files that are in the DB but not in the folder; 		
* $newfiles = files that are in the folder but not in the DB;		 
*		
*
*/?>

<link href="/css/learning.css" rel="stylesheet" type="text/css" />
<div id="learning">
<div id="learningheader">
<h3>Learning Center Files</h3><hr>
</div>
<div id="learninglist"><ul>
<?php
if (isset($counted)){
	foreach ($counted as $item){ 
	echo '<li class="litem"><div class="lcname"><h3>'; 
	echo anchor('repository/learning/' . $item['name'] , 'Download '.$item['name'], 'title="' . $item['desc'] .'"');
	echo '</h3>'; 
	echo $item['desc']; 	
	echo '</div></li>'; 
	}}
	?>
</ul>	
</div>
<?php 
$admin = $this->session->userdata('edit_lc');
	if ($admin > 0)
	{
		// show the files in the folder but not in the db
		// allow the user to set the values of the file
		
		echo 'admin area:'; 
	}


?>
</div>