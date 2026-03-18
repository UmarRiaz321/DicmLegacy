<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DICM</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/images/favicons/favicon.ico') ?>">
    <meta name="csrf-token-name" content="<?= esc(csrf_token()) ?>">
    <meta name="csrf-token" content="<?= esc(csrf_hash()) ?>">
    <meta name="csrf-cookie" content="<?= esc(config('Security')->cookieName) ?>">

    <!-- STYLES -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/autosize.js/3.0.15/autosize.min.js'></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Select 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- Swal Files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- DataTable -->

    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-html5-2.4.2/r-2.5.0/datatables.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-html5-2.4.2/r-2.5.0/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

    
    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/nav.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/site.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/joinform.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/login.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/admincss/admin.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/catalogue/catalogue.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/profile/profile.css') ?>?v=<?php echo rand()?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/profile/dashboard.css') ?>?v=<?php echo rand()?>">

    <!-- JS Files -->
    <script>var base_url = '<?php echo base_url() ?>';</script>
    <script src="<?php echo base_url('public/js/csrf.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/validation.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/Vcsevalidate.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/Spovalidate.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/Enavalidate.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/common.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/userprofile.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/joinform.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/selectInputs.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/remcharacter.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/review.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/gettingtables.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/catalouge.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/profile/dashboard.js') ?>?v=<?php echo rand()?>"></script>
    <script src="<?php echo base_url('public/js/export.js') ?>?v=<?php echo rand()?>"></script> 
    <?php if (session()->get('user_type') === 'admin' || session()->get('isAdmin')): ?>
        <script src="<?php echo base_url('public/js/sponsorship.js') ?>?v=<?php echo rand()?>"></script>
        <script src="<?php echo base_url('public/js/admin_user.js') ?>?v=<?php echo rand()?>"></script>
    <?php endif; ?>
    <script src="<?php echo base_url('public/js/faqs.js') ?>?v=<?php echo rand()?>"></script> 
    <!-- Poppin fonts -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- XLSX Download -->
    <script type="text/javascript" src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

    <!-- PDF Download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://unpkg.com/pdf-lib"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.16.0/pdf-lib.js"></script>

   


</head>
<body>

<!-- HEADER: MENU + HEROE SECTION -->
<header>

<?= $this->include('temp/nav') ?>
<div class="row text-center"><div class="col-5"><?= $this->include('temp/alerts') ?></div></div>
</header>

<!-- CONTENT -->

<section id="mainSection" class="h-100">

<?= $this->renderSection('content') ?>

</section>
    <!-- Session Re-authentication Modal -->
    <div class="modal fade" id="reauthModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Session Expired</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-3">For your security, please sign in again to continue where you left off.</p>
                    <div class="alert alert-danger d-none reauth-error" role="alert"></div>
                    <form id="reauthForm" novalidate>
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="reauthEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="reauthEmail" name="email" placeholder="you@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="reauthPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="reauthPassword" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                            Sign In Securely
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <small class="text-muted">Need to use another account? You can also visit the dedicated <a href="<?= base_url('login') ?>" class="link-primary">login page</a>.</small>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            <?php $session = session(); ?>
            <?php if ($session->get('success') || $session->get('danger') || $session->get('warning') || $session->get('info')) : ?>
                <?php if ($session->get('success')) : ?>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: '<?php echo $session->get('success')?>',
                        showConfirmButton: false,
                        timer: 1500
                    })
                <?php endif; ?>
            <?php endif; ?>
        });
    </script>

    <!-- Modal for Privacy -->
    <div class="modal fade bd-example-modal-xl" id="privacyPolicyModal" tabindex="-1" role="dialog" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" >
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Terms and Conditions</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- <embed src="<?= base_url("PrivacyPolicy.pdf"); ?>" frameborder="0" width="100%" height="600px"> -->
            <object data="<?= base_url("public/templates/Terms.pdf"); ?>" type="application/pdf" width="100%" height="600"></object>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
    </div>
    </div> 

<script src="<?php echo base_url('public/js/session-watchdog.js') ?>?v=<?php echo rand()?>"></script>
</body>
</html>
