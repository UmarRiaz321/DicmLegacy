<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="MidContainer">
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You need to log in to access this page.',
            confirmButtonText: 'Login',
        }).then(() => {
            // Redirect to the login page
            window.location.href = '<?= base_url("login") ?>';
        });
    </script>
</div>
<?= $this->endSection() ?>