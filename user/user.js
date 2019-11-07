    
    $(document).on('click','#btnAddNewUser', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddUser').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewUser.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New User Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddUser')[0].reset();
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnEditUser', function (e) {
        e.preventDefault();

        var userid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
       
        $.ajax({
            url: '../ajaxGetUserEditForm.php',
            type: 'POST',
            data: 'userid='+userid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editUserModal').modal('show');
        
    });

    $(document).on('click','#btnEditUser', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddUser').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditUser.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editUserModal').modal('hide');
                    showSwal("Success!", "User Record Successfully Updated.", "success", "Ok Cool!");
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

    $('.btnDeleteUser').click(function(){
        var Userid = $(this).attr('rel');
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
                    url: '../ajaxDeleteUser.php',
                    type: 'POST',
                    data: 'userid='+userid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "User Record Successfully Deleted.", "success");
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