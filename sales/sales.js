    
    $(document).ready(function () {
        //@naresh action dynamic childs
        var next = 0;
        $("#add-more").click(function(e){
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            var itm = $("#stock"+next).html();
            next = next + 1;
            var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><div class="row"><div class="form-group col-md-6 offset-2"><label for="exampleSelect1">Select Stock</label><select class="form-control stock" id="stock'+ next +'" rel="'+ next +'" name="stock[]"></select></div><div class="form-group col-md-2"><label class="control-label">Quantity</label><input class="form-control quantity" type="number" id="quantity'+ next +'" rel="'+ next +'" min="1" name="quantity[]" placeholder="Enter quantity"></div></div></div>';
            var itemreffieldid = "#stock"+next;
            
            var newInput = $(newIn);
            var removeBtn = '<div class="col-md-12 text-right"><button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div></div>';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#field" + next).attr('data-source',$(addto).attr('data-source'));
            $("#count").val(next);  

            $(itemreffieldid).html(itm);         
        });

        $(document).on('click', '.remove-me', function(e){
            e.preventDefault();
            var fieldNum = this.id.charAt(this.id.length-1);
            var fieldID = "#field" + fieldNum;

            var qty = $('#quantity'+fieldNum).val();
            var stock = $('#stock'+fieldNum+' :selected').attr('rel');

            if(qty > 0){
                var total = (qty * stock);
                var ototal = parseFloat($('#totalval').html());
                var ntotal = (ototal - total);
                total =  ntotal.toFixed(2);
                //alert(ototal);
                $('#salestotal').html('<b>Total: (&#8358;) <span id="totalval">'+total+'</span></b>');
            }

            $(this).remove();
            $(fieldID).remove();
        });
    });


    $(document).on('click','#btnAddNewSales', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddSales').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewSales.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New Sales Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddSales')[0].reset();
                    setTimeout((function(){ window.location.href = "../../sales-payment/add-new-sales-payment/" }), 4000);
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })
        
    });

    $(document).on('click','.btnViewSales', function (e) {
        e.preventDefault();

        var salesref = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
        
        $.ajax({
            url: '../ajaxGetSalesView.php',
            type: 'POST',
            data: 'salesref='+salesref,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editSalesModal').modal('show');
        
    });

    $(document).on('click','.btnEditSales', function (e) {
        e.preventDefault();

        var salesid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
        
        $.ajax({
            url: '../ajaxGetSalesEditForm.php',
            type: 'POST',
            data: 'salesid='+salesid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editSalesModal').modal('show');
        
    });

    $(document).on('click','#btnEditSales', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddSales').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditSales.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editSalesModal').modal('hide');
                    showSwal("Success!", "Sales Record Successfully Updated.", "success", "Ok Cool!");
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

    $('.btnDeleteSales').click(function(){
        var salesid = $(this).attr('rel');
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
                    url: '../ajaxDeleteSales.php',
                    type: 'POST',
                    data: 'salesid='+salesid,
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

    $(document).on('blur','.quantity', function (e) {
        e.preventDefault();
        var rel = $(this).attr('rel');
        var qty = parseInt($(this).val());
        var stock = $('#stock'+rel+' :selected').attr('rel');

        if(qty > 0){
            var total = (qty * stock);
            var ototal = parseFloat($('#totalval').html());
            var ntotal = (total + ototal);
            total =  ntotal.toFixed(2);
            //alert(ototal);
            $('#salestotal').html('<b>Total: (&#8358;) <span id="totalval">'+total+'</span></b>');
        }
        
    });

    function calculateUnitSellingPrice(costpriceid) {

        var rel = $(costpriceid).attr('rel');
        var quantityid = "#quantity"+rel;

        var costprice = parseFloat($(costpriceid).val());
        var quantity = parseFloat($(quantityid).val());
        var unitsellingpriceid = "#unitsellingprice"+rel;
        if ($(quantityid).val()=="" || $(quantityid).val() < 1) {
            $(unitsellingpriceid).html("Enter valid quantity");
        }else{
            var unitsellingprice = costprice / quantity;
            unitsellingprice = unitsellingprice.toFixed(2);
            //alert(unitsellingprice); exit;
            $(unitsellingpriceid).html(unitsellingprice);
        }       
    }