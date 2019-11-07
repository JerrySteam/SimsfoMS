//function to remove commas from incoming comma separated amounts
function formatAmount(value)
{
    value = value.replace(/,/g, '');
    value = parseFloat(value);
    return value;
}

function formatErrorMessage(jqXHR, exception) 
{
    if (jqXHR.status === 0) {
        return ('Not connected.\nPlease verify your network connection.');
    } else if (jqXHR.status == 404) {
        return ('The requested page not found. [404]');
    } else if (jqXHR.status == 500) {
        return ('Internal Server Error [500].');
    } else if (exception === 'parsererror') {
        return ('Requested JSON parse failed.');
    } else if (exception === 'timeout') {
        return ('Time out error.');
    } else if (exception === 'abort') {
        return ('Ajax request aborted.');
    } else {
        return ('Uncaught Error.\n' + jqXHR.responseText);
    }
}

function showSwal(title, text, type, btntext)
{
    const btnSwal = Swal.mixin({
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false,
    });

    animate = '';
    btnCancel = '';
    btnConfirm = '';

    if(type == 'error'){
        animate = 'animated shake';
        btnCancel = true;
        btnConfirm = false;
    }else if(type == 'success'){
        animate = 'animated heartBeat';
        btnCancel = false;
        btnConfirm = true;
    }else if(type == 'info'){
        animate = 'animated fadeInDown';
        btnCancel = false;
        btnConfirm = false;
    }

    btnSwal.fire({
        title: title,
        text: text,
        type: type,
        showCancelButton: btnCancel,
        showConfirmButton: btnConfirm,
        confirmButtonText: btntext,
        cancelButtonText: btntext,
        animation: false,
        customClass: animate
    })
}

function doLogin()
{
    //login function
    $(document).on('click','#btnSignin', function (e) {
        e.preventDefault();
        //get user input
        var displayarena = $('#modalbody');
        var formData = $('.login-form').serialize();

        displayarena.html('<img src="./@assets/images/icon/ic.gif"> Validating Credentials'); 
        
        $.ajax({
            url: './processLogin.php',
            type: 'POST',
            data: formData,
            success: function (msg) {
                //displayarena.html('<div class="alert alert-danger col-lg-12">'+msg+'</div>'); exit;
                if(msg == 1){
                    displayarena.html('<img src="./@assets/images/icon/ic.gif"> Preparing your dashboard');
                    setTimeout((function(){ window.location = './dashboard/'  }), 1000);
                }else {
                    displayarena.html('<div class="alert alert-danger col-lg-12">'+msg+'</div>');
                }

            },
            error: function(x,e) {
                displayarena.html('<h4 class="text-danger text-center">'+formatErrorMessage(x, e)+'</h4>');
            }
        })
        $('#genmodal').modal("show");
    });
}