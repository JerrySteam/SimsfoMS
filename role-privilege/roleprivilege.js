    
    $(document).on('click','#btnAddNewRolePrivilege', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddRolePrivilege').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewRolePrivilege.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New Role Privilege Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddRolePrivilege')[0].reset();
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnEditRolePrivilege', function (e) {
        e.preventDefault();

        var roleid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
       
        $.ajax({
            url: '../ajaxGetRolePrivilegeEditForm.php',
            type: 'POST',
            data: 'roleid='+roleid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editRolePrivilegeModal').modal('show');
        
    });

    $(document).on('click','#btnEditRolePrivilege', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddRolePrivilege').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditRolePrivilege.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editRolePrivilegeModal').modal('hide');
                    showSwal("Success!", "Role Privilege Record Successfully Updated.", "success", "Ok Cool!");
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

    $('.btnDeleteRolePrivilege').click(function(){
        var roleprivilegeid = $(this).attr('rel');
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
                    url: '../ajaxDeleteRolePrivilege.php',
                    type: 'POST',
                    data: 'roleprivilegeid='+roleprivilegeid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "Role Privilege Record Successfully Deleted.", "success");
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