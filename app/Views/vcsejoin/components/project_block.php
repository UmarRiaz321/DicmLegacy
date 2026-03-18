<?php
$idx = (string) ($index ?? 0);
$namePrefix = "projects[{$idx}]";
$idPrefix = "project-{$idx}-";
?>
<div class="project-card border rounded p-3 mb-3" data-project-index="<?= esc($idx) ?>">
    <div class="project-card-header text-center mb-3">
        <span class="project-sequence badge rounded-pill" data-role="project-title">Project</span>
        <button type="button" class="project-remove" aria-label="Remove project">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="row mt-3 p-0">
        <div class="form-group col-lg-6 col-md-6 col-12">
            <label for="<?= $idPrefix ?>pro_Name" class="nl">Provision Summary:
                <small class="text-danger"><i class="bi bi-asterisk"></i></small>
            </label>
            <input type="text" id="<?= $idPrefix ?>pro_Name" data-project-field="pro_Name" name="<?= $namePrefix ?>[pro_Name]" class="form-control project-input" required 
                placeholder="Please provide a summary of this project/service/programme">
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12">
            <label for="<?= $idPrefix ?>pro_StartYear" class="nl">Started Year:
                <small class="text-danger"><i class="bi bi-asterisk"></i></small>
            </label>
            <input type="number" id="<?= $idPrefix ?>pro_StartYear" data-project-field="pro_StartYear" name="<?= $namePrefix ?>[pro_StartYear]" class="form-control project-input" required 
                placeholder="YYYY" min="1950">
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-lg-6 col-md-6 col-12">
            <label for="<?= $idPrefix ?>pro_Purpose" class="nl">Purpose:
                <small class="text-danger"><i class="bi bi-asterisk"></i></small>
            </label>
            <textarea id="<?= $idPrefix ?>pro_Purpose" data-project-field="pro_Purpose" name="<?= $namePrefix ?>[pro_Purpose]" class="form-control project-purpose" required rows="3" maxlength="700"
                placeholder="Please provide a summary of the objective for this project/service/programme." 
                style="resize: none;"></textarea>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12">
            <label for="<?= $idPrefix ?>pro_KeyObjectives" class="nl">Meeting DICM strategic objectives?
                <small class="text-danger"><i class="bi bi-asterisk"></i></small>
            </label>
            <textarea id="<?= $idPrefix ?>pro_KeyObjectives" data-project-field="pro_KeyObjectives" name="<?= $namePrefix ?>[pro_KeyObjectives]" class="form-control" required rows="3"
                placeholder="Please specify how this provision supports the strategic objectives of the DICM area."
                style="resize: none;"></textarea>
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-lg-6 col-md-6 col-12">
            <label for="<?= $idPrefix ?>pro_CollectData" class="nl">Data Collected?</label>
            <select class="form-control project-collect-data" id="<?= $idPrefix ?>pro_CollectData" data-project-field="pro_CollectData" name="<?= $namePrefix ?>[pro_CollectData]" data-placeholder="Have you collected Impact data?">
                <option></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12">
            <label for="<?= $idPrefix ?>pro_Impact" class="nl">Impact Achieved:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
            <textarea id="<?= $idPrefix ?>pro_Impact" data-project-field="pro_Impact" name="<?= $namePrefix ?>[pro_Impact]" class="form-control" rows="3" required
                placeholder="Please summarise the impact you've achieved so far."
                style="resize: none;"></textarea>
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-lg-6 col-md-6 col-12">
            <label for="<?= $idPrefix ?>pro_pccfunding" class="nl">Received Police, Council, or PCC Grant Funding?</label>
            <select class="form-control project-pcc-select" id="<?= $idPrefix ?>pro_pccfunding" data-project-field="pro_pccfunding" name="<?= $namePrefix ?>[pro_pccfunding]" data-placeholder="Have you received funding from Police, Council, or PCC?">
                <option></option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-12 funding-details">
            <label for="<?= $idPrefix ?>pro_fundingDetails" class="nl">Funding Details:</label>
            <textarea id="<?= $idPrefix ?>pro_fundingDetails" data-project-field="pro_fundingDetails" name="<?= $namePrefix ?>[pro_fundingDetails]" class="form-control" rows="3"
                placeholder="Please provide details of the funding received." 
                style="resize: none;" disabled></textarea>
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-12">
            <label for="<?= $idPrefix ?>pro_businessBenifits" class="nl">Business Benefits of Supporting This Ask:</label>
            <select class="form-control project-benefits-select" multiple="multiple" id="<?= $idPrefix ?>pro_businessBenifits" data-project-field="pro_businessBenifits" data-project-array="true" name="<?= $namePrefix ?>[pro_businessBenifits][]" data-placeholder="What will businesses get back by supporting this Ask?">
                <option></option>
                <option>Provide regular progress updates on the Pluggin Ecosystem for business supporters to utilise</option>
                <option>Engage with business sponsors on joint impact marketing</option>
                <option>Feature business sponsors on your website and socials</option>
                <option>Provide monthly meetings with your executive team</option>
            </select>
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-lg-4 col-md-4 col-12">
            <label for="<?= $idPrefix ?>pro_financialask" class="nl">Financial Ask (£):<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
            <input type="number" id="<?= $idPrefix ?>pro_financialask" data-project-field="pro_financialask" name="<?= $namePrefix ?>[pro_financialask]" class="form-control project-financial-ask" required
                placeholder="Enter amount">
        </div>
        <div class="form-group col-lg-8 col-md-8 col-12">
            <label for="<?= $idPrefix ?>pro_financialDetails" class="nl">Details of Financial Ask:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
            <textarea id="<?= $idPrefix ?>pro_financialDetails" data-project-field="pro_financialDetails" name="<?= $namePrefix ?>[pro_financialDetails]" class="form-control project-support-detail" rows="2"
                placeholder="Describe why financial support is needed" style="resize: none;"
                data-summary-label="Financial Support"></textarea>
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-lg-12 col-md-12 col-12">
            <label for="<?= $idPrefix ?>pro_equipmentDetails" class="nl">Details of Equipment Ask:</label>
            <textarea id="<?= $idPrefix ?>pro_equipmentDetails" data-project-field="pro_equipmentDetails" name="<?= $namePrefix ?>[pro_equipmentDetails]" class="form-control project-support-detail" rows="2"
                placeholder="Describe the type/types of equipment a business might consider providing" style="resize: none;"
                data-summary-label="Equipment Support"></textarea>
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-lg-12 col-md-12 col-12">
            <label for="<?= $idPrefix ?>pro_staffDetails" class="nl">Details of Professional Support Ask:</label>
            <textarea id="<?= $idPrefix ?>pro_staffDetails" data-project-field="pro_staffDetails" name="<?= $namePrefix ?>[pro_staffDetails]" class="form-control project-support-detail" rows="2"
                placeholder="Describe the type/types of volunteering support a business might consider providing’" style="resize: none;"
                data-summary-label="Professional Support"></textarea>
        </div>
    </div>

    <div class="row mt-3 p-0">
        <div class="form-group col-lg-4 col-md-4 col-12 text-center">
            <label for="<?= $idPrefix ?>pro_RequiredSponsorship" class="nl">Total Ask (£):<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
            <input type="number" class="form-control text-center font-weight-bold project-total-ask" id="<?= $idPrefix ?>pro_RequiredSponsorship"
                data-project-field="pro_RequiredSponsorship" name="<?= $namePrefix ?>[pro_RequiredSponsorship]" required placeholder="Total sponsorship required" readonly>
        </div>
        <div class="form-group col-lg-12 col-md-12 col-12">
            <label for="<?= $idPrefix ?>pro_AdditionResourcesNeeded" class="nl">Support Needed Going Forwards:<small class="text-danger"><i class="bi bi-asterisk"></i></small></label>
            <textarea id="<?= $idPrefix ?>pro_AdditionResourcesNeeded" data-project-field="pro_AdditionResourcesNeeded" name="<?= $namePrefix ?>[pro_AdditionResourcesNeeded]" class="form-control project-support-summary" rows="3" required
                placeholder="Summarized details of all support requests" style="resize: none;" readonly></textarea>
        </div>
    </div>
</div>
