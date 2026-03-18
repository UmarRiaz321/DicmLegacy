<div class="right_amountbox">
  <div class="nav" id="nav-tab" role="tablist">
    <div class="sporight_txtbox status-tab active" data-status="Charities">
      <div class="spouser_box">
        <h4>CSE</h4>
      </div>
      <?php if (isset($cse_faq)) : ?>
        <h5><?php echo $cse_faq ?></h5>
      <?php endif ?>
    </div>
    <div class="sporight_txtbox status-tab" data-status="Businesses">
      <div class="spouser_box">
        <h4>Business</h4>
      </div>
      <?php if (isset($bus_faq)) : ?>
        <h5><?php echo $bus_faq ?></h5>
      <?php endif ?>
    </div>
    <div class="sporight_txtbox status-tab" data-status="Buyers">
      <div class="spouser_box">
        <h4>Buyer</h4>
      </div>
      <?php if (isset($buy_faq)) : ?>
        <h5><?php echo $buy_faq ?></h5>
      <?php endif ?>
    </div>
    <div class="sporight_txtbox status-tab" data-status="AddFaqs">
      <div class="spouser_box">
        <h4>Add Faq's</h4>
      </div>
    </div>    
  </div>
</div>

<div class="tab-content graph_section" id="myTabContent">
  <div class="table-responsive box">
    <div id="faqsTable">
      <table id="faqTable" class="table table-hover table-bordered table-striped" style="table-layout: fixed">
          <thead>
              <tr>
                  <th>Question</th>
                  <th>Answer</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody id="faqsTableBody"></tbody>
      </table>

    </div>

    <!-- Hidden form to add new FAQ -->
    <div id="addFaqForm" style="display: none;">
      <form id="newFaqForm" method="POST" action="">
        <?= csrf_field() ?>
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="newFaqQuestion" class="form-label">Question</label>
            <input type="text" class="form-control" id="newFaqQuestion" name="faq_question" required>
          </div>
          <div class="col-md-12 mb-3">
            <label for="newFaqAnswer" class="form-label">Answer</label>
            <textarea class="form-control" id="newFaqAnswer" name="faq_answer" rows="4" required></textarea>
          </div>
          <div class="col-md-12 mb-3">
            <label for="newFaqType" class="form-label">Type</label>
            <select class="form-control" id="newFaqType" name="faq_type" required>
              <option value="Charities">Charities</option>
              <option value="Businesses">Businesses</option>
              <option value="Buyers">Buyers</option>
            </select>
          </div>
          <div class="col-md-12 text-center">
            <button id="fAdd" class="btn btn-primary">Add FAQ</button>
          </div>
        </div>
      </form>
    </div>


  </div>
</div>

<!-- faq Details Modal -->
<div id="faqDetailsModal" class="modal fade" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg"  >

            <!-- Modal Header with Matching Style -->
            <div class="modal-header">
                <div class="row">
                  <div class="col text-center"><h5> Update FAQ</h5></div>
                </div>
            </div>

            <div class="modal-body p-4">
              <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                  <form id="updateFaq" method="POST" action="<?php echo base_url('fupdate');?>">
                    <?= csrf_field() ?>
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="faqQuestion" class="form-label">Question</label>
                        <input type="text" class="form-control" id="faqQuestion" name="question" required>
                        <input type="text" hidden name="ftype" id="ftype">
                        <input type="number" hidden name="fid" id="fid">
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="faqAnswer" class="form-label">Answer</label>
                        <textarea class="form-control" id="faqAnswer" name="answer" rows="4" required></textarea>
                      </div>
                      <div class="col-md-12 text-center">
                        <button id="fUpdate" class="btn btn-primary">Update FAQ</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>





