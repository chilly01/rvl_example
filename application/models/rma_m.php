<?php

class Rma_m extends CI_Model {
	
	function get_customer_type()
	{
		$ct = array(); 	
		$q = $this->db->query('select * from customer_type'); 
		foreach($q->result_array() as $r)
		{
			$ct[] = $r['name']; 			
		}
		return $ct; 
	}
	
	function get_rma_status_id()
	{
		$ct = array();
		$q = $this->db->query('select * from rma_status');
		foreach($q->result_array() as $r)
		{
			$ct[] = $r['name'];	
		}
		return $ct;
	}	
	
	function get_product_type()
	{
		$ct = array();
		$q = $this->db->query('select * from product_type');
		foreach($q->result_array() as $r)
		{
			$ct[] = $r['name'];
		}
		return $ct;
	}
	
	function get_fa_codes()
	{
		return array('BADHDD','BOARD','BUTTON','CNECTR','COSMC','CPU','REVERROR','REVNPF','DND','DOA','DOOR','FAN','FAROY','FRAUD','FWM',
		'LED','NICERR','NOISE','NPF','OTHER','POWSUP','MEMORY','REPEAT','ROBOCODE','SMOKE','SUPPLIER','TESTERROR');
	}
	function get_suppliers()
	{
		return array('Seagate','Samsung','Hitachi','Toshiba','Western Digital','Argosy',
		'Goodman','MaPower','Min-Aik','Onnto','USI','Wistron','Pegatron','Alpha');
	}
	function set_rma($info)
	{
		$this->db->insert('rma', $info);
		return $this->db->affected_rows(); 
	}
	function update_rma($id, $data)
	{
			
		$where = "id = " .$id;
		
		$q = $this->db->update_string('rma', $data, $where);
		return $this->db->query($q); 
		 
	}
	function get_single_rma($id)
	{
		$ct = array();
		$uid = $this->session->userdata('userid');
		$q = $this->db->query('select * from rma where id = ' .$id . ' ;' );
		foreach($q->result_array() as $r)
		{ 
			$data = array(
					'receipt_date' => $r['receipt_date'],
					'customer_type' => $r['customer_type'],
					'company_name' => $r['company_name'],
					'first_name' => $r['first_name'],
					'last_name' => $r['last_name'],
					'customer_rma_num'=> $r['customer_rma_num'],
					'rma_type' => $r['rma_type'],
					'iomega_sn' => $r['iomega_sn'],
					'bare_hdd_sn' => $r['bare_hdd_sn'],
					'ret_part_num' => $r['ret_part_num'],
					'ret_part_desc' => $r['ret_part_desc'],
					'shipped_date' => $r['shipped_date'],
					'warranty' => $r['warranty'],
					'replacement_sn' => $r['replacement_sn'],
					'replacement_part_num' => $r['replacement_part_num'],
					'replacement_part_desc' =>$r['replacement_part_desc'],
					'courier_tn' => $r['courier_tn'],
					'screen_date' => $r['screen_date'],
					'fa_cause_code'=> $r['fa_cause_code'],
					'product_disposition'=> $r['product_disposition'],
					'rtv_category'=> $r['rtv_category'],
					'raw_hdd_sn' => $r['raw_hdd_sn'],
					'raw_hdd_part_num' =>$r['raw_hdd_part_num'],
					'raw_hdd_part_num2' => $r['raw_hdd_part_num2'],
					'raw_hdd_part_num3' => $r['raw_hdd_part_num3'],
					'supplier' => $r['supplier'],
					'supplier_rma' => $r['supplier_rma'],
					'notes' => $r['notes'],
					'site_id' => $r['site_id'],
					'modified_by' => $r['modified_by'],
					'created' => $r['created'],
					'last_modified' => $r['last_modified'],
					'created_by' =>$r['created_by'],
					'product_type_id' => $r['product_type_id'],
					'shipment_document_num' => $r['shipment_document_num'],
					'rma_status_id' => $r['rma_status_id'],
					'replacement_mode' => $r['replacement_mode']);
		}
		return $data;
	}
	function blank_rma()
	{
		$data = array(
				'receipt_date' => '',
				'customer_type' => '',
				'company_name' => '',
				'first_name' => '',
				'last_name' => '',
				'customer_rma_num'=> '',
				'rma_type' => '',
				'iomega_sn' => '',
				'bare_hdd_sn' => '',
				'ret_part_num' => '',
				'ret_part_desc' => '',
				'shipped_date' => '',
				'warranty' => '',
				'replacement_sn' => '',
				'replacement_part_num' => '',
				'replacement_part_desc' => '',
				'courier_tn' => '',
				'screen_date' => '',
				'fa_cause_code'=>'',
				'product_disposition'=> '',
				'rtv_category'=> '',
				'raw_hdd_sn' =>'',
				'raw_hdd_part_num' =>'',
				'raw_hdd_part_num2' => '',
				'raw_hdd_part_num3' => '',
				'supplier' => '',
				'supplier_rma' =>'',
				'notes' => '',
				'site_id' =>'',
				'modified_by' => '',
				'created' => '',
				'last_modified' => '',
				'created_by' =>'',
				'product_type_id' =>'',
				'shipment_document_num' => '',
				'rma_status_id' => '',
				'replacement_mode' => '');
		
		return $data;
	}
	function rmas_by_user()
	{
		$ct = array();
		$uid = $this->session->userdata('userid');
		$q = $this->db->query('select * from rma where modified_by = ' .$uid . ' or created_by = ' .$uid ); 
		foreach($q->result_array() as $r)
		{
			$ct[] = array (
					'id' => $r['id'],
					'iomega_sn' => $r['iomega_sn'],
					'customer_rma_num' => $r['customer_rma_num'],
					'company_name' => $r['company_name'], 
					'first_name' => $r['first_name'],
					'last_name' => $r['last_name']);
		}
		return $ct; 
	}
	function csv_by_user()
	{
		$uid = $this->session->userdata('userid');
		$q = $this->db->query('select * from rma where modified_by = ' .$uid . ' or created_by = ' .$uid ); 
		return $q; 
	}
	function rma_by_rmanumber($number)
	{
		$ct = array();
		
		$q = $this->db->query('select * from rma where customer_rma_num like '."'%" .$number ."%';");
		foreach($q->result_array() as $r)
		{
			$ct[] = array (
					'id' => $r['id'],
					'iomega_sn' => $r['iomega_sn'],
					'customer_rma_num' => $r['customer_rma_num'],
					'company_name' => $r['company_name'],
					'first_name' => $r['first_name'],
					'last_name' => $r['last_name']);
		}
		return $ct;
		
	}
	function rma_all($dates = null)
	{
		if ($dates==null)
		{
			$dates = date('Y/m/d'); 
		}
		$ct = array();
	
		$q = $this->db->query('select * from rma where shipped_date > ' .$dates .';');
		foreach($q->result_array() as $r)
		{
			$ct[] = array (
					'id' => $r['id'],
					'iomega_sn' => $r['iomega_sn'],
					'customer_rma_num' => $r['customer_rma_num'],
					'company_name' => $r['company_name'],
					'first_name' => $r['first_name'],
					'last_name' => $r['last_name']);
		}
		return $ct;
	
	}
	
	
}

