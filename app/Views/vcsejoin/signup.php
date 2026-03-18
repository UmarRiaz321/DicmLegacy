<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<?php $ytOrigin = rawurlencode(rtrim(base_url('/'), '/')); ?>

<div class="MidContainer">


    <!-- Multi step form --> 
    <div class="multi_step_form">
        <form  id="vcsejoin" class="msform" action="<?php echo base_url('/csignup'); ?>" enctype="multipart/form-data" method="post">
            <?= csrf_field() ?>
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active"><div class="d-none d-sm-block">Disclaimer</div> </li>  
                <li> <div class="d-none d-sm-block">Organisation</div></li> 
                <li> <div class="d-none d-sm-block">Contact</div></li>
                <li> <div class="d-none d-sm-block">Project</div></li>
                <li><div class="d-none d-sm-block">Socials</div></li>
                <li><div class="d-none d-sm-block">Review</div></li>
            </ul>

            <fieldset id="disclaimer" class="mt-2">
                <div id="disinfo" class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="text-center">
                            <h3>Please watch this video!</h3>
                        </div>
                        <div class="disvideo">
                            <iframe
                                width="100%"
                                height="100%"
                                src="https://www.youtube.com/embed/F2m867XICT8?rel=0&modestbranding=1&origin=<?= $ytOrigin ?>"
                                title="Pluggin onboarding video"
                                loading="lazy"
                                referrerpolicy="origin-when-cross-origin"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>
                        <div class="text-center">
                            <p>
                            It's free to join our ecosystem and access the support for your activities building healthier, safer and more resilient communities!

                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 bl">
                        <div class="disImage text-center">
                            <img src="<?php echo base_url('public/images/newfist.png') ?>" alt="Social Impact Register" >
                        </div>
                        <div class="bldisText">
                            <h5 class="text-left">Step 1</h5> <hr class="mt-0 mb-0">
                            <p>Please watch the support video and complete this multistep form to join our ecosystem and build your online profile.</p>
                            <h5 class="text-left">Step 2</h5> <hr class="mt-0 mb-0">
                            <p>Once we receive your Form, we will process it and use the details provided to build your profile, and issue your access credentials.</p>
                            <h5 class="text-left">Step 3</h5> <hr class="mt-0 mb-0">
                            <p>Our membership support team will then contact you to confirm Membership Details and point you towards the onboarding tutorials helping you set-up and operate activity,
                                access support and embed the ecosystem into your organisation.
                            </p>
                        </div>
                        <div class="text-center">
                            <p>Please follow the steps below and provide all information requested, click <strong>Continue</strong> to proceed.</p>
                        </div>
                    </div>

                </div>
                <hr>
                <!-- <button type="button" class="btn notaction-button" data-bs-toggle="modal" data-bs-target="#howtoVideoModal">Tutorial</button> -->
                <button type="button" class="btn notaction-button" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal">Terms and Conditions</button>
                <button type="button" class="btn notaction-button" data-bs-toggle="modal" data-bs-target="#faqsModal">Faq's</button>
                <button type="button" id="first" class="btn  next action-button" >Continue</button>

            </fieldset>

            <!-- Org Details Feildset -->
            <fieldset id="OrgDetails" class="mt-2" >
                    <div class="tittle text-center">
                        <h4>Organisation</h4>
                        <small>About Your Charity/Social Enterprise Organisation.</small>
                    </div>
                    <hr>

                    <div class="row mt-3 p-0">
                        <div class="form-group  col-lg-6 col-md-6 col-12">
                           
                            <label for="cse_OrgName" class="nl">Organisation Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" class="form-control"  required name="cse_OrgName" id="cse_OrgName" placeholder="Please enter organisation name">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_YearFounded" class="nl">Year Organisation Founded:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input class="form-control" type="number"  required name="cse_YearFounded" id="cse_YearFounded"  placeholder="YYYY" min="1900">
                        </div>

                    </div>
                    <div class="row mt-3 p-0">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_RegisteredNo" class="nl">Charity Registration Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input type="text" class="form-control"  required name="cse_RegisteredNo" id="cse_RegisteredNo" placeholder="Please enter charity registration number">
                            <div class="form-text text-left text-muted">If you are not registered as a charity, then please use N/A.</div>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_SERNo" class="nl">Social Enterprise Registration Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <input class="form-control" type="text"  required name="cse_SERNo" id="cse_SERNo"  placeholder="Please enter social enterprise registration number " >
                            <div class="form-text text-left text-muted">If you are not registered with Companies House, then please use N/A.</div>
                        </div>

                    </div>

                    <div class="row mt-3 p-0">
                        <!-- <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_Type" class="nl" >CSE Type:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
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




                    </div>

                    <div class="row mt-3 p-0">
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_CurrentSupporters" class="nl">Current Support:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                           
                                <select id="cse_CurrentSupporters" class="form-control" name= "cse_CurrentSupporters[]" required data-placeholder="Please enter the bodies and institutions that support you currently." multiple>
                                    <option></option>
                                </select>
                             <div class="form-text text-left text-muted">Please enter the bodies and institutions that support you currently.</div>
                             <div class="form-text text-left text-muted">To add, enter name of body/institution  and press enter.</div>

                          
                            <!-- <input type="text" class="backvalue" name="cse_CurrentSupporters" id="cse_CurrentSupportersValue"> -->
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_AIncome" class="nl">Annual Income:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                           <input type="number" class="form-control" required name="cse_AIncome" id="cse_AIncome" placeholder="Please enter the average annual income over the last 3 years">
                        </div>

                        <!-- <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_Theme" class="nl">CSE Theme:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                            <select id="cse_Theme" name="cse_Theme" required data-placeholder="Please select theme best fits your main service/project offering">
                                <option></option>
                                <option>Youth Development</option>
                                <option>Community Development</option>
                                <option>Environment Development</option>
                            </select>

                        </div> -->
                    </div>

                    <div class="row mt-3 p-0">
                        <div class="col-lg-6 col-md-6 col-12">
                                <span class="input-group">
                                    <label for="cse_Regions" class="nl">Regions:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                                    <select  required id="cse_Regions" name="cse_Regions[]" multiple="multiple" data-placeholder="Please select your operational region(s)">
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

                             
                                </span>

                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-12">
                            <label for="cse_referer" class="nl">Strategic Affiliations:</label>
                            <input type="text" class="form-control"   name="cse_referer" id="cse_referer" placeholder="Please answer yes/no">
                            <div class="form-text text-left text-muted">Is your organisation part of any strategic PCC/PFCC community safety initiatives</div>

                        </div>
    

                    </div>

                    <hr>
                    <button type="button" id="secondB" class="btn action-button previous">Back</button>
                    <button type="button" id="second" class="btn action-button next">Next</button>
                    <button type="button"  id="secondToReview" class="btn action-button backToSum" >Review</button>
            </fieldset>
            <fieldset id="MainContact" class="mt-2">
                <div class="tittle text-center">
                    <h4>Main Contact Details</h4>
                    <small>Please fill in the details of main contact person.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="cmcd_fname" class="nl">First Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="cmcd_fname" name="cmcd_fname" class="form-control" required placeholder="Please enter first name.">

                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="cmcd_lname" class="nl">Last Name:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="cmcd_lname" name="cmcd_lname" class="form-control" required placeholder="Please enter last name.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label for="cmcd_email" class="nl">Email:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="email" id="cmcd_email" name="cmcd_email" class="form-control" required placeholder="Please enter email of main contact person.">
                    </div>
                </div>

                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cmcd_jtitle" class="nl">Job Title:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" id="cmcd_jtitle" name="cmcd_jtitle" class="form-control" required placeholder="Please enter job title of main contact person.">
                    </div>  
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cmcd_phone" class="nl">Phone Number:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="tel" id="cmcd_phone" name="cmcd_phone" class="form-control" required placeholder="Please enter best phone number.">
                    </div>                   
                </div>

                <div class="row mt-3 p-1 mb-2">
                    <div class="form-group col-lg-12 col-md-12 col-12">
                        <label for="cse_address" class="nl">Address:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="text" name="cse_street" class="form-control" required placeholder="First Line of address of organisation.">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label class="backvalue nl" >City:</label>
                        <input type="text" name="cse_city" class="form-control" required placeholder="City">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label class="backvalue nl" >County:</label>
                        <input type="text" name="cse_county" class="form-control" required placeholder="County">
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-12">
                        <label class="backvalue nl">Post Code:</label>
                        <input type="text" name="cse_pcode" class="form-control" required placeholder="Post Code">
                    </div>
                </div>

                
                <hr>
                <button type="button" id="thirdB" class="btn action-button previous">Back</button>
                <button type="button" id="third" class="btn action-button next">Next</button>
                <button type="button"  id="thirdToReview" class="btn action-button backToSum" >Review</button>

            </fieldset>
            <!-- Project Details -->
                <!-- Project Details -->
            <fieldset id="ProjectDetail" class="mt-2">
                <div class="tittle text-center">
                    <h4>About Your Provision</h4>
                    <small>Please complete the sections below to help potential sponsors understand more about your activity and impact</small>
                </div>
                <hr>
                <div id="projects-wrapper">
                    <?= view('vcsejoin/components/project_block', ['index' => 0]) ?>
                </div>
                <div class="text-end mb-3">
                    <button type="button" id="add-project" class="action-button add-project-btn">
                        <i class="bi bi-plus-circle me-2"></i>Add Project
                    </button>
                </div>
                <hr>
                <button type="button" id="fourthB" class="btn action-button previous">Back</button>
                <button type="button" id="fourth" class="btn action-button next">Next</button>
                <button type="button" id="fourthToReview" class="btn action-button backToSum">Review</button>
            </fieldset>




            <!-- Socials -->
            <fieldset id="SocialsDetail" class="mt-2">
                <div class="tittle text-center">
                    <h4>Socials Details</h4>
                    <small>Please fill in the details about your online profiles.</small>
                </div>
                <hr>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cs_Facebook" class="nl">Facebook:</label>
                        <input type="url" id="cs_Facebook" name="cs_Facebook" class="form-control"  placeholder="Please enter Facebook profile link.">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cs_Instagram" class="nl">Linkedin:</label>
                        <input type="url" id="cs_Instagram" name="cs_Instagram" class="form-control"  placeholder="Do you promote yourselves on Linkedin?.">
                    </div>
 
                </div>
                <div class="row mt-3 p-0">
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cs_Website" class="nl">Website:</label>
                        <input type="url" id="cs_Website" name="cs_Website" class="form-control"  placeholder="Please enter Website.">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        <label for="cs_logo" class="nl">logo:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
                        <input type="file" id="cs_logo" name="logo" class="form-control"  placeholder="Please add your logo.">
                        <div class="form-text text-right text-muted">Ideally a clear background, and high resolution, lets show you off with your logo!</div>
                   
                    </div>
 
                </div>
                <hr>
                <button type="button" id="fifthB" class="btn action-button previous">Back</button>
                <button type="button" id="fifth" class="btn action-button next">Next</button>
                <button type="button"  id="fifthToReview" class="btn action-button backToSum" >Review</button>

            </fieldset>

            <!-- Summary/Review Fieldset -->

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
                                            <i id="editorginfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="orginfobody"></tbody>
                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Main Contact Details</h4>
                                            <i id="editMcInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="Mcinfobody"></tbody>

                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Project Details</h4>
                                            <i id="editProInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="Proinfobody"></tbody>
                        <tbody>
                            <thead class="mt-2">
                                <tr>
                                    <td colspan="2">
                                        <div colspan=2>
                                            <h4 class="text-center">Socials Details</h4>
                                            <i id="editSocialsInfo" class="bi bi-pencil-square edit btn btn-small float-end"></i>
                                        </div>
                                    </td>
                                </tr>
                            </thead>
                        </tbody>
                        <tbody id="Socialsinfobody"></tbody>
                    
                    </table>
                </div>

                <button type="button"  class="btn action-button previous">Back</button>
                <button type="submit" id="submit" class="btn action-button">Submit</button>

            </fieldset>


        </form>


    </div>


    <!-- End Multi step form -->   



</div>

    <!-- FAQ's Model -->

    <div class="modal" tabindex="-1" id="faqsModal">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title text-center">FAQ's</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body csefaq">                   
                </div>

            </div>
        </div>
    </div>

        <!-- Modals -->
    <div class="modal" tabindex="-1" id="howtoVideoModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">CSE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                        <p>The Social Impact Register is our ecosystem's digital environment where CSEs showcase their activities to regional business members looking to collaborate for impact.</p>
                        <p>Joining is FREE, with access for you team to FOUR areas of support and to work towards our impact sponsorship Bronze, Silver and Gold Quality Marks.</p>
                        <p></p>
                        <hr>
                        <!-- <div class="text-center mimageC">
                        <img src="<?php echo base_url('public/images/vcsebenefits.png') ?>" alt="Social Impact Register" >
                        </div> -->
                        <div class="text-center mimageC">
                        <img src="<?php echo base_url('public/images/sirqm.png') ?>" alt="Social Impact Register" >
                        </div>
                        </div>
                        <div class="col">
                        <iframe
                            width="100%"
                            height="49%"
                            src="https://www.youtube.com/embed/rcJx4M1TmPo?rel=0&modestbranding=1&origin=<?= $ytOrigin ?>"
                            title="CSE guidance video"
                            loading="lazy"
                            referrerpolicy="origin-when-cross-origin"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                        <hr>
                        <h4 class="text-center">Guidlines</h4>
                        <p>Membership of the Social Impact Register does come with some guideines for CSEs to follow, which you will need to follow in order to enjoy the support offered here.</p>
                        <hr>
                        <a href="<?php echo base_url('/vcse-guidelines')?>" target ="_blank"><button class="btn notaction-button">Guidelines</button></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="project-template">
        <?= view('vcsejoin/components/project_block', ['index' => '__INDEX__']) ?>
    </template>

    <script>
        (function () {
            const wrapper = document.getElementById('projects-wrapper');
            const template = document.getElementById('project-template');
            const addBtn = document.getElementById('add-project');
            if (!wrapper) {
                return;
            }

            const getInitialIndex = () => {
                const cards = Array.from(wrapper.querySelectorAll('.project-card'));
                if (!cards.length) {
                    return -1;
                }
                return cards.reduce((max, card) => {
                    const idx = parseInt(card.dataset.projectIndex || '0', 10);
                    return Number.isNaN(idx) ? max : Math.max(max, idx);
                }, -1);
            };

            let projectIndexCounter = getInitialIndex();

            const renderTemplate = (index) => {
                if (!template) return null;
                const html = template.innerHTML.replace(/__INDEX__/g, index);
                const container = document.createElement('div');
                container.innerHTML = html.trim();
                return container.firstElementChild;
            };

            const updateOrderLabels = () => {
                const cards = wrapper.querySelectorAll('.project-card');
                const allowRemoval = cards.length > 1;
                cards.forEach((card, idx) => {
                    const title = card.querySelector('[data-role="project-title"]');
                    if (title) {
                        title.textContent = `Project ${idx + 1}`;
                    }
                    const removeBtn = card.querySelector('.project-remove');
                    if (removeBtn) {
                        removeBtn.classList.toggle('d-none', !allowRemoval);
                    }
                });
            };

            const updateSummary = (detailFields, summaryField) => {
                if (!summaryField) return;
                const segments = [];
                detailFields.forEach((field) => {
                    const label = field.getAttribute('data-summary-label') || '';
                    const value = field.value.trim();
                    if (value) {
                        segments.push(`${label}: ${value}`);
                    }
                });
                summaryField.value = segments.length ? segments.join("\n\n") : 'N/A';
            };

            const bindCardEvents = (card) => {
                if (card.dataset.initialised === 'true') {
                    return;
                }
                card.dataset.initialised = 'true';

                const financialInput = card.querySelector('.project-financial-ask');
                const totalField = card.querySelector('.project-total-ask');
                if (financialInput && totalField) {
                    const updateTotal = () => {
                        totalField.value = financialInput.value || '';
                    };
                    financialInput.addEventListener('input', updateTotal);
                    updateTotal();
                }

                const detailFields = card.querySelectorAll('.project-support-detail');
                const summaryField = card.querySelector('.project-support-summary');
                if (detailFields.length && summaryField) {
                    const handleSummary = () => updateSummary(detailFields, summaryField);
                    detailFields.forEach((field) => field.addEventListener('input', handleSummary));
                    handleSummary();
                }

                const pccSelect = card.querySelector('.project-pcc-select');
                const fundingTextarea = card.querySelector('.funding-details textarea');
                if (pccSelect && fundingTextarea) {
                    const toggleFunding = () => {
                        if (pccSelect.value === '1') {
                            fundingTextarea.removeAttribute('disabled');
                        } else {
                            fundingTextarea.value = '';
                            fundingTextarea.setAttribute('disabled', 'disabled');
                        }
                    };
                    pccSelect.addEventListener('change', toggleFunding);
                    toggleFunding();
                }

                const removeBtn = card.querySelector('.project-remove');
                if (removeBtn) {
                    removeBtn.addEventListener('click', () => {
                        card.remove();
                        updateOrderLabels();
                    });
                }
            };

            const initCard = (card) => {
                if (typeof window.initProjectSelects === 'function') {
                    window.initProjectSelects(card);
                }
                bindCardEvents(card);
            };

            wrapper.querySelectorAll('.project-card').forEach(initCard);
            updateOrderLabels();

            if (addBtn && template) {
                addBtn.addEventListener('click', () => {
                    projectIndexCounter += 1;
                    const card = renderTemplate(projectIndexCounter);
                    if (card) {
                        wrapper.appendChild(card);
                        initCard(card);
                        updateOrderLabels();
                    }
                });
            }
        })();
    </script>


<?= $this->endSection() ?>
