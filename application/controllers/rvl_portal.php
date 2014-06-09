<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*	rvl_portal is the main controller for the site, manages all the site views
*	constructor autochecks the session
*	
*/
class RVL_Portal extends CI_Controller{
	
	function __construct()
	{
		parent::__construct(); 
		$this->is_logged_in(); 
		
	}
	
	function index()
	{
		
		$this->home(); 
		
	}
	
	function home($message = null)
	{
		$data['data']['message'] = $message; 
		$data['main_content'] = 'home';
		$this->load->view('includes/template', $data);
	
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
	
	function update_rma()
	{
		$id = $this->input->post('rma_id'); 
		{
			$rma = array(
					'receipt_date' => $this->input->post('receipt_date'),
					'customer_type' => $this->input->post('customertype'),
					'company_name' => $this->input->post('company_name'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'customer_rma_num'=> $this->input->post('rma_number'),
					'rma_type' => $this->input->post('rma_type'),
					'iomega_sn' => $this->input->post('iomegasn'),
					'bare_hdd_sn' => $this->input->post('bhddsn'),
					'ret_part_num' => $this->input->post('partnumber'),
					'ret_part_desc' => $this->input->post('partdesc'),
					'shipped_date' => $this->input->post('shipped_date'),
					'warranty' => $this->input->post('receipt_date'),
					'replacement_sn' => $this->input->post('replacesn'),
					'replacement_part_num' => $this->input->post('replacenum'),
					'replacement_part_desc' => $this->input->post('replacedesc'),
					'courier_tn' => $this->input->post('couriertrack'),
					'screen_date' => $this->input->post('screen_date'),
					'fa_cause_code'=> $this->input->post('facausecode'),
					'product_disposition'=> $this->input->post('product_dis'),
					'rtv_category'=> $this->input->post('rtvcat'),
					'raw_hdd_sn' => $this->input->post('raw_hdd_sn'),
					'raw_hdd_part_num' => $this->input->post('raw_hdd_sn'),
					'raw_hdd_part_num2' => $this->input->post('raw_hdd_sn2'),
					'raw_hdd_part_num3' => $this->input->post('raw_hdd_sn3'),
					'supplier' => $this->input->post('supplier'),
					'supplier_rma' => $this->input->post('supplierrma'),
					'notes' => $this->input->post('notes'),
					'site_id' => $this->input->post('receipt_date'),
					'modified_by' => $this->session->userdata('userid'),
					'last_modified' => $this->input->post('receipt_date'),
					'product_type_id' => $this->input->post('receipt_date'),
					'shipment_document_num' => $this->input->post('shipdocnum'),
					'rma_status_id' => $this->input->post('status'),
					'replacement_mode' => $this->input->post('replacemode'));
		}
		$this->load->model('rma_m');
		$this->rma_m->update_rma($id, $rma); 
		$this->home('update successful'); 
		
	}
	
	function save_new_rma() //save the data from the RVL form
	{
		// validate the 		
		
		{
			$rma = array( 
					'receipt_date' => $this->input->post('receipt_date'),
					'customer_type' => $this->input->post('customertype'),
					'company_name' => $this->input->post('company_name'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'customer_rma_num'=> $this->input->post('rma_number'),
					'rma_type' => $this->input->post('rma_type'),
					'iomega_sn' => $this->input->post('iomegasn'),
					'bare_hdd_sn' => $this->input->post('bhddsn'),
					'ret_part_num' => $this->input->post('partnumber'),
					'ret_part_desc' => $this->input->post('partdesc'),
					'shipped_date' => $this->input->post('shipped_date'),
					'warranty' => $this->input->post('receipt_date'),
					'replacement_sn' => $this->input->post('replacesn'),
					'replacement_part_num' => $this->input->post('replacenum'),
					'replacement_part_desc' => $this->input->post('replacedesc'),
					'courier_tn' => $this->input->post('couriertrack'),
					'screen_date' => $this->input->post('screen_date'),
					'fa_cause_code'=> $this->input->post('facausecode'),
					'product_disposition'=> $this->input->post('product_dis'),
					'rtv_category'=> $this->input->post('rtvcat'),
					'raw_hdd_sn' => $this->input->post('raw_hdd_sn'),
					'raw_hdd_part_num' => $this->input->post('raw_hdd_sn'),
					'raw_hdd_part_num2' => $this->input->post('raw_hdd_sn2'),
					'raw_hdd_part_num3' => $this->input->post('raw_hdd_sn3'),
					'supplier' => $this->input->post('supplier'),
					'supplier_rma' => $this->input->post('supplierrma'),
					'notes' => $this->input->post('notes'),
					'site_id' => $this->input->post('receipt_date'),
					'modified_by' => $this->session->userdata('userid'),
					'created' => $this->input->post('receipt_date'),
					'last_modified' => $this->input->post('receipt_date'),
					'created_by' => $this->session->userdata('userid'),
					'product_type_id' => $this->input->post('receipt_date'),
					'shipment_document_num' => $this->input->post('shipdocnum'),
					'rma_status_id' => $this->input->post('status'),
					'replacement_mode' => $this->input->post('replacemode'));
			
			
			
	
			$this->load->model('rma_m');
			$data['success'] = $this->rma_m->set_rma($rma);
			$data['mydb'] = $rma; 
			$this->load->view('test', $data);
		}
				
	}
	
	function edit($id = null)
	{

		$this->load->model('rma_m');
		if ($id == null){
			$id = "new";
			$t = 'Create New RMA'; 
			$data['values'] =  $this->rma_m->blank_rma(); 
			$data['new'] = true; 
			$data['id'] = 0;
		}
		else 
		{
			$t= 'Edit RMA# ' . $id; 
			$data['values'] = $this->rma_m->get_single_rma($id);
			$data['new'] = false; 
			$data['id'] = $id;
			$t = 'RMA# '.$data['values']['customer_rma_num']; 
			
		}
		
		
			$data['customertype'] = $this->rma_m->get_customer_type();
			$data['producttype'] = $this->rma_m->get_product_type();
			$data['facodes'] = $this->rma_m->get_fa_codes();
			$data['rmastatus'] = $this->rma_m->get_rma_status_id();
			$data['suppliers'] = $this->rma_m->get_suppliers();
			$data['title'] = $t;
			
			$data['id'] = $id; 
			$s['data']=$data;
			$s['main_content']='single_edit';
			$this->load->view('includes/template', $s);		
				
	}
	
	function search()
	{	
		$this->load->model('rma_m');
		$data = $this->rma_m->rma_by_rmanumber($this->input->post('stext'));
		$s['data'] = $data; 
		//search for RVL
		$s['main_content']='search_results';
		
		$this->load->view('includes/template', $s);
	} 
	
	function allrmas()
	{
		$this->load->model('rma_m');
		$data = $this->rma_m->rma_all(0);
		$s['data'] = $data;
		//search for RVL
		$s['main_content']='search_results';		
		$this->load->view('includes/template', $s);
	}
	
	function adminpage($val=0)
	{
		//check permissions 
		if ($this->session->userdata('use_admin') == 0)
		{
			$this->home(); 
			die(); 
		} 
		//get list of users
		$this->load->model('user_m');		
		
		// get user info
		// send to view
		$s['data'] = $this->user_m->all_users();
		$s['main_content'] = 'adminpage';
		$this->load->view('includes/template', $s);
		//push list to view
	}
	
	function userpage()
	{
		$this->load->model('user_m');  
		
		$id = $this->session->userdata('userid'); 
		// get user info
		// send to view 
		$s['data'] = $this->user_m->user_info($id);		
		$s['main_content'] = 'userpage';
		$this->load->view('includes/template', $s);
		
		
		
	}

	function learning()
	{
		$filename = array(); 
		$this->load->model('user_m');
		$lcdb = $this->user_m->get_learning(); 
				
		$this->load->helper('file');		
		
		// get the filenames from upload folder 
		$d = get_dir_file_info('upload');
		foreach ($d as $obj)
		{
			$filename[] =  $obj['name']; 
		}
		$badfiles = array(); 
		$counted = array(); 
		$list = array();
		// check all the db files are included)
		foreach ($lcdb as $obj)
		{
			$bf = true; 
			for ($i = 0; $i < count($filename); $i++)
			{
				if ($obj['name'] == $filename[$i])
				{ 
					$counted [] = $filename[$i];
					$list[$filename[$i]] = array (
							'name' => $filename[$i], 
							'id' => $obj['id'], 
							'desc' => $obj['desc']);
					$bf = false; 
				 }
					
			}
			if ($bf)
			{
				$badfiles[] = $obj['name'];
			}
			
		}
		$data['filenames'] = $filename; 
		$data['counted'] = $list; 
		$data['badfiles'] = $badfiles; 		
		$data['newfiles'] = array_diff($filename, $counted);		 
		$s['data']=$data;
		$s['main_content'] = 'learning';	
		$this->load->view('includes/template', $s);
	}
	
	function myrmas()
	{	
		$this->load->dbutil(); 
		$this->load->model('rma_m');
		$data = $this->rma_m->rmas_by_user();
		$csv = $this->rma_m->csv_by_user(); 
		$s['csv'] = $this->dbutil->csv_from_result($csv);		 
		$s['data']=$data;
		$s['main_content'] = 'search_results'; 
		
		$this->load->view('includes/template', $s);
	}
	
	function filtersearch($id='null')
	{
		$this->load->model('rma_m');
		$id = $this->input->post('start_date');
		$data = $this->rma_m->rma_all($id);
		$s['data'] = $data;
		//search for RVL
		$s['main_content']='search_results';
		$this->load->view('includes/template', $s);
	}
	
	function upload()
	{
		$s['main_content']='upload';
		$this->load->view('includes/template', $s);
	}

	function do_upload()
	{
		$config['upload_path'] = './temp/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}

}
	