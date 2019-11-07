    $(document).ready(function () {
      //@naresh action dynamic childs
      var next = 0;
      $("#add-more").click(function(e){
          e.preventDefault();
          var addto = "#field" + next;
          var addRemove = "#field" + (next);
          var itm = $("#stockref"+next).html();
          next = next + 1;
          var newIn = ' <div id="field'+ next +'" name="field'+ next +'"><br><br><div class="row"><div class="form-group col-md-3"> <label class="control-label">Stock Reference</label> <select class="form-control stockref" id="stockref'+ next +'" rel="'+ next +'" name="stockref[]"></select></div><div class="form-group col-md-5"> <label class="control-label">Stock Name</label> <input class="form-control stockname" type="text" id="stockname'+ next +'" rel="'+ next +'" name="stockname[]" placeholder="stock name" readonly="readonly"></div><div class="form-group col-md-2"> <label class="control-label">Stock kg</label> <input class="form-control weight" type="number" id="weight'+ next +'" rel = "'+ next +'" name="weight[]" placeholder="stock kg" readonly="readonly"></div><div class="form-group col-md-2"> <label class="control-label">Quantity</label> <input class="form-control quantity" type="number" name="quantity[]" id="quantity'+ next +'" rel ="'+ next +'" placeholder="Enter quantity"></div><div class="form-group col-md-4"> <label class="control-label">Buying Price (<span class="double-strikethrough">N</span>)</label> <input class="form-control buyingprice" type="number" name="buyingprice[]" id="buyingprice'+ next +'" rel="'+ next +'" placeholder="Enter buying price" rel="'+ next +'"></div><div class="form-group col-md-4"> <label class="control-label">Cost Price (<span class="double-strikethrough">N</span>)</label> <input class="form-control costprice" type="number" name="costprice[]" id="costprice'+ next +'" rel="'+ next +'" placeholder="Cost price" readonly="readonly"></div><div class="form-group col-md-4"> <label class="control-label">Unit Selling Price (<span class="double-strikethrough">N</span>): <span style="color:red" id="unitsellingprice'+ next +'" class="usprice"></span></label> <input class="form-control unitsellingprice" type="number" name="unitsellingprice[]" id="unitsellingprice" rel="'+ next +'" placeholder="Enter unit selling price"></div></div></div>';

            var stockreffieldid = "#stockref"+next;
            

          var newInput = $(newIn);
          var removeBtn = '<div class="col-md-14 text-right"><button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >Remove</button></div></div></div>';
          var removeButton = $(removeBtn);
          $(addto).after(newInput);
          $(addRemove).after(removeButton);
          $("#field" + next).attr('data-source',$(addto).attr('data-source'));
          $("#count").val(next);  

            $(stockreffieldid).html(itm);
          
              $('.remove-me').click(function(e){
                  e.preventDefault();
                  var fieldNum = this.id.charAt(this.id.length-1);
                  var fieldID = "#field" + fieldNum;
                  $(this).remove();
                  $(fieldID).remove();
              });
      });
    });

    $(document).on('click','#btnAddNewStock', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddStock').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxAddNewStock.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    showSwal("Success!", "New Stock Successfully Added.", "success", "Ok Cool!");
                    $('#frmAddStock')[0].reset();
                    $('#ratio').html('');
                    $('#cpratio').val('');
                    $('.usprice').html('');
                }else {
                    showSwal('Oops!', msg, 'error', 'Close');
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })   
    });

    $(document).on('click','.btnViewStock', function (e) {
        e.preventDefault();

        var stockid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
        
        $.ajax({
            url: '../ajaxGetStockView.php',
            type: 'POST',
            data: 'stockid='+stockid,
            success: function (msg) {
                displayarena.html(msg);
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editStockModal').modal('show');  
    });

    $(document).on('click','.btnEditStock', function (e) {
        e.preventDefault();

        var stockid = $(this).attr('rel');
        var displayarena = $('#modalbody');

        displayarena.html('<svg class="m-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg>');
        
        $.ajax({
            url: '../ajaxGetStockEditForm.php',
            type: 'POST',
            data: 'stockid='+stockid,
            success: function (msg) {
                displayarena.html(msg);
                $("#container2").trigger("change");
            },
            error: function(x,e) {
                displayarena.html(formatErrorMessage(x, e));
            }
        })

        $('#editStockModal').modal('show');   
    });

    $(document).on('click','#btnEditStock', function (e) {
        e.preventDefault();

        //get user input
        var formData = $('#frmAddStock').serialize();

        showSwal('Please wait...', '   ', 'info', 'Ok. Cool!');
        
        $.ajax({
            url: '../ajaxEditStock.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                if(msg == 1){                    
                    $('#editStockModal').modal('hide');
                    showSwal("Success!", "Stock Record Successfully Updated.", "success", "Ok Cool!");
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

    $('.btnDeleteStock').click(function(){
        var stockid = $(this).attr('rel');
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
                    url: '../ajaxDeleteStock.php',
                    type: 'POST',
                    data: 'stockid='+stockid,
                    success: function (msg) {
                        if(msg == 1){
                            swal("Deleted!", "Stock Record Successfully Deleted.", "success");
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

    $(document).on('change','#container', function (e) {
        e.preventDefault();
        var containerid = this.value;
        $('#ratio').html('');
        $('#cpratio').val('');
        $('.stockref').html('');
        $('.stockname').val('');
        $('.weight').val('');
        $('.quantity').val('');
        $('.buyingprice').val('');
        $('.costprice').val('');
        $('.unitsellingprice').val('');
        $('.usprice').html('');
        $.ajax({
            url: '../ajaxAddNewStock.php',
            type: 'POST',
            data: 'stockcontainerid='+containerid,
            success: function (msg) {
                msg = JSON.parse(msg);
                //alert(msg['stocks']); exit;
                if(msg['error'] == '-1'){
                    $('#ratio').html('');
                    $('#cpratio').val('');
                    $('.stockref').html('');
                    $('.stockname').val('');
                    $('.weight').val('');
                    $('.quantity').val('');
                    $('.buyingprice').val('');
                    $('.costprice').val('');
                    $('.unitsellingprice').val('');
                    $('.usprice').html('');

                }else {
                    $('#ratio').html(msg['ratio']);
                    $('#cpratio').val(msg['ratio']);
                    $('.stockref').html(msg['stocks']);
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })    
    });

    $(document).on('change','#container2', function (e) {
        e.preventDefault();
        var containerid = this.value;
        /*
        $('#ratio').html('');
        $('#cpratio').val('');
        $('.stockref').html('');
        $('.stockname').val('');
        $('.weight').val('');
        $('.quantity').val('');
        $('.buyingprice').val('');
        $('.costprice').val('');
        $('.unitsellingprice').val('');
        $('.usprice').html('');*/
        $.ajax({
            url: '../ajaxAddNewStock.php',
            type: 'POST',
            data: 'stockcontainerid='+containerid,
            success: function (msg) {
                msg = JSON.parse(msg);
                //alert(msg['stocks']); exit;
                if(msg['error'] == '-1'){
                    /*
                    $('#ratio').html('');
                    $('#cpratio').val('');
                    $('.stockref').html('');
                    $('.stockname').val('');
                    $('.weight').val('');
                    $('.quantity').val('');
                    $('.buyingprice').val('');
                    $('.costprice').val('');
                    $('.unitsellingprice').val('');
                    $('.usprice').html('');*/

                }else {
                    $('#ratio').html(msg['ratio']);
                    $('#cpratio').val(msg['ratio']);
                    //$('.stockref').html(msg['stocks']);
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })    
    });

    $(document).on('change','.stockref', function (e) {
        e.preventDefault();
        var rel = $(this).attr('rel');
        var stockid = $(this).val();
        var stocknameid = "#stockname"+rel;
        var stockweightid = "#weight"+rel;
        $.ajax({
            url: '../ajaxAddNewStock.php',
            type: 'POST',
            data: 'itmid='+stockid,
            success: function (msg) {
                msg = JSON.parse(msg);
                if(msg['result'] == '-1'){
                    $(stocknameid).val('');
                    $(stockweightid).val('');
                }else {
                    $(stocknameid).val(msg['name']);
                    $(stockweightid).val(msg['weight']);
                }
            },
            error: function(x,e) {
                showSwal('Error!', formatErrorMessage(x, e), 'error', 'Close');
            }
        })    
    });

    $(document).on('change','.buyingprice', function (e) {
        e.preventDefault();
        var buyingprice = parseFloat(this.value);
        var cpratio = parseFloat($('#cpratio').val());
        var costprice = buyingprice * (1 + cpratio);
        costprice = costprice.toFixed(2);
        //alert(costprice);

        var rel = $(this).attr('rel');
        var costpriceid = "#costprice"+rel;
        $(costpriceid).val(costprice);
        calculateUnitSellingPrice(costpriceid);
    });

    $(document).on('change','.quantity', function (e) {
        e.preventDefault();
        var rel = $(this).attr('rel');
        var costpriceid= "#costprice"+rel;
        if($(costpriceid).val() !== ''){
            calculateUnitSellingPrice(costpriceid);
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


