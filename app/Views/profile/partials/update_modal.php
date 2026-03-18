<div class="modal fade" id="profileUpdateModal" tabindex="-1" aria-labelledby="profileUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileUpdateModalLabel">Request Profile Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profileUpdateForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Organisation Name</label>
                            <input type="text" class="form-control" name="organisation_name" id="organisation_name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Registration Number</label>
                            <input type="text" class="form-control" name="registration_number" id="registration_number">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="organisation_address" id="organisation_address" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website</label>
                            <input type="url" class="form-control" name="website" id="organisation_website">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Regions</label>
                            <input type="text" class="form-control" name="regions" id="organisation_regions">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Name</label>
                            <input type="text" class="form-control" name="contact_name" id="contact_name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" name="contact_email" id="contact_email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Phone</label>
                            <input type="text" class="form-control" name="contact_phone" id="contact_phone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Average Income</label>
                            <input type="text" class="form-control" name="average_income" id="average_income">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes to Admin</label>
                            <textarea class="form-control" name="notes" id="update_notes" rows="3" placeholder="Share context for this change request."></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="profileUpdateSubmit">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

