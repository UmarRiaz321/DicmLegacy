<div class="table-reponsive box">
    <table id="ena_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
        <thead>
            <tr>
                <th class="text-center" >Organisation Name</th>
                <th class="text-center">Type</th>
                <!-- <th class="text-center">Theme</th> -->
                <th class="text-center" style="width:20%;">View</th>
            </tr>
        </thead>
        <tbody id="cse_tableReseuls">
        </tbody>
    </table> 
</div>
<!-- View Data pop up Modal  -->
<div class="modal fade" id="vEnaModal" tabindex="-1" aria-labelledby="vEnaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vEnaModalLabel">Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="table-reponsive box">
                <table id="enaDetail_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
                <thead style="display:none;">
                <tr>
                    <th class="text-center" >Input</th>
                    <th class="text-center" style="width:80%;">Value</th>
                </tr>
                </thead>
                <tbody id="enadetails" style="margin-top=2% !important">
                </tbody>
                <tbody id="enaMcdetails" style="margin-top=2% !important">
                </tbody>
                <tbody id="enahmardetails" style="margin-top=2% !important">
                </tbody>
                <tbody id="enahprmdetails" style="margin-top=2% !important">
                </tbody>
                <tbody id="enahprodetails" style="margin-top=2% !important">
                </tbody>
                <tbody id="enasocialsdetails" style="margin-top=2% !important">
                </tbody>
                </table> 
            </div>
       
      </div>
    </div>
  </div>
</div>
<!-- Delete Mpodal -->
<div class="modal fade" id="enaDDModal" tabindex="-1" aria-labelledby="enaDDModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="enaDDModalLabel">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><p>Are you sure, you want to delete this user? You want be able to revert it.</p>
        <input type="hidden" id="base" value="">
     </div>
      <div class="modal-footer d-flex align-items-center justify-content-evenly">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="d-flex align-items-center justify-content-evenly">
                        <button type="button" id="dellEna" class="btn btn-danger">Yes Delete it!</button>
                        <button type="button" class="btn btn-secondary ml-1" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(function(){
        var EnaModal = document.getElementById('vEnaModal');
        EnaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-bs-whatever');
            console.log(id);
            $.ajax({url: base_url+'enaDetail?id='+id ,
                type: 'GET',
                success: function(result){ 
                    console.log(result);
    
                    $('#enadetails').empty();
                    let items = JSON.parse(result);
                    for (let [key, value] of Object.entries(items[0])) {
                        if(key == "mc"){
                            $('#enaMcdetails').empty();
                                
                            $('#enaMcdetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Main Contact</td></tr>
                            `);
                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#enaMcdetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }

                        }
                        else if(key == "hmar"){
                            $('#enahmardetails').empty();
    
                            $('#enahmardetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Head of Marketing</td></tr>
                            `);

                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#enahmardetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }

                        }else if(key == "hprm"){
                            $('#enahprmdetails').empty();
                            $('#enahprmdetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Head of PR & Media</td></tr>
                            `);

                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#enahprmdetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }


                        }else if(key=="hpro"){
                            $('#enahprodetails').empty();
                            $('#enahprodetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Head of Procurement</td></tr>
                            `);

                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#enahprodetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }

                        }else if(key =="socials"){
                            $('#enasocialsdetails').empty();
                            $('#enasocialsdetails').append(`
                                <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Socials</td></tr>
                            `);

                            for (let [k, v] of Object.entries(value)) {
                                
                                $('#enasocialsdetails').append(`
                                    <tr>
                                        <td>${k}</td>
                                        <td>${v}</td>
                                    </tr>
                                `);
                            }

                        }
                        else{
                            $('#enadetails').append(`
                                <tr>
                                    <td>${key}</td>
                                    <td>${value}</td>
                                </tr>

                            `);
                        }
                    }        
                }

            })
        })

        // Dell Modal
        var dellModal = document.getElementById('enaDDModal');
        dellModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var rowid = button.getAttribute('data-bs-whatever');
            $('#base').val(rowid);
        })

        $('#enaDetail_table').DataTable( {
            processing: false,
            serverSide: false,
            searching: false,
            paging: false,
            // dom: 'fBlrt',
            // buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            // lengthChange: false,
            // lengthMenu: [[10, 50, 100, -1], [10, 500, 100, "All"]]
            } );
        })



        $('#dellEna').on('click',function(){
            let rowId = $('#base').val();
            console.log(rowId);
            $.ajax({url: base_url+'dellEna?id='+rowId ,
                type: 'GET',
                success: function(result){ 
    
                    $('#enaDDModal').modal('hide')
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'User has been deleted',
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


</script>