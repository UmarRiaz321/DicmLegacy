username: username,

<div class="table-reponsive box">
    <table id="userapp_table" class="table table-hover  table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th class="text-center" >Organisation</th>
                <th class="text-center">Unique Identifier</th>
                <th class="text-center" style="width:20%;">Action</th>
            </tr>
        </thead>
        <tbody id="user_tableReseuls">
        </tbody>
    </table> 
</div>
<script>
    $(document).on('click', '.transferUser', function(event) {

        var button = $(this);
        
        var userid = button.data('bs-usid');
        var uniq = button.data('bs-uniq');

        console.log("Transferring user:", userid);

        Swal.fire({
            title: 'Transferring User',
            text: 'Please wait while the user is being transferred...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: base_url+'trans', // replace with your actual endpoint
            method: 'POST',
            data: {
                usid: userid,
                uniq: uniq

            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'User Transferred',
                    text: 'The user has been successfully transferred.'
                });
                // Optionally, refresh table or update UI here
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Transfer Failed',
                    text: 'There was an error transferring the user.'
                });
            }
        });
  
    });
</script>