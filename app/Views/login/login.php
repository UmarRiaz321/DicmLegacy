<?php
$session     = session();
$isLoggedIn  = (bool) $session->get('loggedIn');
$flashError  = $session->getFlashdata('error');
$flashSuccess= $session->getFlashdata('success');
?>
<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="lgsection mt-3">
    <div class="vertical-tab">
        <div class="image-style">

        </div>
        <div id="section1" class="section-amum-mkls">
            <input type="radio" name="sections" id="option1" <?php if(isset($login))echo $login ?> >
            <label for="option1" class="icon-left-amum-mkpvt"><span class="bi bi-person-circle" aria-hidden="true"></span>Login</label>
            <article>
                <form action="<?= base_url('/SignIn') ?>" method="post">
                    <?= csrf_field() ?>
                    <h3 class="legend">Login</h3>
                    <div class="input">
                        <span class="bi bi-envelope" aria-hidden="true"></span>
                        <input type="email" class="form-control" placeholder="Email" name="email" required />
                    </div>
                    <div class="input">
                        <span class="bi bi-key" aria-hidden="true"></span>
                        <input type="password" placeholder="Password" name="password" required />
                    </div>
                    <button type="submit" class="btn submit">Login</button>
                    <!-- <a href="#" class="bottom-text-amum-mkls">Forgot Password?</a> -->
                </form>
                <?php if (isset($validation)): ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                        <?= $validation?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($flashSuccess)): ?>
                    <div class="col-12 mt-2">
                        <div class="alert alert-success" role="alert">
                            <?= esc($flashSuccess) ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (!empty($flashError)): ?>
                    <div class="col-12 mt-2">
                        <div class="alert alert-danger" role="alert">
                            <?= esc($flashError) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </article>
        </div>
        <?php if ($isLoggedIn): ?>
            <div id="section2" class="section-amum-mkls">
                <input type="radio" name="sections" id="option2" <?php if(isset($update))echo $update ?>>
                <label for="option2" class="icon-left-amum-mkpvt"><span class="bi bi-pencil-square" aria-hidden="true"></span>Update Password</label>
                <article>
                    <form action="<?= base_url('/cpass')?>" method="post">
                        <?= csrf_field() ?>
                        <h3 class="legend">Change Password</h3>
                        <?php $passwordToken = $passwordToken ?? session()->get('password_token'); ?>
                        <?php if (!empty($passwordToken)): ?>
                            <input type="hidden" name="password_token" value="<?= esc($passwordToken) ?>">
                        <?php endif; ?>
                        <div class="input">
                            <span class="bi bi-key" aria-hidden="true"></span>
                            <input type="password" placeholder="Current Password" name="cpass" required />
                        </div>
                        <div class="input">
                            <span class="bi bi-key" aria-hidden="true"></span>
                            <input type="password" id="Npass" placeholder="New Password" name="Npass" required />
                        </div>
                        <div class="input">
                            <span class="bi bi-key" aria-hidden="true"></span>
                            <input type="password" placeholder="Confirm New Password" name="CNpass" required />
                        </div>
                        <div id="password-requirements">
                            <p id="length" class="requirement">At least 8 characters long</p>
                            <p id="uppercase" class="requirement">Contains an uppercase letter</p>
                            <p id="lowercase" class="requirement">Contains a lowercase letter</p>
                            <p id="number" class="requirement">Contains a number</p>
                            <!-- Add more requirements as needed -->
                        </div>
                        <button type="submit" class="btn submit">Update</button>

                    </form>
                    <?php if (isset($errors)): ?>
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                            <?= $errors?>
                            </div>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        <?php endif; ?>
<div id="section3" class="section-amum-mkls">
    <input type="radio" name="sections" id="option3" <?php if(isset($reset)) echo $reset; ?>>
    <label for="option3" class="icon-left-amum-mkpvt">
        <span class="bi bi-lock" aria-hidden="true"></span>Forgot Password?
    </label>
    <article>
        <h3 class="legend last">Reset Password</h3>

        <?php if (!empty($flashError)): ?>
            <div class="alert alert-danger"><?= esc($flashError) ?></div>
        <?php endif; ?>

        <?php if (isset($errors) && $errors): ?>
            <div class="alert alert-danger"><?= $errors ?></div>
        <?php endif; ?>

        <?php if (isset($status) && $status): ?>
            <div class="alert alert-success"><?= $status ?></div>
        <?php endif; ?>

        <?php if (!empty($resetToken)): ?>
            <!-- STEP 2: User arrived via email link (token present) → show new password form -->
            <p class="para-style">Please enter your new password below.</p>
            <form action="<?= base_url('/reset') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="token" value="<?= esc($resetToken) ?>" />

                <div class="input">
                    <span class="bi bi-key" aria-hidden="true"></span>
                    <input type="password" placeholder="New Password" name="password" required />
                </div>
                <div class="input">
                    <span class="bi bi-key" aria-hidden="true"></span>
                    <input type="password" placeholder="Confirm New Password" name="password_confirm" required />
                </div>

                <div id="password-requirements">
                    <p id="length" class="requirement">At least 8 characters long</p>
                    <p id="uppercase" class="requirement">Contains an uppercase letter</p>
                    <p id="lowercase" class="requirement">Contains a lowercase letter</p>
                    <p id="number" class="requirement">Contains a number</p>
                </div>

                <button type="submit" class="btn submit">Update Password</button>
            </form>
        <?php else: ?>
            <!-- STEP 1: Ask for email to send reset link -->
            <p class="para-style">Enter your email address below and we’ll send you a reset link.</p>
            <form action="<?= base_url('/forgot') ?>" method="post">
                <?= csrf_field() ?>
                <div class="input">
                    <span class="bi bi-envelope" aria-hidden="true"></span>
                    <input type="email" placeholder="Email" name="email" required />
                </div>
                <button type="submit" class="btn submit last-btn">Send reset link</button>
            </form>
        <?php endif; ?>
    </article>
</div>
    </div>

</div>
<script>

    $(document).ready(function() {
            var data_info = <?php if(isset($res)) echo json_encode($res) ?>;
            console.log(data_info);
        });
</script>
<?= $this->endSection() ?>
