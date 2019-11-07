$(document).ready(function () {
      //@naresh action dynamic childs
  var next = 0;
  $("#add-more").click(function(e){
      e.preventDefault();
      var addto = "#field" + next;
      var addRemove = "#field" + (next);
      next = next + 1;
      var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><div class="row"><div class="form-group col-md-8"> <label class="control-label">Description</label> <input class="form-control" type="text" name="description[]" placeholder="Enter expense description"></div><div class="form-group col-md-4"> <label class="control-label">Amount</label> <input class="form-control" type="number" min="1" name="amount[]" placeholder="Enter expense amount"></div></div></div>';
      var newInput = $(newIn);
      var removeBtn = '<div class="col-md-12 text-right"><button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div></div>';
      var removeButton = $(removeBtn);
      $(addto).after(newInput);
      $(addRemove).after(removeButton);
      $("#field" + next).attr('data-source',$(addto).attr('data-source'));
      $("#count").val(next);  
      
          $('.remove-me').click(function(e){
              e.preventDefault();
              var fieldNum = this.id.charAt(this.id.length-1);
              var fieldID = "#field" + fieldNum;
              $(this).remove();
              $(fieldID).remove();
          });
  });

});
$(document).on('click','#btnAddNewSupplyExpense', function (e) {
    e.preventDefault();

    //get user input
    var formData = $('#frmAddSupplyExpense').serialize();

    showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../addNewSupplyExpense.php',
        type: 'POST',
        data: formData,
        success: function (msg) {
            if(msg == 1){                    
                showSwal("Success!", "New Supply Expense Successfully Added.", "success", "Ok Cool!");
                $('#frmAddSupplyExpense')[0].reset();
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

$(document).on('click','.btnEditSupplyExpense', function (e) {
    e.preventDefault();

    var expenseid = $(this).attr('rel');
    var displayarena = $('#modalbody');

    displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
    
    $.ajax({
        url: '../getSupplyExpenseEditForm.php',
        type: 'POST',
        data: 'expenseid='+expenseid,
        success: function (msg) {
            displayarena.html(msg);
        },
        error: function(x,e) {
            displayarena.html(formatErrorMessage(x, e));
        }
    })

    $('#editSupplyExpenseModal').modal('show');
    
});

$(document).on('click','#btnEditSupplyExpense', function (e) {
    e.preventDefault();

    //get user input
    var formData = $('#frmAddSupplyExpense').serialize();

    showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
    
    $.ajax({
        url: '../editSupplyExpense.php',
        type: 'POST',
        data: formData,
        success: function (msg) {
            if(msg == 1){                    
                $('#editSupplyExpenseModal').modal('hide');
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

$('.btnDeleteSupplyExpense').click(function(){
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
                url: '../deleteSupplyExpense.php',
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