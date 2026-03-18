<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="MidContainer">
     <?php if(isset($data)):?>
        <?= $data ?>
    <?php endif;?>
    <form action="<?php echo base_url('/testform')?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

    <input type="text" name="Pname" class="form-controle" placeholder="Please enter name">

    <input type="file" name="logo" id="logo">
    <button type="submit">uploads</button>
    </form>
</div>

<?= $this->endSection() ?>
