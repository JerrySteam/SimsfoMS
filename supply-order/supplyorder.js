    
    $(document).on('click','#btnAddNewSupplyOrder', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddSupplyOrder').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewSupplyOrder.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New SupplyOrder Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddSupplyOrder')[0].reset();
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnViewSupplyOrder', function (e) {
        e.preventDefault();

        var supplyorder = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
        
        $.ajax({
            url: '../ajaxGetSupplyOrderView.php',
            type: 'POST',
            data: 'supplyorder='+supplyorder,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editSupplyOrderModal').modal('show');
        
    });

    $(document).on('click','.btnEditSupplyOrder', function (e) {
        e.preventDefault();

        var supplyorder = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
        
        $.ajax({
            url: '../ajaxGetSupplyOrderEditForm.php',
            type: 'POST',
            data: 'supplyorder='+supplyorder,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editSupplyOrderModal').modal('show');
        
    });

    $(document).on('click','#btnEditSupplyOrder', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddSupplyOrder').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditSupplyOrder.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editSupplyOrderModal').modal('hide');
                    showSwal("Success!", "Supply Order Record Successfully Updated.", "success", "Ok Cool!");
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

    $(document).on('click','.btnDeleteContainer2', function (e) {
        e.preventDefault();

        var containerid = $(this).attr('rel');

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxDeleteContainer.php',
            type: 'POST',
            data: 'containerid='+containerid,
            success: function (msg) {
                if(msg == 1){
                    showSwal("Success!", "Container Record Successfully Deleted.", "success", "Ok Cool!");
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

    $('.btnDeleteSupplyOrder').click(function(){
        var supplyorderid = $(this).attr('rel');
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
                    url: '../ajaxDeleteSupplyOrder.php',
                    type: 'POST',
                    data: 'supplyorderid='+supplyorderid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "Supply Order Record Successfully Deleted.", "success");
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