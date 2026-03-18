<?php
    $allowedProvisioners = [
        'umarriaz56@gmail.com',
        'jay.baughan@pluggin.org',
    ];
    $currentAdminEmail = strtolower((string) (session()->get('user_email') ?? ''));
    $canProvisionUsers = session()->get('isAdmin') && in_array($currentAdminEmail, $allowedProvisioners, true);
?>
<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<section class="dasbord_section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-12 dasbord_subbox">
                <div class="dasbord_leftbox">
                  <div class="nav" id="nav-tab" role="tablist">
                    <div class="left_txtbox active" data-bs-toggle="tab" data-bs-target="#dashboard" role="tab" aria-controls="charities" aria-selected="true">
                     
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-bar-chart left_icon" viewBox="0 0 16 16">
                            <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
                        </svg>
                        <h3> Dashboard</h3>
                       
                    </div>
                    <div class="left_txtbox" data-bs-toggle="tab" data-bs-target="#sponsorship" role="tab" aria-controls="sponsorship" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin left_icon" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                          <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                          <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                          <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg>
                        <h3>Sponsorship</h3>
                    </div>
                    <div class="left_txtbox" data-bs-toggle="tab" data-bs-target="#export" role="tab" aria-controls="export" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-download left_icon" viewBox="0 0 16 16">
                          <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                          <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        <h3>Export</h3>
                    </div>
                    <?php if ($canProvisionUsers): ?>
                    <div class="left_txtbox" data-bs-toggle="tab" data-bs-target="#userAdmin" role="tab" aria-controls="userAdmin" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-plus left_icon" viewBox="0 0 16 16">
                          <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                          <path d="M9 13c0 1-1 2-3 2s-3-1-3-2 1-2 3-2 3 1 3 2"/>
                          <path fill-rule="evenodd" d="M13.5 5.5a.5.5 0 0 1 .5.5v1.5H15a.5.5 0 0 1 0 1h-1v1.5a.5.5 0 0 1-1 0V8.5h-1a.5.5 0 0 1 0-1h1V6a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        <h3>User Access</h3>
                    </div>
                    <?php endif; ?>
                    <div class="left_txtbox" data-bs-toggle="tab" data-bs-target="#faqs" role="tab" aria-controls="export" aria-selected="true">
                        <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-person-raised-hand left_icon" viewBox="0 0 16 16">
                          <path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207"/>
                          <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                        </svg>
                        <h3>FAQ's</h3>
                    </div>
                  </div>

                </div>
                <div class="right_box tab-content">
                    <div class="tab-pane tdada fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                      <?= $this->include('admin/dashboard') ?>
                    </div>
                    <div class="tab-pane tdata fade show" id="sponsorship" role="tabpanel" aria-labelledby="sponsorship-tab">
                      <?= $this->include('admin/sponsorships') ?>
                    </div>
                    <div class="tab-pane tdata fade show" id="export" role="tabpanel" aria-labelledby="export-tab">
                      <?= $this->include('admin/export') ?>
                    </div>
                    <?php if ($canProvisionUsers): ?>
                    <div class="tab-pane tdata fade show" id="userAdmin" role="tabpanel" aria-labelledby="userAdmin-tab">
                      <?= $this->include('admin/user_admin') ?>
                    </div>
                    <?php endif; ?>
                    <div class="tab-pane tdata fade show" id="faqs" role="tabpanel" aria-labelledby="export-tab">
                      <?= $this->include('admin/faqs') ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
