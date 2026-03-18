<div class="table-reponsive box">
    <table id="spo_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
        <thead>
                <tr>
                    <th class="text-center" >Organisation Name</th>
                    <th class="text-center">Registration</th>
                    <th class="text-center" style="width:25%;">Actions</th>
                </tr>
        </thead>
                <tbody id="spo_tableReseuls">
        </tbody>
    </table>
</div>

<!-- View Data pop up Modal  -->
<div class="modal fade" id="vSpoModal" tabindex="-1" aria-labelledby="vSpoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="vSpoModalLabel">Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="table-reponsive box">
                <table id="spoDetail_table" class="table table-hover  table-bordered table-striped" style="table-layout: fixed">
                <thead style="display:none;">
                <tr>
                    <th class="text-center" >Input</th>
                    <th class="text-center" style="width:80%;">Value</th>
                </tr>
                </thead>
                  <tbody id="spodetails" style="margin-top:2% !important"></tbody>
                  <tbody id="spoMCdetails" style="margin-top:2% !important"></tbody>
                  <tbody id="spoOCdetails" style="margin-top:2% !important"></tbody>
                  <tbody id="spoSOdetails" style="margin-top:2% !important"></tbody>
                </table> 
            </div>
       
      </div>
    </div>
  </div>
</div>

<!-- Send Marketing Email Modal -->
<div class="modal fade" id="spoEmailModal" tabindex="-1" aria-labelledby="spoEmailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="spoEmailModalLabel">Send Marketing Email</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="sponsorEmailId" value="">
        <div class="mb-3">
          <label class="form-label text-muted">Marketing Contacts</label>
          <ul class="list-group" id="sponsorContactsList"></ul>
        </div>
        <div class="mb-3">
          <label for="sponsorEmailSubject" class="form-label">Subject</label>
          <input type="text" id="sponsorEmailSubject" class="form-control" value="Message from Pluggin Ecosystem">
        </div>
        <div class="mb-3">
          <label for="sponsorEmailMessage" class="form-label">Message</label>
          <textarea id="sponsorEmailMessage" class="form-control" rows="10"></textarea>
          <small class="text-muted">You can customise this message before sending.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sendSponsorEmail">Send Email</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Mpodal -->
<div class="modal fade" id="spoDModal" tabindex="-1" aria-labelledby="spoDModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="spoDModalLabel">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"><p>Are you sure, you want to delete this user? You want be able to revert it.</p>
        <input type="hidden" id="spobase" value="">
     </div>
      <div class="modal-footer d-flex align-items-center justify-content-evenly">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="d-flex align-items-center justify-content-evenly">
                        <button type="button" id="dellSpo" class="btn btn-danger">Yes Delete it!</button>
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
        var SpoModal = document.getElementById('vSpoModal')
        SpoModal.addEventListener('show.bs.modal', function (event) {
            var spobutton = event.relatedTarget
            var id = spobutton.getAttribute('data-bs-whatever');
            $.ajax({url: base_url+'spoDetail?id='+id ,
                 type: 'GET',
                 success: function(result){ 
                    $('#spodetails').empty();
                    $('#spoMCdetails').empty();
                    $('#spoOCdetails').empty();
                    $('#spoSOdetails').empty();
                    let items = JSON.parse(result);
                    for (let [key, value] of Object.entries(items[0])) {
                        if(key=='mc'){
                          $('#spoMCdetails').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Main Contact</td></tr>`);
                          for (let [k, v] of Object.entries(value)) {$('#spoMCdetails').append(`<tr><td>${k}</td><td>${v}</td></tr>`);}
                        }else if(key=='oc'){
                          $('#spoOCdetails').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Other Account</td></tr>`);
                          for (let [k, v] of Object.entries(value)) {$('#spoOCdetails').append(`<tr><td>${k}</td><td>${v}</td></tr>`);}
                        }else if(key=='socials'){
                          $('#spoSOdetails').append(` <tr><td colspan="2" class="text-center fs-5 bg-secondary text-white ">Social Details</td></tr>`);
                          for (let [k, v] of Object.entries(value)) {$('#spoSOdetails').append(`<tr><td>${k}</td><td>${v}</td></tr>`);}
                        }else{
                          $('#spodetails').append(`
                            <tr>
                              <td>${key}</td>
                              <td>${value}</td>
                            </tr>
                          `);
                        }  
                    }        
                }});

        })

        var emailModal = document.getElementById('spoEmailModal');
        var defaultMarketingMessage = "Great news, your business has just joined the Pluggin Ecosystem.\n\nThis now provides some significant marketing and sales support opportunities, completely free of charge.\n\nOur Dual Impact Collaboration Marketplace (DICM) was built with and for UK public procurement bodies, it's the UK's first social value marketplace where social value is the brand differentiator buyers are looking for.\n\nAs the named marketing contact for your business membership of the Pluggin Ecosystem, we'll be reaching out to help your existing digital marketing operations extend into the DICM and help you promote real-time social value within contracts, directly into our public buyer audience across 44 marketplace areas.\n\nAlways-On Service\nhttps://pluggin.org/always-on\n\nThis regular e-newsletter and set of digital tools provide insights, tips and updates that will help you shape your social value marketing into the DICM.\n\nBest Regards,\nJay Baughan\nChief Executive, Pluggin Ecosystem.";

        emailModal.addEventListener('show.bs.modal', function (event) {
          var trigger = event.relatedTarget;
          var sponsorId = trigger.getAttribute('data-spo-id');
          var sponsorName = trigger.getAttribute('data-spo-name') || '';
          $('#sponsorEmailId').val(sponsorId);
          $('#sponsorEmailSubject').val('Your Pluggin Ecosystem Marketing Support');
          $('#sponsorEmailMessage').val(defaultMarketingMessage);
          $('#spoEmailModalLabel').text('Message to ' + sponsorName);
          $('#sponsorContactsList').html('<li class="list-group-item">Loading contacts…</li>');

          $.getJSON(base_url + 'admin/sponsors/contacts', { spo_id: sponsorId })
          .done(function(res) {
            if (res.success && Array.isArray(res.contacts) && res.contacts.length) {
              $('#sponsorContactsList').empty();
              res.contacts.forEach(function(contact) {
                var label = (contact.name ? contact.name + ' - ' : '') + contact.email;
                $('#sponsorContactsList').append('<li class="list-group-item d-flex justify-content-between align-items-center"><span>'+label+'</span></li>');
              });
            } else {
              $('#sponsorContactsList').html('<li class="list-group-item">No marketing contacts found.</li>');
            }
          })
          .fail(function() {
            $('#sponsorContactsList').html('<li class="list-group-item text-danger">Failed to load contacts.</li>');
          });
        });

        $('#sendSponsorEmail').on('click', function () {
          var sponsorId = $('#sponsorEmailId').val();
          var subject = $('#sponsorEmailSubject').val();
          var message = $('#sponsorEmailMessage').val();
          if (!message.trim()) {
            Swal.fire('Message required', 'Please enter a message before sending.', 'warning');
            return;
          }
          var $btn = $(this);
          $btn.prop('disabled', true).text('Sending...');
          $.ajax({
            url: base_url + 'admin/sponsors/send-email',
            type: 'POST',
            data: {
              spo_id: sponsorId,
              subject: subject,
              message: message
            },
            success: function (response) {
              var modalEl = document.getElementById('spoEmailModal');
              if (modalEl) {
                var modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modalInstance.hide();
              }
              Swal.fire('Email sent', 'Marketing email has been sent to the contacts.', 'success');
            },
            error: function (xhr) {
              var message = 'Unable to send email.';
              if (xhr.responseJSON) {
                if (xhr.responseJSON.message) {
                  message = xhr.responseJSON.message;
                }
                if (Array.isArray(xhr.responseJSON.errors) && xhr.responseJSON.errors.length) {
                  message += '<br><small>' + xhr.responseJSON.errors.join('<br>') + '</small>';
                }
              }
              Swal.fire({
                icon: 'error',
                title: 'Error',
                html: message
              });
            },
            complete: function () {
              $btn.prop('disabled', false).text('Send Email');
            }
          });
        });

        var sdModal = document.getElementById('spoDModal');
        sdModal.addEventListener('show.bs.modal', function (event) {
          var button = event.relatedTarget
          var rowid = button.getAttribute('data-bs-whatever');
          $('#spobase').val(rowid);
        })

        $('#spoDetail_table').DataTable( {
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
        });

        // 
        $('#dellSpo').on('click',function(){
          let rowId = $('#spobase').val();
          console.log("I am here"+ rowId);
          $.ajax({url: base_url+'dellSpo?id='+rowId ,
            type: 'GET',
            success: function(result){ 
              $('#spoDModal').modal('hide')
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
