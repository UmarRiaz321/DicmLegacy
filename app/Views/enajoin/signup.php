<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="MidContainer">
    <div class="multi_step_form">
        <form  id="enablerjoin" class="msform" action="<?php echo base_url('/enasignup'); ?>" method="post">
            <?= csrf_field() ?>
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active"><div class="d-none d-sm-block">Disclaimer</div> </li>  
                <li> <div class="d-none d-sm-block">Organisation</div></li> 
                <li> <div class="d-none d-sm-block">Main Contact</div></li>
                <li> <div class="d-none d-sm-block">PR & Media Contacts</div></li>
                <li><div class="d-none d-sm-block">Socials</div></li>
                <li><div class="d-none d-sm-block">Review</div></li>
            </ul>
            <fieldset id="spodisclaimer" class="mt-2">
                <div id="disinfo" class="row">
                    <div class="col-lg-6 col-md-6 col-12" >
                        <div class="disImage text-center">
                            <img src="<?php echo base_url('public/images/dicm.png') ?>" alt="Social Impact Register" >
                        </div>
                        <div class="bldisText">
                            <p>
                                 Hosted within the Pluggin Ecosystem, the DICM is a collaborative framework contractually harnessing supplier
                                 social value to the locally-led activities building healthier, safer and more resilient communities - ultimately 
                                 reducing demand for and costs of policing, community safety, healthcare and criminal justice.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 bl" >
                       
                        <div class="disImage text-center">
                            <img src="<?php echo base_url('public/images/PNHS.png') ?>" alt="Public Sector" >
                        </div>
                        <div class="bldisText">
                            <h3>Find out more about the Dual Impact Collaboration Model (DICM) in your region.</h3>
                            <p>
                                To register your interest in joining the DICM within any of the 45 UK geographies, 
                                please complete the section here to share information about your organisation, 
                                in order for us to arrange a meeting.
                            </p>
                        </div>

                    </div>

                </div>
                <hr>
                <button type="button" class="btn notaction-button" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal">Terms and Conditions</button>
                <button type="button" class="btn notaction-button" data-bs-toggle="modal" data-bs-target="#enafaqsModal">Faq's</button>
                <button type="button" id="first" class="btn  next action-button" >Continue</button>

            </fieldset>
                        <!-- Organisation -->
            <fieldset id="EnaOrgDetails" class="mt-2">
                <div class="tittle text-center">
                    <h4>Organisation</h4>
                    <small>Please fill in the details about your organisation.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group  col-lg-6 col-md-6 col-12">
                        
                        <label for="ena_OrgName" class="nl">Organisation Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" class="form-control"  required name="ena_OrgName" id="ena_OrgName" placeholder="Please enter organisation name.">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="ena_ServiceType" class="nl">Service Type:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <select class="form-select" id="ena_ServiceType" name="ena_ServiceType" required data-placeholder="Please select service type">
                            <option></option>
                            <option>FRS</option>
                            <option>Lord Lieutenant</option>
                            <option>LGA</option>
                            <option>NHS Trust</option>
                            <option>Police</option>
                            <option>PCC</option>
                        </select>
                    </div>

                </div>
   
                <div class="row mt-3 p-0">
                    <!-- <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="ena_theme" class="nl">CSE Theme:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <select class="form-select" id="ena_theme" name="ena_theme" required data-placeholder="Please select theme best fits with your strategic objectives">
                            <option></option>
                            <option>Youth Development</option>
                            <option>Community Development</option>
                            <option>Environment Development</option>
                        </select>
                    </div> -->
                    <div class="form-group col-lg-12 col-md-12 col-12">
                            <label for="ena_regions" class="nl">Regions:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>

                            <select class="form-select" id="ena_regions" name="ena_regions[]" required data-placeholder="Please select regions you are active in" multiple="multiple">
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
                                <!-- <option>National</option> -->
                            </select>
                    </div>
                </div>
  
                <hr>
                <button type="button" id="enasecondB" class="btn action-button previous">Back</button>
                <button type="button" id="enasecond" class="btn action-button next">Next</button>
                <button type="button"  id="enasecondToReview" class="btn action-button backToSum" >Review</button>

            </fieldset>
                        <!-- Manin Contact -->
            <fieldset id="EnaMainContact" class="mt-2">
                <div class="tittle text-center">
                    <h4>Main Contact Details</h4>
                    <small>Please fill in the details of main contact person.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="emcd_fname" class="nl">First Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="emcd_fname" name="emcd_fname" class="form-control" required placeholder="Please enter first name.">

                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="emcd_lname" class="nl">Last Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="emcd_lname" name="emcd_lname" class="form-control" required placeholder="Please enter last name.">
                    </div>

                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="emcd_Email" class="nl">Email:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="email" id="emcd_Email" name="emcd_Email" class="form-control" required placeholder="Please enter email of main contact person.">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="emcd_Phone" class="nl">Phone Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="tel" id="emcd_Phone" name="emcd_Phone" class="form-control" required placeholder="Please enter best phone number.">
                    </div>  
                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="emcd_JobTitle" class="nl">Job Title:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="emcd_JobTitle" name="emcd_JobTitle" class="form-control" required placeholder="Please enter job title of main contact person.">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="ena_Confirmation" class="nl">Confirmation:</label>
                        <select class="form-control" id="ena_Confirmation" name="ena_Confirmation" data-placeholder="I confirm our interest in supporting the DICM">
                            <option></option>
                            <option Value="1">Yes</option>
                            <option Value="0">No</option>
                        </select>
                    </div>
                 
                </div>
                <hr>
                <button type="button" id="enathirdB" class="btn action-button previous">Back</button>
                <button type="button" id="enathird" class="btn action-button next">Next</button>
                <button type="button"  id="enathirdToReview" class="btn action-button backToSum" >Review</button>

            </fieldset>
                            <!-- Other Contacts -->
            <fieldset id="EnaConDetails" class="mt-2">
                <div class="tittle text-center">
                    <h4>Organisation Communications Contacts</h4>
                    <small>Please fill in organisation communication contacts(Its not mendatory).</small>
                </div>
                <hr>

                <div class="row mt-3 p-0">
                    <legend>Head of PR and Media</legend>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="epr_fName" class="nl">First Name:</label>
                        <input type="text" id="epr_fName" name="epr_fName" class="form-control"  placeholder="Please enter first name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="epr_lName" class="nl">Last Name:</label>
                        <input type="text" id="epr_lName" name="epr_lName" class="form-control"  placeholder="Please enter last name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="epr_Email" class="nl">Email:</label>
                        <input type="email" id="epr_Email" name="epr_Email" class="form-control"  placeholder="Please enter email.">
                    </div>
                </div>
                <div class="row mt-3 p-0">
                    <legend>Head of Marketing</legend>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="emr_fName" class="nl">First Name:</label>
                        <input type="text" id="emr_fName" name="emr_fName" class="form-control"  placeholder="Please enter first name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="emr_lName" class="nl">Last Name:</label>
                        <input type="text" id="emr_lName" name="emr_lName" class="form-control"  placeholder="Please enter last name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="emr_Email" class="nl">Email:</label>
                        <input type="email" id="emr_Email" name="emr_Email" class="form-control"  placeholder="Please enter email.">
                    </div>
                </div>
                <div class="row mt-3 p-0">
                    <legend>Head of Procurement</legend>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="epro_fName" class="nl">First Name:</label>
                        <input type="text" id="epro_fName" name="epro_fName" class="form-control"  placeholder="Please enter first name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="epro_lName" class="nl">Last Name:</label>
                        <input type="text" id="epro_lName" name="epro_lName" class="form-control"  placeholder="Please enter last name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="epro_Email" class="nl">Email:</label>
                        <input type="email" id="epro_Email" name="epro_Email" class="form-control"  placeholder="Please enter email.">
                    </div>
                </div>
                <hr>
                <button type="button" id="enafourthB" class="btn action-button previous">Back</button>
                <button type="button" id="enafourth" class="btn action-button next">Next</button>
                <button type="button"  id="enafourthToReview" class="btn action-button backToSum" >Review</button>
            </fieldset>
                       <!-- Socials -->
            <fieldset id="EnaSocialsDetail" class="mt-2">
                <div class="tittle text-center">
                    <h4>Socials Details</h4>
                    <small>Please fill in the details about your online profiles.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="es_Facebook" class="nl">Facebook:</label>
                        <input type="url" id="es_Facebook" name="es_Facebook" class="form-control"  placeholder="Please enter Facebook profile link.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="es_Instagram" class="nl">LinkenIn:</label>
                        <input type="url" id="es_Instagram" name="es_Instagram" class="form-control"  placeholder="Please enter linkedIn profile link.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="es_Website" class="nl">Website:</label>
                        <input type="url" id="es_Website" name="es_Website" class="form-control"  placeholder="Please enter Website.">
                    </div>
 
                </div>
                <hr>
                <button type="button" id="enafifthB" class="btn action-button previous">Back</button>
                <button type="button" id="enafifth" class="btn action-button next">Next</button>
                <button type="button"  id="enafifthToReview" class="btn action-button backToSum" >Review</button>
            </fieldset>
            <!-- Review -->
            <fieldset id="ReviewDetails" class="mt-2">
                <div class="tittle text-center">
                    <h4>Review Details</h4>
                    <small>Please review your submission before submission.</small>
                </div>
                <hr>

                <div class="row mt-t p-0">
                    <table class="table table-striped table-responsive ReviewTable" >
                        <colgroup>
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 80%">
                        </colgroup>
                        <thead class="thead-dark" style="display: none;">
                            <tr class="row">
                                <th scope="col">Input</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Organisation Details</h4>
                                            <i id="editenaorginfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="enaorginfobody"></tbody>
                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Main Contact Details</h4>
                                            <i id="editenaMcInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="enaMcinfobody"></tbody>

                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Organisation Communications Contacts</h4>
                                            <i id="editoccInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="occinfobody"></tbody>
                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Socials Details</h4>
                                            <i id="editEnaSocialsInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="EnaSocialsinfobody"></tbody>
                    
                    </table>
                </div>

                <button type="button"  class="btn action-button previous">Back</button>
                <button type="button" id="enasubmit" class="btn action-button">Submit</button>

            </fieldset>
        </form>
    </div>
</div>
<!-- Models -->
    <!-- FAQ's Model -->

    <div class="modal" tabindex="-1" id="enafaqsModal">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title text-center">FAQ's</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body buyerfaq">
                </div>

            </div>
        </div>
    </div>
<?= $this->endSection() ?>
