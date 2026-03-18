$(document).ready(function () {


    $("#pro_Purposerem").html(700 + " characters maximum.");

    $("#pro_Purpose").keyup(function () {
        if (this.value.length > 200) {
          return false;
        }
        if (this.value.length < 1) {
          $("#pro_Purposerem").html(700 - this.value.length + " characters maximum.");
        } else {
          $("#pro_Purposerem").html(700 - this.value.length + " character left.");
        }
    });

    $("#pro_pccfunding").on('change', function () {
        var fundingDetailsSection = $('#fundingDetails');
        var fundingDetailsTextarea = $('#pro_fundingDetails');
        if ($(this).val() == '1') {
            $(fundingDetailsTextarea).removeAttr('disabled');
        } else {
            $(fundingDetailsTextarea).attr('disabled', 'disabled');
            $(fundingDetailsTextarea).val('');
        }
    } );


    // Update Password

    $('#Npass').on('focus', function() {
      $('#password-requirements').show();
  });

  $('#Npass').on('blur', function() {
      $('#password-requirements').hide();
  });
  $('#Npass').on('keyup', function() {
      var password = $(this).val();

      // Check length
      if (password.length >= 8) {
          $('#length').css('color', 'green');
      } else {
          $('#length').css('color', 'red');
      }

      // Check uppercase
      if (/[A-Z]/.test(password)) {
          $('#uppercase').css('color', 'green');
      } else {
          $('#uppercase').css('color', 'red');
      }

      // Check lowercase
      if (/[a-z]/.test(password)) {
          $('#lowercase').css('color', 'green');
      } else {
          $('#lowercase').css('color', 'red');
      }

      // Check number
      if (/[0-9]/.test(password)) {
          $('#number').css('color', 'green');
      } else {
          $('#number').css('color', 'red');
      }
      
      // Extend with other requirements as needed
  });

});