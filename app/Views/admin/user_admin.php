<?php
    $palette = [
        'forest' => '#476029',
        'leaf'   => '#7FB341',
        'ash'    => '#F5F9F0',
        'ink'    => '#1F2A1C',
    ];
?>
<div class="card border-0 shadow-sm rounded-4" style="background: <?= $palette['ash']; ?>;">
    <div class="card-body p-4 p-lg-5">
        <div class="mb-4">
            <p class="text-uppercase fw-bold mb-2" style="letter-spacing:0.18em;color:<?= $palette['leaf']; ?>;font-size:0.78rem;">
                Identity Access
            </p>
            <h4 class="mb-1" style="color:<?= $palette['ink']; ?>;font-weight:700;">Create Platform User</h4>
            <p class="text-muted mb-0">Provision a new account and our system will handle identifiers, passwords, and notifications automatically.</p>
        </div>

        <form id="userProvisionForm" autocomplete="off" class="provision-form bg-white p-4 rounded-4 shadow-sm">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="provFullName" class="form-label fw-semibold" style="color:<?= $palette['forest']; ?>;">Full Name</label>
                    <input type="text" class="form-control provision-input" id="provFullName" name="full_name" placeholder="Jay Baughan" maxlength="200" required>
                </div>
                <div class="col-md-6">
                    <label for="provEmail" class="form-label fw-semibold" style="color:<?= $palette['forest']; ?>;">Email Address</label>
                    <input type="email" class="form-control provision-input" id="provEmail" name="email" placeholder="team@pluggin.org" maxlength="200" required>
                </div>
                <div class="col-md-6">
                    <label for="provType" class="form-label fw-semibold" style="color:<?= $palette['forest']; ?>;">User Type</label>
                    <select class="form-select provision-input" id="provType" name="user_type" required>
                        <option value="">Select user type</option>
                        <option value="admin">Admin</option>
                        <option value="sponsor">Business (Sponsor)</option>
                        <option value="charity">Charity (CSE)</option>
                        <option value="enabler">Enabler (Buyer)</option>
                    </select>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3 mt-4">
                <button type="submit" class="btn text-white px-4" id="userProvisionSubmit" style="background-color: <?= $palette['forest']; ?>;">
                    <i class="bi bi-person-plus me-1"></i> Create User
                </button>
                <div class="text-muted small">We’ll email credentials automatically and log every action.</div>
            </div>
        </form>
    </div>
</div>

<style>
    .provision-input {
        border-radius: 16px !important;
        border: 1px solid rgba(0,0,0,0.08) !important;
        padding: 0.75rem 1rem !important;
        background-color: #fff !important;
    }
    .provision-input:focus {
        border-color: #7FB341 !important;
        box-shadow: 0 0 0 0.15rem rgba(127,179,65,0.25) !important;
    }
</style>
