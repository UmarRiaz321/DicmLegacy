<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="MidContainer">
    <div class="multi_step_form">
        <form  id="sponsorjoin" class="msform" action="<?php echo base_url('/sposignup'); ?>" method="post">
            <?= csrf_field() ?>
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active"><div class="d-none d-sm-block">Disclaimer</div> </li>  
                <li> <div class="d-none d-sm-block">Organisation</div></li> 
                <li> <div class="d-none d-sm-block">Contact</div></li>
                <li> <div class="d-none d-sm-block">Marketing</div></li>
                <li><div class="d-none d-sm-block">Socials</div></li>
                <li><div class="d-none d-sm-block">Review</div></li>
            </ul>
            
            <fieldset id="spodisclaimer" class="mt-2">
                <div id="disinfo" class="row">
                    <div class="col-lg-6 col-md-6 col-12" >
                        <div class="disImage text-center">
                            <img src="<?php echo base_url('public/images/dcimgraphic.jpg') ?>" alt="Social Impact Register" >
                        </div>
                        <div class="bldisText">
                            <p>
                            Here's where to join the Dual Impact Collaboration Marketplace (DICM), built with and for public procurement bodies across 44 area of the UK. This is where you can develop your social value bids with pre-validated charities and social enterprises, then manage and promote this into emergency service, council, NHS and criminal justice service procurement teams.
                            </p>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 bl" >
                        <h4 class="text-center">
                            The Pluggin Ecosystem is home to the Dual Impact Collaboration Marketplace (DICM), to join please follow these steps:
                        </h4>
                        <div class="bldisText">
                            <p>Step 1: Complete the following joining details which build your membership and credentials. NOTE: We will need a marketing contact.</p>
                            <p>Step 2: Click the Submit button and then set your email Whitelist to accept emails from no-reply@pluggin-ecosystem.org</p>
                            <p>This will prevent your server blocking your Welcome Email and any future access support emails</p>
                        </div>

                    </div>
                </div>
                <hr>
                <button type="button" class="btn notaction-button" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal">Terms and Conditions</button>
                <button type="button" class="btn notaction-button" data-bs-toggle="modal" data-bs-target="#spofaqsModal">Faq's</button>
                <button type="button" id="first" class="btn  next action-button" >Continue</button>

            </fieldset>

            <!-- Organisation -->
            <fieldset id="SpoOrgDetails" class="mt-2">
                <div class="tittle text-center">
                    <h4>Organisation</h4>
                    <small>Please fill in the details about your organisation.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group  col-lg-6 col-md-6 col-12">
                        <label for="spo_OrgName" class="nl">Business Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" class="form-control"  required name="spo_OrgName" id="spo_OrgName" placeholder="Please enter legal organisation name.">
                    </div>
                    <div class="form-group  col-lg-6 col-md-6 col-12">
                        <label for="spo_TradingName" class="nl">Trading name:</label>
                        <input type="text" class="form-control" name="spo_TradingName" id="spo_TradingName" placeholder="Please enter trading name if applicable.">
                    </div>
                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="spo_Registration" class="nl">Incorporation Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input class="form-control" type="text"  required name="spo_Registration" id="spo_Registration"  placeholder="Please enter your Companies House registration number." >
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="spo_Regions" class="nl">Trading Regions:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>

                        <select class="form-select" id="spo_Regions" name="spo_Regions[]" required data-placeholder="Please select regions you are active in" multiple="multiple">
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
                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="spo_Bsize" class="nl">Business Size:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <select class="form-select" id="spo_Bsize" name="spo_Bsize" required data-placeholder="Please select size best fits your organisation according to our membership defination">
                            <option></option>
                            <option>small business</option>
                            <option>medium/large business</option>
                            <option>social enterprise</option>
                        </select>
                        <div class="smal-text text-muted text-left">Annual Turnover is less £5m = Small Business Membership</div>
                        <div class="smal-text text-muted text -left">Annual Turnover £5m or over = Medium/Large Business Membership</div>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="spo_clients" class="nl">Who Do You Supply?:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>

                        <select class="form-select" id="spo_clients" name="spo_clients[]" required data-placeholder="Within the above named regions, please confirm who you supply (or intend to supply going forwards)" multiple="multiple">
                            <option></option>
                            <option>Police</option>
                            <option>Councils</option>
                            <option>NHS</option>
                            <option>Fire</option>
                            <option>Criminal Justice Service</option>
                        </select>
                        <!-- <div class="smal-text text-muted text-left">Please select an option from the list. If your choice is not available, enter the name of the entity you supply and press 'Enter'. </div> -->
                    </div>
                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="spo_AccountSetup" class="nl">Confirm Account Set-up:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <select class="form-select" id="spo_AccountSetup" name="spo_AccountSetup" required data-placeholder="Confirm that you require ecosystem business membership ">
                            <option></option>
                            <option>Yes</option>
                            <option>No</option>
                        </select>
                        <div class="smal-text text-muted text-left">Confirm that you require ecosystem business membership </div>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="spo_VatNumber" class="nl">VAT:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" class="form-control"  required name="spo_VatNumber" id="spo_VatNumber" placeholder="Please enter organisation vat number.">
                        <div class="smal-text text-muted text-left">Please confirm your UK VAT registration number.</div>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="spo_Referer" class="nl">Head Office:</label>
                        <input type="text" class="form-control"   name="spo_Referer" id="spo_Referer" placeholder="Please enter the county your business is headquartered within.">
                    </div>
                </div>
                <div class="row mt-3 p-2 mb-2">
                    <div class="form-group col-lg-12 col-md-12 col-12">
                        <label for="spo_address" class="nl">Address:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" name="spo_add" class="form-control" required placeholder="First Line of address of organisation.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12 mt-2">
                        <label class="backvalue nl" >City:</label>
                        <input type="text" name="spo_city" class="form-control" required placeholder="City">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12 mt-2">
                        <label class="backvalue nl" >County:</label>
                        <input type="text" name="spo_county" class="form-control" required placeholder="County">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12 mt-2">
                        <label class="backvalue nl">Post Code:</label>
                        <input type="text" name="spo_pcode" class="form-control" required placeholder="Post Code">
                    </div>
                </div>
                <hr>
                <button type="button" id="sposecondB" class="btn action-button previous">Back</button>
                <button type="button" id="sposecond" class="btn action-button next">Next</button>
                <button type="button"  id="sposecondToReview" class="btn action-button backToSum" >Review</button>

            </fieldset>
            <!-- Main Contact -->
            <fieldset id="SpoMainContact" class="mt-2">
                <div class="tittle text-center">
                    <h4>Main Contact Details</h4>
                    <small>Please fill in the details of main contact person.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="smcd_fname" class="nl">First Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="smcd_fname" name="smcd_fname" class="form-control" required placeholder="Please enter first name.">

                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cmcd_lname" class="nl">Last Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="smcd_lname" name="smcd_lname" class="form-control" required placeholder="Please enter last name.">
                    </div>

                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="smcd_JobTitle" class="nl">Job Title:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="smcd_JobTitle" name="smcd_JobTitle" class="form-control" required placeholder="Please enter job title of main contact person.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="smcd_Email" class="nl">Email:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="email" id="smcd_Email" name="smcd_Email" class="form-control" required placeholder="Please enter email of main contact person.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="smcd_Phone" class="nl">Phone Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="tel" id="smcd_Phone" name="smcd_Phone" class="form-control" required placeholder="Please enter best phone number.">
                    </div>  
                </div>
  
                <hr>
                <button type="button" id="spothirdB" class="btn action-button previous">Back</button>
                <button type="button" id="spothird" class="btn action-button next">Next</button>
                <button type="button"  id="spothirdToReview" class="btn action-button backToSum" >Review</button>

            </fieldset>
            <!-- Other Account -->
            <fieldset id="SpoAccountDetail" class="mt-2">
                <div class="tittle text-center">
                    <h4>Marketing Contact Details</h4>
                    
                </div>
                <hr>
                <!-- <div class="row mt-3 p-0">
                    <legend>Accounts</legend>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="sa_fName" class="nl">First Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="sa_fName" name="sa_fName" required class="form-control"  placeholder="Please enter first name.">

                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="sa_lName" class="nl">Last Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="sa_lName" name="sa_lName" required class="form-control"  placeholder="Please enter last name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="sa_Email" class="nl">Email:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="email" id="sa_Email" name="sa_Email" required class="form-control"  placeholder="Please enter email of main contact person.">
                    </div>
                </div>
                <hr> -->
                <div class="row mt-3 mb-3 p-0">
                    <!-- <legend>Marketing</legend> -->
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="sm_fName" class="nl">First Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="sm_fName" name="sm_fName" required class="form-control"  placeholder="Please enter first name.">

                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="sm_lName" class="nl">Last Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="sm_lName" name="sm_lName" required class="form-control"  placeholder="Please enter last name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="sm_Email" class="nl">Email:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="email" id="sm_Email" name="sm_Email" required class="form-control"  placeholder="Please enter email of main contact person.">
                    </div>
                </div>
                <hr>
                <button type="button" id="spofourthB" class="btn action-button previous">Back</button>
                <button type="button" id="spofourth" class="btn action-button next">Next</button>
                <button type="button"  id="spofourthToReview" class="btn action-button backToSum" >Review</button>
            </fieldset>
            <!-- Socials -->
            <fieldset id="SpoSocialsDetail" class="mt-2">
                <div class="tittle text-center">
                    <h4>Socials Details</h4>
                    <small>Please fill in the details about your online profiles.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="sps_Facebook" class="nl">Facebook:</label>
                        <input type="url" id="sps_Facebook" name="sps_Facebook" class="form-control"  placeholder="Please enter Facebook profile link.">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="sps_Instagram" class="nl">Instagram:</label>
                        <input type="url" id="sps_Instagram" name="sps_Instagram" class="form-control"  placeholder="Please enter Instagram profile link.">
                    </div>
 
                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="sps_Website" class="nl">Website:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="url" id="sps_Website" name="sps_Website" required class="form-control"  placeholder="Please enter Website.">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="sps_Linkedin" class="nl">Linkedin:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="url" id="sps_Linkedin" name="sps_Linkedin" required class="form-control"  placeholder="Please enter Linkedin profile link.">
                    </div>
                </div>
                <hr>
                <button type="button" id="spofifthB" class="btn action-button previous">Back</button>
                <button type="button" id="spofifth" class="btn action-button next">Next</button>
                <button type="button"  id="spofifthToReview" class="btn action-button backToSum" >Review</button>
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
                                            <i id="editspoorginfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="spoorginfobody"></tbody>
                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Main Contact Details</h4>
                                            <i id="editspoMcInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="spoMcinfobody"></tbody>

                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Marketing Details</h4>
                                            <i id="editaccountInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="accountinfobody"></tbody>
                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Socials Details</h4>
                                            <i id="editSpoSocialsInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="SpoSocialsinfobody"></tbody>
                    
                    </table>
                </div>

                <button type="button"  class="btn action-button previous">Back</button>
                <button type="button" id="sposubmit" class="btn action-button">Submit</button>

            </fieldset>
        </form>
    </div>
</div>
<!-- Models -->
    <!-- FAQ's Model -->

    <div class="modal" tabindex="-1" id="spofaqsModal">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title text-center">FAQ's</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body businessfaq">                
                </div>

            </div>
        </div>
    </div>
<?= $this->endSection() ?>
