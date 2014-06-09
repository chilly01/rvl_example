<?php

class User_m extends CI_Model {
	
	function valid()
	{
		$this->db->where('email', $this->input->post('email')); 
		$this->db->where('password',($this->input->post('password')));
		$query = $this->db->get('users'); 		 
		if ($query->num_rows == 1){
			foreach ($query->result() as $row)
			{
				$data = array(
						'username' => $row->email,
						'is_logged_in' => true,
						'old_id' => $row->type,
						'userid' => $row->id,
						'use_rma' => $row->use_rma,
						'search_rma' => $row->search_rma,
						'edit_rma' => $row->edit_rma,
						'use_lc' => $row->use_lc,
						'edit_lc' => $row->edit_lc,
						'use_admin' => $row->use_admin,
						'admin_search' => $row->admin_search,
						'admin_report' => $row->admin_report);					
				$this->session->set_userdata($data);
			}			
			return true; 
		}		
		return false; 	
	}
	
	function update_user($userid)
	{
		
	}
	function get_learning()
	{
		$m = array (); 
		$q = $this->db->query('select * from files'); 
		foreach ($q->result_array() as $row)
		{
			$m[]= array('id' => $row['id'], 'name' => $row['filename'],
					'desc' => $row['description'], 'section' => $row['section']);						
		}
		return $m; 
	}
	function create_user()
	{
		// check if email is already in the db
		$this->db->where('email', $this->input->post('email'));
		$query = $this->db->get('users');
		if ($query->num_rows == 1){
			return false; 
		}
		$n = array(
				'email' => $this->input->post('email'), 
				'password' => $this->input->post('pw1')
				); 
		$i = $this->db->insert('users', $n);	
		return $i; 
	}
	function user_info($uid)
	{
		$r = array(); 
		if (isset($uid)){
		$q = $this->db->query('select * from users where id =' .$uid .";"); 
		foreach ($q->result_array() as $row){
			$r['user']= array (
					'id' => $row['id'], 
					'email' => $row['email'], 
					'password' => $row['password'],
					'old_id' => $row['type'],
					'use_rma' => $row['use_rma'],
					'search_rma' => $row['search_rma'],
					'edit_rma' => $row['edit_rma'],
					'use_lc' => $row['use_lc'],
					'edit_lc' => $row['edit_lc'],
					'use_admin' => $row['use_admin'],
					'admin_search' => $row['admin_search'],
					'admin_report' => $row['admin_report']); 
					}
		}
		return $r; 
		
	}
	
	function user_old($email)
	{
		$r = array();
		$q = $this->db->query('select * from mybb_users where email ="' .$email .'";');
			foreach ($q->result_array() as $row){
				$r[]= array ('user_id' => $row['uid'], 'uname' => $row['username'],
						'password' => $row['password'], 'email' => $row['email'] );
			}
		
		return $r;
	
	}
	function all_users()
	{
		$r = array(); 
		$q = $this->db->query('select * from users;'); 
		foreach ($q->result_array() as $row){
			$name = 'user' . $row['id']; 
			$r[$name]= array (
					'id' => $row['id'], 
					'email' => $row['email'], 
					'password' => $row['password'],
					'old_id' => $row['type'],
					'use_rma' => $row['use_rma'],
					'search_rma' => $row['search_rma'],
					'edit_rma' => $row['edit_rma'],
					'use_lc' => $row['use_lc'],
					'edit_lc' => $row['edit_lc'],
					'use_admin' => $row['use_admin'],
					'admin_search' => $row['admin_search'],
					'admin_report' => $row['admin_report']); 
					}
		$sd['users'] = $r; 
		return $sd;
		
	}

	
	
	
}