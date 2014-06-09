var rma = {};

function noIOQZValidation(value, element) {
    var pattern = /[ioqz]/i;
    return !pattern.test(value);
}

$.validator.addMethod("noIOQZ", noIOQZValidation, " Cannot contain the letters I, O, Q, Z.");

function requiredIfRmaTypeValidation(value, element, params) {
    if (value != "")
        return true;

    $v = $("#rma_type").val();
    //loop through params (except first param)
    for (i = 1; i < params.length; i++) {
        if (params[i] == $v)
            return false;
    }
    return true;
}

$.validator.addMethod("requiredIfRmaType", requiredIfRmaTypeValidation, " Field is required if RmaType is ??.");

function requiredIfRmaTypeNotValidation(value, element, params) {
    if (value != "")
        return true;

    $v = $("#rma_type").val();

    //loop through params (except first param)
    for (i = 1; i < params.length; i++) {
        if (params[i] == $v)
            return true;
    }
    return false;
}

$.validator.addMethod("requiredIfRmaTypeNot", requiredIfRmaTypeNotValidation, " Field is required if RmaType is not ??.");

function customerRMAValidation(value, element) {
    $v = $("#custdd").val();
    if ($v != "1")//end user
        return true;

    var pattern = /^[a-zA-Z]{2}[0-9]{10}$/; // /[ioqz]/i;
    return pattern.test(value);
}

$.validator.addMethod("customerRMA", customerRMAValidation, "<table style='float:right'><tr><td>If Customer Type is 'End User' then <br/>Customer RMA Number must be format AA9999999999</td></tr></table>");



$(function () {
    $('#show_raw_hdds').click(function () {
        $('[id^=raw_hdd_field]:hidden').show();
        $(this).hide();
    });

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

    var arr = rma.types.end_user;
    var options = '';
    for (var ii = 0; ii < arr.length; ii++) {
        options += '<option value="' + arr[ii].value + '">' + arr[ii].title + '</option>';
    }

    $("select#rma_type").html(options)
    .change(function () {
        $("#rma_type").valid();
        $("#receipt_date").valid();
        $("#shipped_date").valid();
        $("#iomega_sn").valid();
        $("#bare_hdd_sn").valid();
    });

    // auto populate rma type based on customer type,
    // repopulate when customer type is changed
    $("select#custdd").change(function () {
        var type = $(this).val();
        var arr = '';
        if (type == 0)
            arr = rma.types.end_user
        else if (type == 1)
            arr = rma.types.distributor
        var options = '';

        for (var ii = 0; ii < arr.length; ii++) {
            options += '<option value="' + arr[ii].value + '">' + arr[ii].title + '</option>';
        }
        $("select#rma_type").html(options);
        $("#customer_rma_num").valid();
    });

    // this creates date pickers for all the "date" fields in the RMA form
    $('#receipt_date').datepicker({
    	maxDate: new Date, 
        showOn: "button",
        buttonImage: "/images/icons/calendar.png",
        buttonImageOnly: true,
        dateFormat: 'yy-mm-dd',
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'S'],
        onSelect: function (text) {
            $("#show_receipt_date").html(text);
            $("#receipt_date").valid();
        }
    }).keyup(function () {
        $("#receipt_date").valid();
    });
    
    $('#shipped_date').datepicker({
    	maxDate: new Date,
        showOn: "button",
        buttonImage: "/images/icons/calendar.png",
        buttonImageOnly: true,
        dateFormat: 'yy-mm-dd',
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'S'],
        onSelect: function (text) {
            $("#show_shipped_date").html(text);
            $("#shipped_date").valid();
        }
    });

    $(".dateinput").datepicker({
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

    // look up the part number and part description based on the model code
    $("#iomega_sn").keyup(function () {
        var $val = $(this).val();

        if ($val.length > 1) {
            window.clearTimeout(rma.timeout);

            rma.timeout = window.setTimeout(function () {
                $.getJSON('/ajax/model_code', { mc: $val }, function (data) {
                    if (data) {
                        $('#ret_part_desc').val(data.DESCRIPTION);
                        $('#ret_part_num').val(data.PART_NUMBER);
                    }
                });
            }, 400);
        }
        else
            $('#ret_part_desc, #ret_part_num').val('');


        //$("#rma_form").valid();
        $("#iomega_sn").valid();
        $("#bare_hdd_sn").valid();
        //validate_sn_keyup(true);
    });

    $("#replacement_part_num").keyup(function () {
        var $val = $(this).val();
        if ($val.length == 8) {
            $.getJSON('/ajax/model_code', { part: $val }, function (data) {
                if (data)
                    $('#replacement_part_desc').val(data.DESCRIPTION);
            });
        }
        else
            $('#replacement_part_desc').val('');
    });

    $("#bare_hdd_sn").keyup(function () {
        $("#iomega_sn").valid();
        $("#bare_hdd_sn").valid();
    });

    $("#customer_rma_num").keyup(function () {
        $("#customer_rma_num").valid();
    });

    $("#company_name").autocomplete({
        source: "/ajax/company_name",
        minLength: 2
    });

    $('#clone').click(function () {
        $action = $('#rma_form').attr('action') + '?clone';
        $('#rma_form').attr('action', $action);
        $("#rma_form").submit();
    });

    $('#cancel').click(function () {
        document.location.replace('/index.php');
    });
});

$(document).ready(function () {
    $("#rma_form").validate({
        ignore: "DONTIGNORE",
        rules: {
            bare_hdd_sn: {
                requiredIfRmaType: {
                    param: [true, "exchange", "return"],
                    depends: "#iomega_sn:blank"
                }
            },
            customer_rma_num: {
                required: true,
                customerRMA: true
            },
            rma_type: {
                required: true
            },
            receipt_date: {
                requiredIfRmaType: [true, "exchange"]
            },
            shipped_date: {
                requiredIfRmaType: [true, "ship", "advance"]
            },
            iomega_sn: {
                requiredIfRmaType: {
                    param: [true,"exchange","return"],
                    depends: "#bare_hdd_sn:blank"
                },
                noIOQZ: true,
                remote:
                function () {
                    var rma = $("#customer_rma_num").val();
                    var rma_id = $("#rma_id").val();
                    return '/ajax/snrma?rma=' + rma + "&rma_id=" + rma_id;
                }
            }
        },
        messages: {
            customer_rma_num: {
                required: " Customer RMA Number is required."
            },
            customer_rma_type: {
                required: " RMA Type is required."
            },
            bare_hdd_sn: {
                requiredIfRmaType: " Either Iomega Serial or Bare HDD Serial is required."
            },
            receipt_date: {
                requiredIfRmaType: "Receipt date is required if RMA Type is 'Exchange'"
            },
            shipped_date: {
                requiredIfRmaType: "Shipped date is required if RMA Type is 'Ship Only' or 'Advance'"
            },
            iomega_sn: {
                requiredIfRmaType: " Either Iomega Serial or Bare HDD Serial is required.",
                remote: "Result message from remote" //jQuery.format("{0} is already in use.")
            }
        }//, debug:true
    });
});