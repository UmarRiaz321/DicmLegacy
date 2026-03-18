<div class="right_amountbox">
  <div class="nav" id="nav-tab" role="tablist">
    <div class="right_txtbox" id="cse_export">
      <div class="user_box">
        <h4 class="text-center"> Export Charities</h4>
      </div>
      <?php if (isset($charities)) : ?>
        <h5 class="text-center"><?php echo $charities ?></h5>
      <?php endif ?>
    </div>
    <div class="right_txtbox" id="spo_export">
      <div class="user_box">
        <h4 class="text-center">Export Sponsors</h4>
      </div>
      <?php if (isset($sponsors)) : ?>
        <h5 class="text-center"><?php echo $sponsors ?></h5>
      <?php endif ?>
    </div>
    <div class="right_txtbox" id="ena_export">
      <div class="user_box">
        <h4 class="text-center">Export Enablers</h4>
      </div>
      <?php if (isset($enablers)) : ?>
        <h5 class="text-center"><?php echo $enablers ?></h5>
      <?php endif ?>
    </div>
  </div>

</div>

