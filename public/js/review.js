$(function(){
     var valid = true;
    $(".next, .backToSum").on("click", function () {
        let id = $(this).attr('id');
        switch(id){
            case "secondToReview":
            case "second":
              addToReview("OrgDetails",$("#orginfobody"));
              break;
            case "thirdToReview":
            case "third":
              addToReview("MainContact",$("#Mcinfobody"));
              break;
            case "fourthToReview":
            case "fourth":
              addToReview("ProjectDetail",$("#Proinfobody"));
              break;
            case "fifthToReview":
            case "fifth":
              addToReview("SocialsDetail",$("#Socialsinfobody"));
              break;
            //Sponsors 
            case "sposecondToReview":
            case "sposecond":
              addToReview("SpoOrgDetails",$("#spoorginfobody"));
              break;
            case "spothirdToReview":
            case "spothird":
              addToReview("SpoMainContact",$("#spoMcinfobody"));
              break;
            case "spofourthToReview":
            case "spofourth":
              addToReview("SpoAccountDetail",$("#accountinfobody"));
              break;
            case "spofifthToReview":
            case "spofifth":
              addToReview("SpoSocialsDetail",$("#SpoSocialsinfobody"));
              break;
              
            // Enablers
            case "enasecondToReview":
            case "enasecond":
              addToReview("EnaOrgDetails",$("#enaorginfobody"));
              break;
            case "enathirdToReview":
            case "enathird":
              addToReview("EnaMainContact",$("#enaMcinfobody"));
              break;
            case "enafourthToReview":
            case "enafourth":
              addToReview("EnaConDetails",$("#occinfobody"));
              break;
            case "enafifthToReview":
            case "enafifth":
              addToReview("EnaSocialsDetail",$("#EnaSocialsinfobody"));
              break;
            default:
              break;
          }
    });


    // $("#vcsejoin").on('submit', function(e){
    //     e.preventDefault(); // Prevent the form from submitting normally.
    //     if ($('#orginfobody').find('.table-danger').length > 0 || $('#Mcinfobody').find('.table-danger').length > 0 || $('#Proinfobody').find('.table-danger').length > 0 || $('#Socialsinfobody').find('.table-danger').length > 0) {
    //       valid = false;
    //     }
    //    if(valid){
    //     var formData = $(this).serialize();  // Serialize the form data.
    //     $.ajax({
    //         type: 'POST',
    //         url: $(this).attr('action'),
    //         data: formData,
    //         dataType : "JSON",
    //         success: function(response) {
    //             // Handle the response from the server.
    //             // console.log(response)
    //             Swal.fire(
    //               {
    //                 icon: 'success',
    //                 title : response.message,
    //                 text: 'You will be contacted shortly after administrative approval.',
    //                 color: '#8CB61D'
    //               }
    //             ).then((result)=>{
    //               if (result.isConfirmed) {
    //                 location.reload();
    //               }
    //             })

    //             // You can update the UI or perform other actions as needed.
    //         },
    //         error: function(xhr, status, error) {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: 'Something went wrong!' + status + error,
    //                 footer: '<a href="">Please try again later</a>'
    //               })
    //         }

    //     });
    //   }else{
    //     Swal.fire({
    //       icon: 'error',
    //       title: 'Form is not Valid',
    //       text: 'Please Review your details again',
    //       footer: '<a href="">Please try again later</a>'
    //     })
    //   }
    // })


})