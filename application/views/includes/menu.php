<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*		 
*		
*
*/?>
<div id="panel">
			
	<?php
	$is_logged_in = $this->session->userdata('is_logged_in');
	$user = $this->session->userdata('username');
	$auth = $this->session->userdata('edit_rma'); 

	// @see index.php controller for setting the "site" variable ?>
			<h3><img src="/images/addnew.png" id="start_rma"> 
			<?php echo anchor('rvl_portal/edit', 'Create New RMA', array('title' => 'new_rma'));?></h3>
			<hr>
			<h3> <img src="/images/search.png" id="update_rma"> Update Existing RMA</h3>
			
			<h4>RMA or Serial Number:</h4>
			<?php 
				echo form_open('rvl_portal/search');
				$info = array('id' => 'stext', 'class' => 'search', 'name' => 'stext');
				echo form_input($info);
				echo form_submit('submit', 'Search');
				echo form_close(); 
			?>
			<hr>
			<h3><?php echo anchor('rvl_portal/myrmas', 'My RMAs', array('title' => 'RMAs you worked on'));?></h3>
			<hr>
			<?php if($auth > 0 ) :?>
				<h3><?php echo anchor('rvl_portal/allrmas', 'All RMAs', array('title' => 'All RMAs'));?></h3>	
			
			<hr>
			<?php endif;?>
			<br><br>
			<h3>Screen &amp; Repair Tools</h3>
			<hr>
			<h3><?php echo anchor('rvl_portal/learning', 'Learning Center', array('title' => 'Learning Center'));?></h3>
			<hr>
			<br>
		</div>