
<div class="table-reponsive box">
    <table id="cse_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
        <thead>
            <tr>
                <th class="text-center" >Organisation Name</th>
                <!-- <th class="text-center">Type</th> -->
                <!-- <th class="text-center">Theme</th> -->
                <th class="text-center" style="width:20%;">View</th>
            </tr>
        </thead>
        <tbody id="cse_tableReseuls">
        </tbody>
    </table> 
</div>


<div class="modal fade" id="vCseModal" tabindex="-1" aria-labelledby="vCseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vCseModalLabel">Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="table-reponsive box">
            <table id="cseDetail_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
                  <thead style="display:none;">
                    <tr><th class="text-center" >Attribute</th><th class="text-center" style="width:80%;">Value</th></tr>
                  </thead>
                  <tbody id="details" style="margin-top=2% !important"></tbody>
                  <tbody id="csemc" style="margin-top=2% !important"></tbody>
                  <tbody id="cseproject" style="margin-top=2% !important"></tbody>
                  <tbody id="csesocials" style="margin-top=2% !important"></tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</div>

<!-- Delete Mpodal -->
<div class="modal fade" id="cseDModal" tabindex="-1" aria-labelledby="cseDModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="cseDModalLabel">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><p>Are you sure, you want to delete this user? You want be able to revert it.</p>
        <input type="hidden" id="csebase" value="">
     </div>
      <div class="modal-footer d-flex align-items-center justify-content-evenly">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="d-flex align-items-center justify-content-evenly">
                        <button type="button" id="dellCse" class="btn btn-danger">Yes Delete it!</button>
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
      // Dell Modal
      var dellModal = document.getElementById('cseDModal');
      dellModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var rowid = button.getAttribute('data-bs-whatever');
        $('#csebase').val(rowid);
      })
      $('#dellCse').on('click',function(){
            let rowId = $('#csebase').val();
            console.log("I am here"+ rowId);
            $.ajax({url: base_url+'dellCse?id='+rowId ,
                type: 'GET',
                success: function(result){ 
    
                    $('#cseDModal').modal('hide')
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
  })


</script>
