  		<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen"/>		
		<link href="/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="/js/sliding.form.js"></script>
		<script type="text/javascript" src="/js/form.js"></script>
  
    <div id="content">
            <h1><?php echo $title; ?></h1>
            <div id="error_div"></div>
            <div id="wrapper">
                <div id="steps">
                    <form id="formElem" name="formElem" action="<?php 
                    if ($new)
                    	echo '/index.php/rvl_portal/save_new_rma'; 
                    else 
                    	echo '/index.php/rvl_portal/update_rma'; 
                    ?>" method="post">
                        <fieldset class="step">
                            <legend>Basic Info</legend>
                            <p>
								<label for="customertype">Customer Type</label>
								<select name="customertype" id="customertype">
									<option value="1" >End User</option>
									<option value="2" >Distributor</option>
								</select>	
								<input type="hidden" id="ct" name="ct" value="<?php echo $values['customer_type'];?>" />
                            
								<label for="rma_type">RMA Type</label>
								<select name="rma_type" id="rma_type">
									<option value="1" >Select Customer Type</option>								
								</select>	
								<input type="hidden" id="rt" name="rt" value="<?php echo $values['rma_type'];?>" />
                            	
                            	<label for="product_type">Product Type</label>
								<select name="product_type" id="product_type">
									<option value="0" >No Type</option>
									<option value="1" >NAS</option>
									<option value="2" >DAS RMA</option>
								</select>
								<input type="hidden" id="pt" name="pt" value="<?php echo $values['customer_type'];?>" />
                            
                            </p>
                            <p>
                                <label for="rma_number">RMA Number</label>
                                <input id="rma_number" class="sn" name="rma_number" type="text" value="<?php echo $values['customer_rma_num'];?>" />
                            </p>
                            <p>
								<label for="company_name">Company Name</label>
                                <input id="company_name" name="company_name" type="text" value="<?php echo $values['company_name'];?>" />
                                <label for="first_name">First Name</label>
                                <input id="first_name" name="first_name" type="text" value="<?php echo $values['first_name'];?>" />
								<label for="last_name">Last Name</label>
                                <input id="last_name" name="last_name" type="text" value="<?php echo $values['last_name'];?>" />
                            </p>
                      		<p>
							<label for="status">Status</label>
								<select name="status" id="status">
									<option value="1" >Open</option>
									<option value="2" >Closed</option>								
								</select>
								<input type="hidden" id="st" name="st" value="<?php echo $values['rma_status_id'];?>" />
                            
                            </p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>Returned Info</legend>
                            <p>
                            <label for="receipt_date">Returned Date</label>
                            <input id="receipt_date" class="date" name="receipt_date" type="text" value="<?php echo $values['receipt_date'];?>"  />
                            </p>
                            <p> 
								<label for="iomegasn">Iomega Serial Number</label>
                                <input id="iomegasn" name="iomegasn" type="text" value="<?php echo $values['iomega_sn'];?>" />             
								<br>OR<br>
								<label for="bhddsn">Bare HDD Serial Number</label>
                                <input id="bhddsn" name="bhddsn" type="text"  value="<?php echo $values['bare_hdd_sn'];?>" />
                            </p>
                            <p> 
								<label for="partnumber">Returned Part #</label>
                                <input id="partnumber" name="partnumber" type="text"  value="<?php echo $values['ret_part_num'];?>" />                              
								<label for="partdesc">Returned Part Desc</label>
                                <input id="partdesc" name="partdesc" type="text"  value="<?php echo $values['ret_part_desc'];?>" />
                            </p>	
							<p>
							<label for="notes">Notes</label>
                            <input id="notes" name="notes" type="text"  value="<?php echo $values['notes'];?>"  />  
                            
							</p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>Screen and Repair</legend>
                            <p>
                            <label for="screen_date">Screen Date</label>
                            <input id="screen_date" class="date" name="screen_date" type="text"  value="<?php echo $values['screen_date'];?>" />
                            </p>						
							<p>
								<label for="product_dis">Product Disposition</label>
								<select name="product_dis" id="product_dis">
									<option value="1" >Return to Stock</option>
									<option value="2" >RTV</option>
									<option value="3" >Scrap</option>
									<option value="4" >WIP</option>
								</select>
								
								<label for="facausecode">FA Cause Code</label>
								<select name="facausecode" id="facausecode" value="<?php echo $values[fa_cause_code]; ?>">
									<option value="BADHDD" >BADHDD</option>
									<option value="BOARD" >BOARD</option>
									<option value="BUTTON" >BUTTON</option>
									<option value="CNECTR" >CNECTR</option>
									<option value="COSMC" >COSMC</option>
									<option value="CPU" >CPU</option>
									<option value="REVERROR" >REVERROR</option>
									<option value="REVNPF" >REVNPF</option>
									<option value="DND" >DND</option>
									<option value="DOA" >DOA</option>
									<option value="DOOR" >DOOR</option>
									<option value="FAN" >FAN</option>
									<option value="FAROY" >FAROY</option>
									<option value="FRAUD" >FRAUD</option>
									<option value="FWM" >FWM</option>
									<option value="LED" >LED</option>
									<option value="NICERR" >NICERR</option>
									<option value="NOISE" >NOISE</option>
									<option value="NPF" >NPF</option>
									<option value="OTHER" >OTHER</option>
									<option value="BUTTON" >BUTTON</option>
									<option value="POWSUP" >POWSUP</option>
									<option value="MEMORY" >MEMORY</option>
									<option value="REPEAT" >REPEAT</option>
									<option value="ROBOCODE" >ROBOCODE</option>
									<option value="SMOKE" >SMOKE</option>
									<option value="SUPPLIER" >SUPPLIER</option>
									<option value="TESTERROR" >TESTERROR</option>
								</select>
								<input type="hidden" id="st" name="st" value="<?php echo $values['fa_cause_code'];?>" />
								
							</p>
							<p>
							<label for="notes2">Notes</label>
							<input id="notes2" name="notes2" type="notes"/> 
							</p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>RTV</legend>
                            <p>
							<label for="rtvcat">RTV Category</label>
								<select name="rtvcat" id="rtvcat">
									<option value="1" >Hard Drive</option>
									<option value="2" >Enclosure</option>
									<option value="3" >Accessory</option>									
								</select>
                            </p><p>
							<label for="raw_hdd_sn">HDD or Enclosure SN</label>
							<input id="raw_hdd_sn" name="raw_hdd_sn" type="text"  value="<?php echo $values['raw_hdd_part_num'];?>"  /> 
							<label for="raw_hdd_sn2">HDD or Enclosure SN(2)</label>
                            <input id="raw_hdd_sn2" name="raw_hdd_sn2" type="text"  value="<?php echo $values['raw_hdd_part_num2'];?>" />                             
							</p>
							<p>
							<label for="supplier">Supplier</label>
                            <input id="supplier" name="supplier" type="text"  value="<?php echo $values['supplier'];?>" /> 
							<label for="supplierrma">Supplier RMA</label>
                            <input id="supplierrma" name="supplierrma" type="text"  value="<?php echo $values['supplier_rma'];?>"  />    							
							</p>
                        </fieldset>
                         <fieldset class="step">
                            <legend>Shipping Info</legend>
                            <p>
                            <label for="shipped_date">Shipping Date</label>
                            <input id="shipped_date" class="date" name="shipped_date" type="text"  value="<?php echo $values['shipped_date'];?>" />
                            </p><p>
							<label for="replacesn">Replacement S/N</label>
                            <input id="replacesn" name="replacesnm" type="text"  value="<?php echo $values['replacement_sn'];?>"  />
                            <label for="replacenum">Replacement Part #</label>
                            <input id="replacenum" name="replacenum" type="text" value="<?php echo $values['replacement_part_num'];?>" /> 
                            <label for="replacedesc">Replacement Part Desc</label>
                            <input id="replacedesc" name="replacedesc" type="text" value="<?php echo $values['replacement_part_desc'];?>" />
                            </p><p>
                            <label for="couriertrack">Tracking Number</label>
                            <input id="couriertrack" name="couriertrack" type="text"  value="<?php echo $values['courier_tn'];?>" /> 
                            <label for="shipdocnum">Shipment Number</label>
                            <input id="shipdocnum" name="shipdocnum" type="text"  value="<?php echo $values['shipment_document_num'];?>"  /> 							
                            </p>
                            <p>
                            <label for="replacemode">Replacement Mode</label>
                            <input id="replacemode" name="replacemode" type="text" value="<?php echo $values['replacement_mode'];?>"  /> 
                            </p>
                        </fieldset>
						<fieldset class="step">
                            <legend>Confirm</legend>
							<input type="hidden" id="rma_id" name="rma_id" value="<?php echo $id; ?>" />
                            <p class="submit">
                                <button id="registerButton" type="submit">Save RMA</button>
                            </p>
							
                        </fieldset>
                    </form>
                </div>
                <div id="navigation">
                    <ul>
                        <li class="selected">
                            <a href="#">Basic</a>
                        </li>
                        <li>
                            <a href="#">Returned</a>
                        </li>
                        <li>
                            <a href="#">Screen</a>
                        </li>
                        <li>
                            <a href="#">RTV</a>
                        </li>
                        <li>
                            <a href="#">Shipping</a>
                        </li>
						<li>
                            <a href="#">Save</a>
                        </li>
                    </ul>
                </div>
            </div>
		
        </div>
        <?php print_r($values); 
        
        ?>
        