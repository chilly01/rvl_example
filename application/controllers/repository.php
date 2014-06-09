<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*	returns the files in the learning center	 
*		
*
*/

class Repository extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	
	}
	
	function learning ($id)
	{
		// right now I an not checking the permissions
		$data = file_get_contents("upload/" . $id); // Read the file's contents
		$name = $id;
		$this->load->helper('download');
		force_download($name, $data);
		
	}
	function software ()
	{
		// add in the software repository here
		
	}
	function model_code($code=null)
	{
		// try to connect to the oracle database: 
		
		$conn = oci_connect('RVL_PORTAL', 'portal', 'dev-db-web:1526/WEBDEV');
		
	}
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login/index');
			die();
		}
	}
}

