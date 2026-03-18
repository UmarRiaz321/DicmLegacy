
<div class="table-reponsive box">
    <table id="app_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
        <thead>
            <tr>
                <th class="text-center" >Organisation</th>
                <th class="text-center">Type</th>
                <!-- <th class="text-center">Theme</th> -->
                <th class="text-center" style="width:20%;">Action</th>
            </tr>
        </thead>
        <tbody id="app_tableReseuls">
        </tbody>
    </table> 
</div>
<!-- View Data pop up Modal  -->
<div class="modal fade" id="vUappModal" tabindex="-1" aria-labelledby="vUappModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vUappModalLabel">User Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="table-reponsive box">
                <table id="appDetail_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
                <thead style="display:none;">
                <tr>
                    <th class="text-center" >Input</th>
                    <th class="text-center" style="width:80%;">Value</th>
                </tr>
                </thead>
                    <tbody id="Adetails" style="margin-top=2% !important"></tbody>
                    <tbody id="Amaincontact" style="margin-top=2% !important"></tbody>
                    

                    <tbody id="AspoOCdetails" style="margin-top:2% !important"></tbody>


                    <tbody id="Acseproject" style="margin-top=2% !important"></tbody>


                    <tbody id="Ahmardetails" style="margin-top=2% !important"></tbody>
                    <tbody id="Ahprmdetails" style="margin-top=2% !important"></tbody>
                    <tbody id="Ahprodetails" style="margin-top=2% !important"></tbody>


                    <tbody id="Aotheraccoount" style="margin-top=2% !important"></tbody>



                    <tbody id="Asocials" style="margin-top:2% !important"></tbody>

                </table> 
            </div>
       
      </div>
    </div>
  </div>
</div>

<!-- User Approve Modal -->
<div class="modal fade" id="vAppModal" tabindex="-1" aria-labelledby="vAppModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vAppModalLabel">Approve User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>By approving you are accepting details provided by the user, a user account will be registed after your approval.</p>
        <input type="hidden" id="u_approve" value="">
      </div>
      <div class="modal-footer d-flex align-items-center justify-content-evenly">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="d-flex align-items-center justify-content-evenly">
                        <button type="button" id="appUser" class="btn notaction-button">Approve</button>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
<!-- User Review Modal -->
<div class="modal fade" id="appRModal" tabindex="-1" aria-labelledby="appRModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="appRModalLabel">Review User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                
            <input type="hidden" id="u_review" name="u_review" value="">
            <div class="row mt-3 p-0">
                <div class="form-group col-lg-12 col-md-12 col-12">
                    <label for="r_reason">Reason of not approving this user</label>
                    <textarea type="text" placeholder="Reason of not approving this user" required rows="3" minlength="1" maxlength="500" class="form-control" name="r_reason" id="r_reason" style="overflow: hidden visible; overflow-wrap: break-word; resize: none;"></textarea>
                </div>
            </div>
      </div>
      <div class="modal-footer d-flex align-items-center justify-content-evenly">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="d-flex align-items-center justify-content-evenly">
                        <button type="button" id="s_email"  class="btn notaction-button">Send Email</button>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(function(){
        var UnAppM = document.getElementById('vUappModal'); //vUappModal
        UnAppM.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-bs-whatever');
            $('#Adetails').empty();
            $('#Amaincontact').empty();

            $('#Acseproject').empty();
            $('#Ahmardetails').empty();
            $('#Ahprmdetails').empty();
            $('#Ahprodetails').empty();
            $('#Aotheraccoount').empty();

            $('#Asocials').empty();
            $.ajax({url: base_url+'appDetail?id='+id ,
                type: 'GET',
                success: function(result){
                    let items = JSON.parse(result);
                    console.log(items);
                    for (let [key, value] of Object.entries(items[0])) {
                        if(key=='mc'){
                            $('#Amaincontact').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Main Contact</td></tr>`);
                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#Amaincontact').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }
                        }
                        else if(key=='projects'){
                            if(Array.isArray(value) && value.length){
                                $('#Acseproject').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Project Details</td></tr>`);
                                value.forEach(function(project, index){
                                    $('#Acseproject').append(`
                                        <tr><td colspan="2" class="text-center fw-bold">Project ${index + 1}</td></tr>
                                    `);
                                    for (let [k, v] of Object.entries(project)) {
                                        $('#Acseproject').append(`
                                            <tr>
                                                <td>${k}</td>
                                                <td>${(v !== null && v !== undefined) ? v : ''}</td>
                                            </tr>
                                        `);
                                    }
                                });
                            }
                        }
                        else if(key=='pro'){
                            continue;
                        }
                        else if(key=='socials'){
                            $('#Asocials').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Social Details</td></tr>`);
                            for (let [k, v] of Object.entries(value)) {
                                $('#Asocials').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }
                        } else if(key == "hmar"){
                            $('#Ahmardetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Head of Marketing</td></tr>
                            `);
                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#Ahmardetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }

                        }else if(key == "hprm"){
                            $('#Ahprmdetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Head of PR & Media</td></tr>
                            `);

                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#Ahprmdetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }


                        }else if(key=="hpro"){
                            $('#Ahprodetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Head of Procurement</td></tr>
                            `);

                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#Ahprodetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }

                        }else if(key=='oc'){
                          $('#Aotheraccoount').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Other Account</td></tr>`);
                          for (let [k, v] of Object.entries(value)) {$('#Aotheraccoount').append(`<tr><td>${k}</td><td>${v}</td></tr>`);}
                        }
                        else{
                            $('#Adetails').append(`
                                <tr>
                                    <td>${key}</td>
                                    <td>${value}</td>
                                </tr>

                            `);
                        }

                    }


                }
  

            })//EndofAjax
        });//EndOfEventListner

        // vAppModal Approve Modal
        var UserApprove = document.getElementById('vAppModal');
        UserApprove.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var rowid = button.getAttribute('data-bs-whatever');
            $('#u_approve').val(rowid);
        });
        $('#appUser').on('click',function(){
            let rowId = $('#u_approve').val();
            console.log(rowId);
            $.ajax({url: base_url+'appUser?id='+rowId ,
                type: 'GET',
                success: function(result){ 

                     console.log(result)
                    $('#vAppModal').modal('hide')
                    // Swal.fire({
                    //     title: '<strong>Following User is approved</strong>',
                    //     icon: 'success',
                    //     html:result,
                    //     showCloseButton: true,
                    //     showCancelButton: true,
                    //     focusConfirm: false,
                    //     confirmButtonText:
                    //         '<i class="fa fa-thumbs-up"></i> Great!',
                    //     confirmButtonAriaLabel: 'Thumbs up, great!',
                    //     cancelButtonText:
                    //         '<i class="fa fa-thumbs-down"></i>',
                    //     cancelButtonAriaLabel: 'Thumbs down'
                    // })
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'User has been approved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    })
                    
                }
            })
        })

        // Review Page appRModal
        var ReviewM = document.getElementById('appRModal');
        ReviewM.addEventListener('show.bs.modal',function(event){
            var button = event.relatedTarget
            var rowid = button.getAttribute('data-bs-whatever');
            $('#u_review').val(rowid);
            $('#r_reason').val('');
        });

        $('#s_email').on('click',function(){
            let rowId = $('#u_review').val();
            let message = $('#r_reason').val();

       
            $.ajax({
                url: base_url+'review',
                data: {id:rowId , message:message},
                type: 'GET',
                success: function(result){ 
                    $('#appRModal').modal('hide');
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Email has been sent to the main contact',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            location.reload();
                        }
                    })
                    
                }
            })

        })



    })

</script>
