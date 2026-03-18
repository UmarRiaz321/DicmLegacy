<div class="modal fade" id="delegateModal" tabindex="-1" aria-labelledby="delegateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delegateModalLabel">Invite Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="delegateForm" method="post" action="<?= site_url('profile/delegates') ?>" data-endpoint="<?= site_url('profile/delegates') ?>" autocomplete="off" novalidate>
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="delegate_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="delegate_name" id="delegate_name" required minlength="3">
                    </div>
                    <div class="mb-3">
                        <label for="delegate_email" class="form-label">Work Email</label>
                        <input type="email" class="form-control" name="delegate_email" id="delegate_email" required>
                        <div class="form-text">Must match the domain of the primary contact.</div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="delegateSubmit">
                            Add Team Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
