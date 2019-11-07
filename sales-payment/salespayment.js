
$(document).on('click','#btnAddNewSalesPayment', function (e) {
    e.preventDefault();

    //get user input
    var formData = $('#frmAddSalesPayment').serialize();

    showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../ajaxAddNewSalesPayment.php',
        type: 'POST',
        data: formData,
        success: function (msg) {
            if(msg == 1){                    
                showSwal("Success!", "New Sales Payment Successfully Added.", "success", "Ok Cool!");
                $('#frmAddSalesPayment')[0].reset();
                setTimeout((function(){ window.location.href = "../sales-invoice/" }), 3000);
            }else {
                showSwal('Oops!', msg, 'error', 'Close');
            }
        },
        error: function(x,e) {
            showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
        }
    })
});

$(document).on('click','.btnViewSalesPayment', function (e) {
    e.preventDefault();
    
    var salesref = $(this).attr('rel');
    var displayarena = $('#modalbody');

    displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
    
    $.ajax({
        url: '../ajaxGetSalesPaymentView.php',
        type: 'POST',
        data: 'salesref='+salesref,
        success: function (msg) {
            displayarena.html(msg);
        },
        error: function(x,e) {
            displayarena.html(formatErrorMessage(x, e));
        }
    })

    $('#editSalesPaymentModal').modal('show');
});

$(document).on('click','.btnEditSalesPayment', function (e) {
    e.preventDefault();

    var salespayment = $(this).attr('rel');
    var displayarena = $('#modalbody');

    displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
    
    $.ajax({
        url: '../salesPaymentEditForm.php',
        type: 'POST',
        data: 'salespayment='+salespayment,
        success: function (msg) {
            displayarena.html(msg);
        },
        error: function(x,e) {
            displayarena.html(formatErrorMessage(x, e));
        }
    })

    $('#editSalesPaymentModal').modal('show');
});

$(document).on('click','#btnEditSalesPayment', function (e) {
    e.preventDefault();

    //get user input
    var formData = $('#frmAddSalesPayment').serialize();

    showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../ajaxEditSales.php',
        type: 'POST',
        data: formData,
        success: function (msg) {
            if(msg == 1){                    
                $('#editSalesPaymentModal').modal('hide');
                showSwal("Success!", "Sales Record Successfully Updated.", "success", "Ok Cool!");                
            }else {
                showSwal('Oops!', msg, 'error', 'Close');
            }
        },
        error: function(x,e) {
            showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
        }
    })
});

$(document).on('change','#salesid', function (e) {
    e.preventDefault();

    //get user input
    var salesid = $('#salesid :selected').val();

    showSwal('Retrieving Amount. Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../ajaxGetSalesAmount.php',
        type: 'POST',
        data: '&salesid='+salesid,
        dataType: 'JSON',
        success: function (res) {
            //console.log(res);
            if(res.message == 'error'){                    
                showSwal('Oops!', res.message, 'error', 'Close');
            }else {
                //$('#editSalesModal').modal('hide');
                $('#totalcost').val(res.totalcost);
                $('#outstanding').val(res.outstanding);
                Swal.close();
            }
        },
        error: function(x,e) {
            showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
        }
    })
});

$(document).on('blur','#amountpaid', function (e) {
    e.preventDefault();

    //get user input
    var amountpaid = $(this).val();
    var sid = $('#salesid :selected').val();

    if(amountpaid < 1){
        //showSwal('Error!', 'Please enter a valid amount', 'error', 'Close');
        return;
    }

    showSwal('Retrieving Outstanding. Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../ajaxGetSalesAmount.php',
        type: 'POST',
        data: '&amountpaid='+amountpaid+'&sid='+sid,
        dataType: 'JSON',
        success: function (res) {
            //console.log(res);
            if(res.message == 'error'){                    
                showSwal('Oops!', res.message, 'error', 'Close');
            }else {
                $('#bal').html("&nbsp;&nbsp;<span style='color:red;'>(Current Outstanding Balance: N"+res.outstanding+")</span>");
                Swal.close();
            }
        },
        error: function(x,e) {
            showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
        }
    }) 
});

$('.btnDeleteSalesPayment').click(function(){
    var salespaymentid = $(this).attr('rel');
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this record",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function(isConfirm) {
        if (isConfirm) {                
            $.ajax({
                url: '../deleteSalesPayment.php',
                type: 'POST',
                data: 'salespaymentid='+salespaymentid,
                success: function (msg) {
                    if(msg == 1){
                        swal("Deleted!", "Sales Record Successfully Deleted.", "success");
                        setTimeout((function(){ location.reload() }), 2000);
                    }else {
                        swal("Oops!", msg, "error");
                    }
                },
                error: function(x,e) {
                    swal("Error!", formatErrorMessage(x, e), "error");
                }
            })
        } else {
            swal("Cancelled", "Request Cancelled", "error");
        }
    });
});