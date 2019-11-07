    
    $(document).on('click','#btnAddNewCustomer', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddCustomer').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewCustomer.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New Customer Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddCustomer')[0].reset();
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnEditCustomer', function (e) {
        e.preventDefault();

        var customerid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
       
        $.ajax({
            url: '../ajaxGetCustomerEditForm.php',
            type: 'POST',
            data: 'customerid='+customerid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editCustomerModal').modal('show');
        
    });

    $(document).on('click','#btnEditCustomer', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddCustomer').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditCustomer.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editCustomerModal').modal('hide');
                    showSwal("Success!", "Customer Record Successfully Updated.", "success", "Ok Cool!");
                    setTimeout((function(){ location.reload() }), 2000);
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnDeleteCustomer2', function (e) {
        e.preventDefault();

        var customerid = $(this).attr('rel');

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxDeleteCustomer.php',
            type: 'POST',
            data: 'customerid='+customerid,
            success: function (msg) {
                if(msg == 1){
                    showSwal("Success!", "Customer Record Successfully Deleted.", "success", "Ok Cool!");
                    setTimeout((function(){ location.reload() }), 2000);
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $('.btnDeleteCustomer').click(function(){
        var customerid = $(this).attr('rel');
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
                    url: '../ajaxDeleteCustomer.php',
                    type: 'POST',
                    data: 'customerid='+customerid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "Customer Record Successfully Deleted.", "success");
                            //showSwal("Success!", "Customer Record Successfully Deleted.", "success", "Ok Cool!");
                            setTimeout((function(){ location.reload() }), 2000);
                        }else {
                            swal("Oops!", msg, "error");
                            //showSwal('Oops!', msg, 'error', 'Close');
                        }
                    },
                    error: function(x,e) {
                        swal("Error!", formatErrorMessage(x, e), "error");
                        //showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
                    }
                })
            } else {
                swal("Cancelled", "Request Cancelled", "error");
            }
        });
    });