<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="MidContainer">
    <div class="multi_step_form">
        <form action="<?php base_url('/sponsorships/create')?>" class="msform" method="post" id="sponsorshipForm">
            <?= csrf_field() ?>
            <fieldset id="spo_fieldset">
                <div class="tittle text-center">
                    <h4>Social Value Proposal Form</h4>
                    <small>Please complete the form to create your social value proposal document.</small>
                </div>
                <hr>
                <div id="sponsorship">
                    <div class="row mb-3">
                        <div class="col-6 form-group">
                            <label for="charityName" class="form-label">CSE Name</label>
                            <input type="text" class="form-control" id="charityName" name="charity_name" value="<?= esc($charity_name, 'attr') ?>" readonly>
                            <input type="text" class="form-control" id="charityId" name="charity_id" value="<?= esc($charity_id, 'attr') ?>" hidden>
                            <input type="hidden" id="projectId" name="project_id" value="<?= esc($project_token, 'attr') ?>">
                            <input type="text" class="form-control" id="sponsorEmail"  name="sponsor_email" value="<?= esc($sponsor_email, 'attr') ?>" hidden>
                        </div>
                        <div class="col-6 form-group">
                            <label for="charityUI" class="form-label">CSE Unique Identifier</label>
                            <input type="text" class="form-control" id="charityUI" name="charity_ui" value="<?= esc($charity_username, 'attr') ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 form-group">
                            <label for="activityName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="activityName" name="project_name" value="<?= esc($project_name, 'attr') ?>" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="activityPurpose" class="form-label">Purpose</label>
                            <input type="text" class="form-control" id="activityPurpose" name="project_purpose" value="<?= esc($project_purpose, 'attr') ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 form-group">
                            <label for="keyObjectives" class="form-label">Key Objectives</label>
                            <textarea class="form-control" id="keyObjectives" name="key_objectives" readonly><?= esc($key_objectives) ?></textarea>
                        </div>
                        <div class="col-6 form-group">
                            <label for="additional_resources" class="form-label">How the funding will work</label>
                            <textarea class="form-control" id="additional_resources" name="additional_resources" readonly><?= esc($additional_resources) ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6 form-group">
                            <label for="sponsorName" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="sponsorName" name="sponsor_name" value="<?= esc($sponsor_name, 'attr') ?>" readonly />
                        </div>
                        <div class="col-6 form-group">
                            <label for="sponsor_username" class="form-label">Business Unique Identifier</label>
                            <input type="text" class="form-control" id="sponsorId"  name="sponsor_username" value="<?= esc($sponsor_username, 'attr') ?>" readonly />

                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-6 form-group">
                            <label for="buyerref" class="form-label">Buyer Reference <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="buyerref" name="buyerref" value="" maxlength="255" placeholder="Please specify the buyer or tender reference." required />
                             <input type="text" class="form-control" id="SponsorshipAsk" name="required_sponsorship" value="<?= esc($required_sponsorship, 'attr') ?>" readonly hidden/>
                        </div>
                        <div class="col-6 form-group">
                            <label for="sponsorshipOffer" class="form-label">Sponsorship Offer</label>
                            <div class="input">
                                <span class="bi bi-currency-pound" aria-hidden="true"></span>
                                <input type="number" class="form-control" id="sponsorshipOffer" name="sponsorship_offer" value="" placeholder="Please specify your offer" />
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 form-group">
                            <label for="monitoryValue" class="form-label">Monetary Value</label>
                            <div class="input">
                                <span class="bi bi-currency-pound" aria-hidden="true"></span>
                                <input type="number" class="form-control" id="monitoryValue" name="monitory_value" value="" placeholder="Please specify the monitory value" />
                            </div>
                        </div>
                        <div class="col-10 form-group">
                            <label for="sponsorshipDetails" class="form-label">How this will be spent</label>
                            <textarea class="form-control" id="sponsorshipDetails" name="sponsorship_details" placeholder="How this is to be spent as agreed with the Charity"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 form-group">
                            <label for="goodsValue" class="form-label">Goods Value</label>
                            <div class="input">
                                <span class="bi bi-currency-pound" aria-hidden="true"></span>
                                <input type="number" class="form-control" id="goodsValue" name="goods_value" value="" placeholder="Please specify the goods value" />
                            </div>
                        </div>
                        <div class="col-10 form-group">
                            <label for="goodsDetails" class="form-label">Details of Goods</label>
                            <textarea class="form-control" id="goodsDetails" name="goods_details" placeholder="Goods and services that have been agreed with the Charity"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 form-group">
                            <label for="volunteeringHours" class="form-label">Volunteering</label>
                            <div class="input">
                                <span class="bi bi-currency-pound" aria-hidden="true"></span>
                                <input type="number" class="form-control" id="volunteeringHours" name="volunteering_value" value="" placeholder="Please specify the volunteering" />
                            </div>
                        </div>
                        <div class="col-10 form-group">
                            <label for="volunteeringDetails" class="form-label">Details of Volunteering</label>
                            <textarea class="form-control" id="volunteeringDetails" name="volunteering_details" placeholder="Volunterring and their values that have been agreed with the Charity"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 form-group">
                            <label for="sumsvp" class="form-label">Summary of Social Value Proposal</label>
                            <textarea class="form-control" id="additionalInfo" name="sumsvp" placeholder="Please summarise how you intend to manage this collaboration together, relating to the breakdown above." maxlength="1000"></textarea>
                            <small id="charCount" class="form-text text-muted">0 / 1000 characters</small>
                            <script>
                                $(document).ready(function() {
                                    $('#additionalInfo').on('input', function() {
                                        let text = $(this).val();
                                        if (text.length > 1000) {
                                            $(this).val(text.substring(0, 1000));
                                            text = $(this).val();
                                        }
                                        $('#charCount').text(text.length + ' / 1000 characters');
                                    });
                                });
                            </script>
                        </div>
                    </div>

             
                </div>
                    <hr>
                    <button type="button" id="backToCDetail" class="btn action-button">Back</button>
                    <button type="submit" id="submitSponsorship" class="btn action-button">Submit</button>
            </fieldset>
        </form>
    </div>
</div>
  

<script>
    const csrfField = '<?= csrf_token() ?>';

    async function sendReceiptEmail(receiptData) {
        const payload = {
            sponsorship_id: receiptData.id
        };

        payload[csrfField] = $(`input[name="${csrfField}"]`).val();

        return $.ajax({
            url: base_url + '/sponsorships/send-receipt',
            type: 'POST',
            dataType: 'json',
            data: payload
        });
    }

    $(document).ready(function() {

        const escapeHtml = (value) => $('<div>').text(value ?? '').html();

        function showSwal(type, title, message, errors = null) {
            let errorHtml = escapeHtml(message);

            if (errors) {
                errorHtml += '<ul>';
                for (let key in errors) {
                    errorHtml += `<li>${escapeHtml(errors[key])}</li>`; // Loop through validation errors
                }
                errorHtml += '</ul>';
            }
           return Swal.fire({
                icon: type, // 'success', 'error', 'warning', 'info'
                title: title,
                html: `<div class="swal-message">${errorHtml}</div>`, // Use a class for styling
                width: '40%', // Standardized width
                customClass: {
                    popup: 'swal-wide',
                    title: 'swal-title'
                }
            });
        }




        $('#sponsorshipForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            const buyerReference = $('#buyerref').val().trim();
            const offer = parseFloat($('#sponsorshipOffer').val()) || 0;
            const monetary = parseFloat($('#monitoryValue').val()) || 0;
            const goods = parseFloat($('#goodsValue').val()) || 0;
            const volunteering = parseFloat($('#volunteeringHours').val()) || 0;

            if (buyerReference === '') {
                showSwal('error', 'Validation Error', 'Buyer Reference is required to submit a sponsorship proposal.');
                return;
            }

            // Validate sponsorship offer breakdown before submission
            if (offer !== (monetary + goods + volunteering)) {

                showSwal('error', 'Validation Error', 'The sponsorship offer must equal the sum of monetary, goods, and volunteering values.');
                return;
            }

            // Show loading state
            Swal.fire({
                title: 'Submitting...',
                text: 'Please wait while we process your sponsorship proposal.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit the form using AJAX
            $.ajax({
                url: base_url + '/newSpo',
                type: 'POST',
                data: $('#sponsorshipForm').serialize(),
                dataType: 'json',
                success: function(response) {
                    Swal.close(); // Close the loading dialog

                    if (response.status === 'success') {

                        const finalize = (alertType = 'success', alertMessage = response.message) => {
                            showSwal(alertType, 'Proposal Submitted!', alertMessage).then(() => {
                                window.location.href =  base_url +'/catalogue';
                            });
                        };

                        if (response.receipt && response.receipt.id) {
                            sendReceiptEmail(response.receipt)
                                .then((receiptResponse) => {
                                    if (receiptResponse.download_url) {
                                        window.open(receiptResponse.download_url, '_blank');
                                    }
                                    finalize('success', response.message);
                                })
                                .catch(() => {
                                    finalize('warning', 'Your proposal is saved but we were unable to email the PDF automatically. Please download it later from your dashboard.');
                                });
                        } else {
                            finalize();
                        }

                    } else if (response.status === 'error' && response.errors) {

                        showSwal('error', 'Validation Errors', 'Please check the following fields:', response.errors);
                        
                    } else {
                        showSwal('error', 'Submission Failed!', response.message);

                    }
                },
                error: function(xhr) {
                    Swal.close(); // Close the loading dialog

                    let errorMessage = 'Something went wrong. Please try again later.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    showSwal('error', 'Submission Failed!', errorMessage);

                }
            });
        });
    });
</script>


<?= $this->endSection() ?>
