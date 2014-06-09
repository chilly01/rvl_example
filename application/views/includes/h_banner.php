<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*		 
*		
*
*/
	// define variables
		$is_logged_in = $this->session->userdata('is_logged_in');
		$admin = $this->session->userdata('use_admin');	
		$uname = $this->session->userdata('username');
		$uid = $this->session->userdata('userid')
	
?>
<div id="user">
<?php
if (isset($is_logged_in) && $is_logged_in == true){
	echo anchor('rvl_portal/userpage/' .$uid, $uname, 'title="userinfo page"');;
}
?></div>
		<div id="header"></div>
		<div id="headmenubar">
		<div id="headmenu">
		<div id="head_navigation">
		<?php
		if (isset($is_logged_in) && $is_logged_in == true){?>
		<div id="navhome"><a href="/">Home</a></div>		
		<?php if(isset($is_logged_in) && $admin != 0){
		echo '<div id="navfilem">'; 
		echo anchor('rvl_portal/adminpage/' .$uid, 'User Manager', 'title="Users"');
		echo '</div>'; 
		}?>	
		<div id="menusearchbar">
		<?php 
			echo form_open('/rvl_portal/search'); 
			echo form_input('stext', "type rma number here"); 
			echo form_submit('msubmit', 'Search');
			echo form_close(); 
			?>
		</div>
		<div id="logout">
		<?php echo anchor('login/logout', 'Logout'); }?>
		</div></div></div></div>