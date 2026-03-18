<!-- Edit Organistion Detail Model-->
<div class="modal fade" id="UCseModal" tabindex="-1" aria-labelledby="UCseModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="UCseModalLabel">Update Organisation Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="<?php echo base_url('/UcD'); ?>" id="UcDForm" method="POST">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="form-group  col-lg-6 col-md-6 col-12">
                        <label for="cse_OrgName" class="nl">Organisation Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" class="form-control" required name="cse_OrgName" id="cse_OrgName" placeholder="Please enter organisation name">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cse_YearFounded" class="nl">Organisation Founded Year :<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input class="form-control" type="number" required name="cse_YearFounded" id="cse_YearFounded" placeholder="YYYY" min="1950">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cse_RegisteredNo" class="nl">Charity Registration Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" class="form-control" required name="cse_RegisteredNo" id="cse_RegisteredNo" placeholder="Please enter charity registration number">
                        <div class="form-text text-left text-muted">If you are not registered as a charity, then please use N/A.</div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cse_SERNo" class="nl">Social Enterprise Registration Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input class="form-control" type="text" required name="cse_SERNo" id="cse_SERNo" placeholder="Please enter social enterprise registration number ">
                        <div class="form-text text-left text-muted">If you are not registered with Companies House, then please use N/A.</div>
                    </div>
                </div>
                <div class="row mt-3 p-0">
                    <!-- <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cse_Type" class="nl">CSE Type:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <select class="form-control" id="cse_Type" name="cse_Type" required data-placeholder="Please select charity type">
                            <option></option>
                            <option>Charity</option>
                            <option>Social Enterprise</option>
                            <option>Volunteer Group</option>
                        </select>
                        <div class="form-text text-left text-muted">If you have a Company Registration Number, then you are a Social Enterprise.</div>
                        <div class="form-text text-left text-muted">If you have only a Charity Number and not a Company Number, then you are a Charity.</div>
                        <div class="form-text text-left text-muted">If you have neither you are a Voluntary Group.</div>
                    </div> -->
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cse_AIncome" class="nl">Annual Income:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="number" class="form-control" required name="cse_AIncome" id="cse_AIncome" placeholder="Please enter the average annual income over the last 3 years">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cse_CurrentSupporters" class="nl">Current Support:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <select id="cse_CurrentSupporters" class="form-control" name="cse_CurrentSupporters[]" required data-placeholder="Please enter the bodies and institutions that support you currently." multiple>
                            <option></option>
                        </select>
                        <div class="form-text text-left text-muted">Please enter the bodies and institutions that support you currently.</div>
                        <div class="form-text text-left text-muted">To add, enter name of body/institution and press enter.</div>
                        <!-- <input type="text" class="backvalue" name="cse_CurrentSupportersValue" id="cse_CurrentSupportersValue"> -->
                    </div>

                </div>
                <div class="row mt-3">

                    <!-- <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cse_Theme" class="nl">CSE Theme:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <select class="form-select" id="cse_Theme" name="cse_Theme" required data-placeholder="Please select theme best fits your main service/project offering">
                            <option></option>
                            <option>Youth Development</option>
                            <option>Community Development</option>
                            <option>Environment Development</option>
                        </select>
                    </div> -->
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 col-md-6 col-12">
                        <select class="form-select" id="cse_Regions" name="cse_Regions[]" required data-placeholder="Please select regions you are active in" multiple>
                            <option></option>
                            <option>East Midlands</option>
                            <option>East of England</option>
                            <option>London</option>
                            <option>North East</option>
                            <option>North West</option>
                            <option>South East</option>
                            <option>South West</option>
                            <option>West Midlands</option>
                            <option>Yorks and Humber</option>
                            <option>Scotland</option>
                            <option>Wales</option>
                            <option>N. Ireland</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <label for="cse_referer" class="nl">Reference Number:</label>
                        <input type="text" class="form-control" name="cse_referer" id="cse_referer" placeholder="Please enter reference number">
                    </div>
                    <input type="hidden" name="cse_id" id="cse_id" value="">
                </div>
            </form>
        </div>

        <div class="modal-footer d-flex align-items-center">
            <button type="button" id="UpdCseD" class="btn notaction-button ">Update</button>
        </div>
    </div>
  </div>
</div>
