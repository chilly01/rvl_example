<?php /*
*  Created by Cody Hillyard 6/19/2013 codyhillyard@gmail.com
*		 
*	$data = list of the results in an array of (	
*
*/

?>

<div id="search_results">
<script type="text/javascript" src="/js/report.js"></script>
<h3>Search Results: Count <?php echo count($data); ?></h3>
<div class="result" id="resultmenu">
<?php 
	echo form_open('rvl_portal/filtersearch'); 
	$filters = array('-select a field-', 'Receipt Date','Shipped Date' ,'RMA Creation Date');
	echo form_label('Filter: ', 'filter');
	echo form_dropdown('filter', $filters);
	
	$info = array('id' => 'start_date', 'class' => 'dateinput', 'name' => 'start_date');
	echo form_label('From: ', 'start_date') ;
	echo form_input($info);
	
	$info = array('id' => 'end_date', 'class' => 'dateinput', 'name' => 'end_date'); 
	echo form_label('To: ', 'end_date') ; 
	echo form_input($info); 
	echo form_submit('submit', 'Filter'); 
	echo form_close(); 	
?>
</div><div id="csv">

</div>
<div class="results" id="resultlist">
<?php 
	
	foreach ($data as $r)
	{
		echo '<div class="result"><div class="rma_header">';
		echo anchor('rvl_portal/edit/' . $r['id'], 'RVL #: '. $r['customer_rma_num'], 'title="Edit RMA"' ); 
		echo "S/N: " .$r['iomega_sn'] .'<br> </div>'; 
		echo 'Company Name: ' . $r['company_name'] . '<br>'; 
		echo 'First Name: ' . $r['first_name'] .'<br>'; 
		echo 'Last Name: ' . $r['last_name'] . '<br> </div>' ; 
		
	}
?>
</div>
</div>