<div class="right_amountbox">
  <div class="nav" id="nav-tab" role="tablist">
    <div class="right_txtbox active" data-bs-toggle="tab" data-bs-target="#charities" role="tab" aria-controls="charities" aria-selected="true">
      <div class="user_box">
        <h4>CSEs</h4>
      </div>
      <?php if (isset($charities)) : ?>
        <h5><?php echo $charities ?></h5>
      <?php endif ?>
    </div>
    <div class="right_txtbox" data-bs-toggle="tab" data-bs-target="#sponsors" role="tab" aria-controls="sponsors" aria-selected="true">
      <div class="user_box">
        <h4>Businesses</h4>
      </div>
      <?php if (isset($sponsors)) : ?>
        <h5><?php echo $sponsors ?></h5>
      <?php endif ?>
    </div>
    <div class="right_txtbox" data-bs-toggle="tab" data-bs-target="#enabler" role="tab" aria-controls="enabler" aria-selected="true">
      <div class="user_box">
        <h4>Buyers</h4>
      </div>
      <?php if (isset($enablers)) : ?>
        <h5><?php echo $enablers ?></h5>
      <?php endif ?>
    </div>
    <div class="right_txtbox" data-bs-toggle="tab" data-bs-target="#unapproved" role="tab" aria-controls="unapproved" aria-selected="true">
      <div class="user_box">
        <h4>Approval Requests</h4>
      </div>
      <?php if (isset($pendinhg)) : ?>
        <h5><?php echo $pendinhg ?></h5>
      <?php endif ?>
    </div>
  </div>

</div>
<div class="tab-content graph_section" id="myTabContent">
  <div class="tab-pane tdada fade show active" id="charities" role="tabpanel" aria-labelledby="charities-tab"><?= $this->include('admin/csetable') ?></div>
  <div class="tab-pane tdata fade show" id="sponsors" role="tabpanel" aria-labelledby="sponsor-tab"><?= $this->include('admin/spotable') ?></div>
  <div class="tab-pane tdata fade show" id="enabler" role="tabpanel" aria-labelledby="enabler-tab"><?= $this->include('admin/enatable') ?></div>
  <div class="tab-pane tdata fade show" id="unapproved" role="tabpanel" aria-labelledby="unapproved-tab"><?= $this->include('admin/apptable') ?></div>
</div>