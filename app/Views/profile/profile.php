<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<?= $this->include('profile/charities') ?>
<?= $this->include('profile/editModels') ?>
<div>
<script>

  $(document).ready(function(){
    let userdata = <?= $data ?>;
    var cse_data = [];

    for (const [key, value] of Object.entries(userdata)) {
      console.log(`${key}: ${value}`);

      switch (key) {
        case 'charity':
          cseProfile(value);
          cse_data = value;
          break;
      
        default:
          break;
      }
    }


    $('#UCseModal').on('show.bs.modal',function(){
      console.log(cse_data[0]);

     let regNo = cse_data[0]["Charity Registration Number"]?cse_data[0]["Charity Registration Number"]:"N/A";
     let SerNo = cse_data[0]["Social Enterprise Registration Number"]?cse_data[0]["Social Enterprise Registration Number"]:"N/A";
     let reg = cse_data[0]["Regions"].trim().split(',');
     let cs = "";
     cs = cse_data[0]["Current Sponsors"].substring(0, cse_data[0]["Current Sponsors"].length - 1).trim().split(';');
    //  let currentS = [];
    //  currentS.splice(0,currentS.length);
    //  $.each(cs,function(i,v){
    //   if(v != ""){
    //     currentS.push(v);
        
    //   }

    //  })
     
     setOptions( $('#cse_Regions'),reg);
    //  setOptions( $('#cse_Type'),cse_data[0]["CSE Type"]);
    //  setOptions(  $('#cse_Theme'),cse_data[0]["CSE Theme"]);
     setOptions(  $('#cse_CurrentSupporters'),cs);


      $('#cse_OrgName').val(cse_data[0]["Organisation Name"]);
      $('#cse_YearFounded').val(cse_data[0]["Organisation Founded Year"]);
      $('#cse_RegisteredNo').val(regNo);
      $('#cse_SERNo').val(SerNo);
      // $('#cse_Type').val(cse_data[0]["CSE Type"]);
      // $('#cse_CurrentSupporters').val(cse_data[0][""]);
      $('#cse_AIncome').val(cse_data[0]["Annual Income"]);
      // $('#cse_Theme').val(cse_data[0]["CSE Theme"]);
      $('#cse_Regions').val(cse_data[0]["Regions"]);
      $('#cse_referer').val(cse_data[0]["Reference Number"]);
      $('#cse_id').val(cse_data[0]["id"]);
    })

    var form = $("#UcDForm");
    var validator = form.validate({
        debug: false,
        success: "valid",
        ignore: ["name"],
    });

    $('#UpdCseD').on('click', function(e){
      e.preventDefault(); // Prevent the form from submitting normally.
        if(form.valid()){       
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
                  Swal.fire(
                    {
                      icon: 'success',
                      title : response.message,
                      text: 'Updates Successfully.',
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
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!' + status + error
                    })
              }
  
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

</script>

</div>


<?= $this->endSection() ?>


