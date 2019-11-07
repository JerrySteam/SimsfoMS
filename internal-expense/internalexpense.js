$(document).ready(function () {
      //@naresh action dynamic childs
      var next = 0;
      $("#add-more").click(function(e){
          e.preventDefault();
          var addto = "#field" + next;
          var addRemove = "#field" + (next);
          var employeelist = $("#approvedby"+next).html();
          next = next + 1;
          var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><div class="row"><div class="form-group col-md-6"><label class="control-label">Description</label><input class="form-control description" type="text" name="description[]" id="description'+ next +'" rel="'+ next +'" placeholder="Enter expense description"></div><div class="form-group col-md-3"><label class="control-label">Amount</label><input class="form-control amount" type="number" min="1" name="amount[]" id="amount'+ next +'" rel="'+ next +'" placeholder="Enter expense amount"></div><div class="form-group col-md-3"><label for="exampleSelect1">Approved by</label><select class="form-control approvedby" name="approvedby[]" id="approvedby'+ next +'" rel="'+ next +'"><?php echo loadEmployeeIntoCombo(); ?></select></div></div></div>';

          var approvedbyid = "#approvedby"+next;

          var newInput = $(newIn);
          var removeBtn = '<div class="col-md-12 text-right"><button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div></div>';
          var removeButton = $(removeBtn);
          $(addto).after(newInput);
          $(addRemove).after(removeButton);
          $("#field" + next).attr('data-source',$(addto).attr('data-source'));
          $("#count").val(next);

            $(approvedbyid).html(employeelist);

              $('.remove-me').click(function(e){
                  e.preventDefault();
                  var fieldNum = this.id.charAt(this.id.length-1);
                  var fieldID = "#field" + fieldNum;
                  $(this).remove();
                  $(fieldID).remove();
              });
      });

});
$(document).on('click','#btnAddNewInternalExpense', function (e) {
    e.preventDefault();

    //get user input
    var formData = $('#frmAddInternalExpense').serialize();

    showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../addNewInternalExpense.php',
        type: 'POST',
        data: formData,
        success: function (msg) {
            if(msg == 1){                    
                showSwal("Success!", "New Internal Expense Successfully Added.", "success", "Ok Cool!");
                $('#frmAddInternalExpense')[0].reset();
            }else {
                showSwal('Oops!', msg, 'error', 'Close');
            }
        },
        error: function(x,e) {
            showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
        }
    })
    
});

$(document).on('click','.btnEditInternalExpense', function (e) {
    e.preventDefault();
    //alert("yes"); exit;
    var expenseid = $(this).attr('rel');
    var displayarena = $('#modalbody');
    displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
    
    $.ajax({
        url: '../getInternalExpenseEditForm.php',
        type: 'POST',
        data: 'expenseid='+expenseid,
        success: function (msg) {
            displayarena.html(msg);
        },
        error: function(x,e) {
            displayarena.html(formatErrorMessage(x, e));
        }
    })

    $('#editInternalExpenseModal').modal('show');
    
});

$(document).on('click','#btnEditInternalExpense', function (e) {
    e.preventDefault();

    //get user input
    var formData = $('#frmAddInternalExpense').serialize();

    showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../editInternalExpense.php',
        type: 'POST',
        data: formData,
        success: function (msg) {
            if(msg == 1){                    
                $('#editInternalExpenseModal').modal('hide');
                showSwal("Success!", "Supply Expense Record Successfully Updated.", "success", "Ok Cool!");
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

$('.btnDeleteInternalExpense').click(function(){
    var expenseid = $(this).attr('rel');
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
                url: '../deleteInternalExpense.php',
                type: 'POST',
                data: 'expenseid='+expenseid,
                success: function (msg) {
                    if(msg == 1){
                        swal("Deleted!", "Supply Expense Successfully Deleted.", "success");
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