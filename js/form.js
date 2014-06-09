$(function(){
	$("select#customertype").val($('#ct').val()); 
	var rma = {}; 
	 rma.types = {
		        "distributor": [
		            { title: "- Select -", value: "" },
		            { title: "Credit", value: "credit" },
		            { title: "Return Only", value: "return" }
		        ],
		        "end_user": [
		            { title: "- Select -", value: "" },
		            { title: "Advance", value: "advance" },
		            { title: "Exchange", value: "exchange" },
		            { title: "Return Only", value: "return" },
		            { title: "Ship Only", value: "ship" }
		        ]
		    };
	if ($("#ct").val() == '2'){
	  var arr = rma.types.distributor;
	}
	else 
	{
		var arr = rma.types.end_user;
	}
	    var options = '';
	    for (var ii = 0; ii < arr.length; ii++) {
	        options += '<option value="' + arr[ii].value + '">' + arr[ii].title + '</option>';
	    }

	    $("select#rma_type").html(options);
	    $("select#rma_type").val($('#rt').val()); 
	    // auto populate rma type based on customer type,
	    // repopulate when customer type is changed
	    $("#customertype").change(function () {
	        var type = $(this).val();
	        var arr = '';
	        if (type == 1)
	            arr = rma.types.end_user
	        else if (type == 2)
	            arr = rma.types.distributor
	        var options = '';

	        for (var ii = 0; ii < arr.length; ii++) {
	            options += '<option value="' + arr[ii].value + '">' + arr[ii].title + '</option>';
	        }
	        $("select#rma_type").html(options);	       
	    });
	    
	    $("#rma_number").change(function () {
	    	var v = $("#customertype").val();
	        
	        if (v != "1")//end user
	            return true;
	        var value = $(this).val(); 
	        var pattern = /^[a-zA-Z]{2}[0-9]{10}$/; // /[ioqz]/i;
	        if (!pattern.test(value))
	        {
	        	 $("#error_div").html('Customer RMA Number must be format AA9999999999');	
	        	 $(this).addClass('requiredfield'); 
	        }
	        else{ 
	        	$("#error_div").html('Valid RNA mumber');
	        	 $(this).removeClass('requiredfield'); 
	        	
	        }
	    }); 
	    
	    $(".date").datepicker({
	    	maxDate: new Date, 
	        showOn: "button",
	        buttonImage: "/images/icons/calendar.png",
	        buttonImageOnly: true,
	        dateFormat: 'yy-mm-dd',
	        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'S'],
	        onSelect: function (text) {
	            $("#show_screen_date").html(text);
	        }
	    });
	    
	    $('#registerButton').click(function() {
	        $(this).stopPropagation();

	        $.post({
	            url: 'checklist.php',
	            data: $('#checklist').serialize(),
	            dataType: 'html',
	            success: function(data, status, jqXHR) {
	               $('div.successmessage').html(data);
	               //your success callback function
	            } ,
	            error: function() {
	               //your error callback function
	            } 
	        });
	    });
	    
}); 
