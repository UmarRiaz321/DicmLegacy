<?php

/**
 * @author Umar Riaz
 * Created at 10/09/2023
 * 
 */ ?>
<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="MidContainer">
    <fieldset id="done">
        <div class="tittle text-center">
            <h4>Form Submitted successfully</h4>
        </div>
        <hr>
        <div class="row">
            Your request to join social impact register has been submitted successfully. Admin will review your details and will get back to you soon.
        </div>
    </fieldset>
</div>

<?= $this->endSection() ?>