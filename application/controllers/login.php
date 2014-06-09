<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*	controlls the login and user signup	 
*		
*
*/
class Login extends CI_Controller{
	
	
	function index()
	{
		$this->session->sess_destroy();
		$data['main_content'] = 'loginform'; 
		$this->load->view('includes/template', $data); 
	}
	
	function checkcred()
	{
		$this->load->model('user_m'); 
		$check = $this->user_m->valid(); 
		
		if ($check)
		{
			redirect('RVL_Portal/home'); 
		}
		else 
		{
			$this->index();
		}
		
	}
	function signup ()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);  
	}
		function logout()
	{
		$this->session->sess_destroy();
		$this->index(); 
	}
	function create_member()
	{
		$this->load->library('form_validation'); 
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'); 
		$this->form_validation->set_rules('pw1', 'Password', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('pw2', 'Password Confirm', 'trim|required|matches[pw1]');
		
		if($this->form_validation->run() == false)
		{
			$this->signup(); 
		}
		else {
			$this->load->model('user_m'); 
			if ($this->user_m->create_user())
			{
				$this->index(); 
			}
			else {
				$data['main_content'] = 'loginerror';
				$this->load->view('includes/template', $data);
			} 
		}
		
	}
}