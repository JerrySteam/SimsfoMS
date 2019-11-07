    
    $(document).on('click','#btnAddNewContainer', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddContainer').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewContainer.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New Container Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddContainer')[0].reset();
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnViewContainer', function (e) {
        e.preventDefault();

        var containerid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
        
        $.ajax({
            url: '../ajaxGetContainerView.php',
            type: 'POST',
            data: 'containerid='+containerid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editContainerModal').modal('show');
        
    });

    $(document).on('click','.btnEditContainer', function (e) {
        e.preventDefault();

        var containerid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<img src="../../@assets/images/icon/ic.gif"> Processing Request');
        
        $.ajax({
            url: '../ajaxGetContainerEditForm.php',
            type: 'POST',
            data: '&containerid='+containerid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editContainerModal').modal('show');
        
    });

    $(document).on('click','#btnEditContainer', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddContainer').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditContainer.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editContainerModal').modal('hide');
                    showSwal("Success!", "Container Record Successfully Updated.", "success", "Ok Cool!");
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

    $('.btnDeleteContainer').click(function(){
        var containerid = $(this).attr('rel');
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
                    url: '../ajaxDeleteContainer.php',
                    type: 'POST',
                    data: 'containerid='+containerid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "Container Record Successfully Deleted.", "success");
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