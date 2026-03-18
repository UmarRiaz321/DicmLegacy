$(function(){
    var form = $("#enablerjoin");
    var mainEmailField = $("#emcd_Email");
    var duplicateEmailMessage = "User already exists, please login.";

    var validator = form.validate({
        debug: false,
        success: "valid",
        ignore: ["name"],
    });

    function csrfPayload() {
        var csrf = (typeof getCsrf === 'function') ? getCsrf() : { name: '', value: '' };
        var payload = {};
        if (csrf.name && csrf.value) {
            payload[csrf.name] = csrf.value;
        }
        return payload;
    }

    function checkMainContactEmail(email, done) {
        var payload = $.extend({ email: email }, csrfPayload());
        $.ajax({
            type: "POST",
            url: "/signup/check-email",
            data: payload,
            dataType: "JSON"
        }).done(function(response) {
            if (typeof updateCsrfFromResponse === 'function') {
                updateCsrfFromResponse(response);
            }
            done(!!(response && response.exists), response || {});
        }).fail(function() {
            done(false, {});
        });
    }

    function markDuplicateIfNeeded() {
        var email = $.trim(mainEmailField.val() || "");
        if (!email) {
            mainEmailField.data("emailExists", false);
            return;
        }
        checkMainContactEmail(email, function(exists) {
            mainEmailField.data("emailExists", exists);
            if (exists) {
                var err = {};
                err[mainEmailField.attr("name")] = duplicateEmailMessage;
                validator.showErrors(err);
            }
        });
    }

    mainEmailField.on("blur", markDuplicateIfNeeded);

    // ENA Form Submission and form Validations

    $("#enasubmit").on('click', function(e){
        e.preventDefault(); // Prevent the form from submitting normally.
        if(form.valid()){       
            var email = $.trim(mainEmailField.val() || "");
            checkMainContactEmail(email, function(exists) {
                if (exists) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Account already exists',
                        text: duplicateEmailMessage
                    });
                    return;
                }

                var formData = $(form).serialize();  // Serialize the form data.
                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: $(form).attr('action'),
                    data: formData,
                    dataType : "JSON",
                    success: function(response) {
                        // Handle the response from the server.
                        console.log(response)
                        if (typeof updateCsrfFromResponse === 'function') {
                            updateCsrfFromResponse(response);
                        }
                        Swal.fire(
                          {
                            icon: 'success',
                            title : response.message,
                            text: 'You will be contacted shortly after administrative approval.',
                            color: '#8CB61D'
                          }
                        ).then((result)=>{
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        })
        
                        // You can update the UI or perform other actions as needed.
                    },
                    error: function(xhr, status, error) {
                       console.log(xhr);
                       console.log(status);
                       console.log(error);
                        var response = xhr && xhr.responseJSON ? xhr.responseJSON : {};
                        var message = response.message || ('Something went wrong! ' + status + ' ' + error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: message
                          })
                    }
        
                });
            });

        }else{

          Swal.fire({
            icon: 'error',
            title: 'Invalid Input',
            text: 'Please Review Again Before submission',
          })

        }
       

    })

})
