<div class="right_amountbox">
  <div class="nav" id="nav-tab" role="tablist">
    <div class="sporight_txtbox status-tab active" data-status="PROP">
      <div class="spouser_box">
        <h4>Proposals</h4>
      </div>
      <?php if (isset($spo_prop)) : ?>
        <h5><?php echo $spo_prop ?></h5>
      <?php endif ?>
    </div>
    <div class="sporight_txtbox status-tab" data-status="OFBP">
      <div class="spouser_box">
        <h4>SPO Submitted</h4>
      </div>
      <?php if (isset($spo_ofbp)) : ?>
        <h5><?php echo $spo_ofbp ?></h5>
      <?php endif ?>
    </div>
    <div class="sporight_txtbox status-tab" data-status="OAAS">
      <div class="spouser_box">
        <h4>SPO Accepted</h4>
      </div>
      <?php if (isset($spo_oaas)) : ?>
        <h5><?php echo $spo_oaas ?></h5>
      <?php endif ?>
    </div>
    <div class="sporight_txtbox status-tab" data-status="SIGN-U">
      <div class="spouser_box">
        <h4>Signed Unpaid</h4>
      </div>
      <?php if (isset($spo_signu)) : ?>
        <h5><?php echo $spo_signu ?></h5>
      <?php endif ?>
    </div>
    <div class="sporight_txtbox status-tab" data-status="CONF">
      <div class="spouser_box">
        <h4>Confirmed</h4>
      </div>
      <?php if (isset($spo_conf)) : ?>
        <h5><?php echo $spo_conf ?></h5>
      <?php endif ?>
    </div>
    
  </div>
</div>
<div class="tab-content graph_section" id="myTabContent">
  <div class="table-responsive box">
    <table id="sponsorshipsTable" class="table table-hover table-bordered table-striped" style="table-layout: fixed">
        <thead>
            <tr>
                <th>Reference</th>
                <th>CSE</th>
                <th>Business</th>
                <th>Offer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="sponsorshipsTableBody"></tbody>
    </table>
  </div>
</div>

<!-- Sponsorship Details Modal -->
<div id="sponsorshipDetailsModal" class="modal fade" tabindex="-1" aria-labelledby="spoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg"  >

            <!-- Modal Header with Matching Style -->
            <div class="modal-header">
                <div class="row">
                  <div class="col-3 pr-order"><img src="<?php echo base_url('public/images/SIRNewLogo.png')?>" alt="SIR"></div>
                  <div class="col-8 text-center"><h5> Social Purchase Order</h5></div>
                  <div class="col-1 text-end"></div>
                </div>
            </div>

            <div class="modal-body p-4">
                
                <!-- Sponsorship Information -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase fw-bold text-dark"><i class="bi bi-info-circle"></i> SPO Information</h5>
                        <hr>
                        <div class="row">
                        <div class="col text-start "><p><strong>SPO Reference</strong></p></div>
                          <div class="col text-center"><p id="spoRef"></p></div>
                        </div>
                        <div class="row">
                          <div class="col text-start "><p><strong>SPO Status</strong></p></div>
                          <div class="col text-center"><p id="spoStatus"></p></div>
                        </div>
                        <div class="row">
                          <div class="col text-start "><p><strong>Buyer Reference</strong></p></div>
                          <div class="col text-center"><p id="buyerReference"></p></div>
                        </div>
                    </div>
                </div>

                <!-- Charity & Sponsor Info -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase text-dark fw-bold"><i class="bi bi-house-heart"></i> CSE Details</h5>
                        <hr>
                        <div class="row">
                          <div class="col text-start "><p><strong>Name</strong></p></div>
                          <div class="col text-center"><p id="charityName"></p></div>
                        </div>
                        <div class="row">
                          <div class="col text-start "><p><strong>Unique Identifier</strong></p></div>
                          <div class="col text-center"><p id="charityUserName"></p></div>
                        </div>
                    </div>
                </div>

                <!-- Sponsor Details -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase fw-bold text-dark"><i class="bi bi-person-badge"></i> Business Details</h5>
                        <hr>
                        <div class="row">
                          <div class="col text-start "><p><strong>Business Name</strong></p></div>
                          <div class="col text-center"><p id="sponsorName"></p></div>
                        </div>
                        <div class="row">
                          <div class="col text-start "><p><strong>Unique Identifier</strong></p></div>
                          <div class="col text-center"><p id="sponsorUserName"></p></div>
                        </div>
                    </div>
                </div>

                <!-- Financial Information -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase fw-bold text-dark "><i class="bi bi-currency-pound"></i> SPO Financials</h5>
                        <hr>
                        <div class="row">
                          <div class="col text-start "><p><strong>Required Sponsorship</strong></p></div>
                          <div class="col text-end"><p id="requiredSponsorship"></p></div>
                        </div>
                        <div class="row">
                          <div class="col text-start "><p><strong>Offered Amount</strong></p></div>
                          <div class="col text-end"><p id="sponsorshipOffer"></p></div>
                        </div>
                    </div>
                </div>

                <!-- Funding Breakdown -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase fw-bold text-dark"><i class="bi bi-pie-chart"></i> Funding Breakdown</h5>
                        <hr>

                        <div class="row">
                          <div class="col-6 text-start">
                            <p class="mb-1"><strong><i class="bi bi-cash-coin"></i> Monetary Contribution:</strong></p>
                          </div>
                          <div class="col-6 text-end">
                            <p class="fw-bold" id="monetaryValue"></p>
                           
                          </div>
                        </div>
                        <div class="row">
                          <p><span id="monetaryDetails"></span></p>
                          <hr>
                        </div>
                        <div class="row">
                          <div class="col-6 text-start">
                            <p class="mb-1"><strong><i class="bi bi-box-seam"></i> Goods & Services:</strong></p>
                          </div>
                          <div class="col-6 text-end">
                            <p class="fw-bold" id="goodsValue"></p>
                          </div>
                        </div>
                        <div class="row">
                          <p><span id="goodsDetails"></span></p>
                          <hr>
                        </div>
                        <div class="row">
                          <div class="col-6 text-start">
                            <p class="mb-1"><strong><i class="bi bi-people"></i> Volunteering Contribution:</strong></p>
                          </div>
                          <div class="col-6 text-end">
                            <p class="fw-bold" id="volunteeringValue"></p>
                          </div>
                        </div>
                        <div class="row">
                          <p><span id="volunteeringDetails"></span></p>
                        </div>
                      
                        <!-- <div class="row">
                            <div class="col-md-4">
                                <p class="mb-1"><strong><i class="bi bi-cash-coin"></i> Monetary Contribution:</strong></p>
                                <p class="text-primary fw-bold" id="monetaryValue"></p>
                                <p class="text-muted"><small id="monetaryDetails"></small></p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1"><strong><i class="bi bi-box-seam"></i> Goods & Services:</strong></p>
                                <p class="text-success fw-bold" id="goodsValue"></p>
                                <p class="text-muted"><small id="goodsDetails"></small></p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1"><strong><i class="bi bi-people"></i> Volunteering Contribution:</strong></p>
                                <p class="  fw-bold" id="volunteeringValue"></p>
                                <p class="text-muted"><small id="volunteeringDetails"></small></p>
                            </div>
                        </div> -->

                        <!-- Additional Funding Breakdown Details -->
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong><i class="bi bi-cash-stack"></i> Total Sponsorship Offer:</strong></p>
                            </div>
                            <div class="col-md-6 text-end">
                              <p class=" fw-bold" id="totalFunding"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <p class="mb-1"><strong><i class="bi bi-exclamation-circle"></i> Remaining Balance:</strong></p>
                            </div>
                            <div class="col-md-6 text-end">
                              <p class="fw-bold" id="remainingBalance"></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                          <button type="button"  class="btn  btn-secondary float-end" data-bs-dismiss="modal"> <i class="bi bi-x-circle"></i> close</button>
                          <!-- <button type="button"  class="btn action-button btn-danger"><i class="bi bi-file-earmark-pdf"></i> Download PDF </button> -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End of Sponsorship Details Modal -->

<!-- Sponsorship PDF Download Modal -->
<div id="sponsorshipPDFModal" class="modal fade" tabindex="-1" aria-labelledby="spoPDFModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow-lg" id="pdfContent">

      <!-- Modal Header with Matching Style -->
      <div class="modal-header">
        <div class="row">
          <div class="col-3 pr-order"><img src="<?php echo base_url('public/images/SIRNewLogo.png')?>" alt="SIR"></div>
          <div class="col-8 text-center"><h5> Social Purchase Order</h5></div>
          <div class="col-1 text-end"><button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button></div>
        </div>
      </div>

      <div class="modal-body p-4">
        
        <!-- Sponsorship Information -->
        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <h5 class="card-title text-uppercase fw-bold text-dark"><i class="bi bi-info-circle"></i> SPO Information</h5>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-1"><strong>Reference:</strong></p>
                <p class="text-primary fw-bold" id="pdfSpoRef"></p>
              </div>
              <div class="col-md-6">
                <p class="mb-1"><strong>Status:</strong></p>
                <span id="pdfSpoStatus" class="badge fs-6 px-3 py-2"></span>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-12">
                <p class="mb-1"><strong>Buyer Reference:</strong></p>
                <p id="pdfBuyerReference"></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Charity & Sponsor Info -->
        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <h5 class="card-title text-uppercase fw-bold"><i class="bi bi-house-heart"></i> CSE Details</h5>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-1"><strong>Name:</strong></p>
                <p id="pdfCharityName"></p>
              </div>
              <div class="col-md-6">
                <p class="mb-1"><strong>Project Name:</strong></p>
                <p id="pdfProjectName"></p>
              </div>
            </div>
            <p class="mb-1"><strong>Purpose:</strong></p>
            <p id="pdfProjectPurpose"></p>
            <p class="mb-1"><strong>Key Objectives:</strong></p>
            <p id="pdfKeyObjectives"></p>
          </div>
        </div>

        <!-- Sponsor Details -->
        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <h5 class="card-title text-uppercase fw-bold text-primary"><i class="bi bi-person-badge"></i> Sponsor Details</h5>
            <hr>
            <p class="mb-1"><strong>Name:</strong></p>
            <p id="pdfSponsorName"></p>
          </div>
        </div>

        <!-- Financial Information -->
        <div class="card border-0 shadow-sm mb-3">
          <div class="card-body">
            <h5 class="card-title text-uppercase fw-bold  "><i class="bi bi-currency-pound"></i> Sponsorship Financials</h5>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-1"><strong>Required Sponsorship:</strong></p>
                <p class="  fw-bold" id="pdfRequiredSponsorship"></p>
              </div>
              <div class="col-md-6">
                <p class="mb-1"><strong>Offered Amount:</strong></p>
                <p class="text-success fw-bold" id="pdfSponsorshipOffer"></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Funding Breakdown -->
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="card-title text-uppercase fw-bold text-info"><i class="bi bi-pie-chart"></i> Funding Breakdown</h5>
            <hr>

            <div class="row">
              <div class="col-6 text-start">
              <p class="mb-1"><strong><i class="bi bi-cash-coin"></i> Monetary Contribution:</strong></p>
              </div>
              <div class="col-6 text-end">
              <p class="text-primary fw-bold" id="pdfMonetaryValue"></p>
              </div>
            </div>
            <div class="row">
              <p><span id="pdfMonetaryDetails"></span></p>
              <hr>
            </div>
            <div class="row">
              <div class="col-6 text-start">
              <p class="mb-1"><strong><i class="bi bi-box-seam"></i> Goods & Services:</strong></p>
              </div>
              <div class="col-6 text-end">
              <p class="text-success fw-bold" id="pdfGoodsValue"></p>
              </div>
            </div>
            <div class="row">
              <p><span id="pdfGoodsDetails"></span></p>
              <hr>
            </div>
            <div class="row">
              <div class="col-6 text-start">
              <p class="mb-1"><strong><i class="bi bi-people"></i> Volunteering Contribution:</strong></p>
              </div>
              <div class="col-6 text-end">
              <p class="  fw-bold" id="pdfVolunteeringValue"></p>
              </div>
            </div>
            <div class="row">
              <p><span id="pdfVolunteeringDetails"></span></p>
            </div>

            <!-- Additional Funding Breakdown Details -->
            <hr>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-1"><strong><i class="bi bi-cash-stack"></i> Total Sponsorship Offer:</strong></p>
              </div>
              <div class="col-md-6 text-end">
                <p class="  fw-bold" id="pdfTotalFunding"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <p class="mb-1"><strong><i class="bi bi-exclamation-circle"></i> Remaining Balance:</strong></p>
              </div>
              <div class="col-md-6 text-end">
                <p class="  fw-bold" id="pdfRemainingBalance"></p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Centered Footer Buttons -->
      <div class="modal-footer">
        <div class="row">
          <div class="col-3 pr-order text-start"><img src="<?php echo base_url('public/images/SIRNewLogo.png')?>" alt="SIR"></div>
          <div class="col-6 text-center"><h5> Brought you by Plugin</h5></div>
          <div class="col-3 pr-order text-end"><img src="<?php echo base_url('public/images/SIRNewLogo.png')?>" alt="SIR"></div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- End of Sponsorship PDF Download Modal -->



