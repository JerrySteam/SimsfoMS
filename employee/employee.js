    
    $(document).on('click','#btnAddNewEmployee', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddEmployee').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewEmployee.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New Employee Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddEmployee')[0].reset();
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnEditEmployee', function (e) {
        e.preventDefault();

        var employeeid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
       
        $.ajax({
            url: '../ajaxGetEmployeeEditForm.php',
            type: 'POST',
            data: 'employeeid='+employeeid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editEmployeeModal').modal('show');
        
    });

    $(document).on('click','#btnEditEmployee', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddEmployee').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditEmployee.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editEmployeeModal').modal('hide');
                    showSwal("Success!", "Employee Record Successfully Updated.", "success", "Ok Cool!");
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

    $(document).on('click','.btnDeleteEmployee2', function (e) {
        e.preventDefault();

        var employeeid = $(this).attr('rel');

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxDeleteEmployee.php',
            type: 'POST',
            data: 'employeeid='+employeeid,
            success: function (msg) {
                if(msg == 1){
                    showSwal("Success!", "Employee Record Successfully Deleted.", "success", "Ok Cool!");
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

    $('.btnDeleteEmployee').click(function(){
        var employeeid = $(this).attr('rel');
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
                    url: '../ajaxDeleteEmployee.php',
                    type: 'POST',
                    data: 'employeeid='+employeeid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "Employee Record Successfully Deleted.", "success");
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