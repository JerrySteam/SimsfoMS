    
    $(document).on('click','#btnAddNewBankAccount', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddBankAccount').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewBankAccount.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New Bank Account Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddBankAccount')[0].reset();
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnEditBankAccount', function (e) {
        e.preventDefault();

        var bankaccountid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
       
        $.ajax({
            url: '../ajaxGetBankAccountEditForm.php',
            type: 'POST',
            data: 'bankaccountid='+bankaccountid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editBankAccountModal').modal('show');
        
    });

    $(document).on('click','#btnEditBankAccount', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddBankAccount').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditBankAccount.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editBankAccountModal').modal('hide');
                    showSwal("Success!", "Bank Account Record Successfully Updated.", "success", "Ok Cool!");
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

    $(document).on('click','.btnDeleteBankAccount2', function (e) {
        e.preventDefault();

        var bankaccountid = $(this).attr('rel');

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxDeleteBankAccount.php',
            type: 'POST',
            data: 'bankaccountid='+bankaccountid,
            success: function (msg) {
                if(msg == 1){
                    showSwal("Success!", "Bank Account Record Successfully Deleted.", "success", "Ok Cool!");
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

    $('.btnDeleteBankAccount').click(function(){
        var bankaccountid = $(this).attr('rel');
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
                    url: '../ajaxDeleteBankAccount.php',
                    type: 'POST',
                    data: 'bankaccountid='+bankaccountid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "Bank Account Record Successfully Deleted.", "success");
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