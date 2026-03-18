<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="MidContainer detail-view">
    <fieldset id="dCse" class="detail-shell">
        <div class="row gy-4 detail-layout">
            <div class="col-lg-5 col-xl-4">
                <div class="detail-card profile-card text-center">
                    <div class="profile-name-block">
                        <div class="profile-name" id="dCseName"></div>
                        <div class="profile-id"><small id="cseuId"></small></div>
                    </div>
                    <div class="profile-logo">
                        <img src="" id="logoImg" class="img-fluid" alt="Organisation logo">
                    </div>
                </div>
                <div class="detail-card">
                    <div class="detail-card__label">Region(s)</div>
                    <div class="detail-card__value readmore-target" id="dCseRegions"></div>
                </div>
                <div class="detail-card">
                    <div class="detail-card__label">Address</div>
                    <div class="detail-card__value readmore-target" id="dAdrress"></div>
                </div>
                <div class="detail-section mt-3">
                    <div class="detail-section__header">
                        <h3>CSE Details</h3>
                    </div>
                    <div class="detail-card">
                        <div class="pair-grid">
                            <div class="text-pair">
                                <span class="text-pair__label">Contact Name</span>
                                <span class="text-pair__value readmore-target" data-readmore-max="120" id="mcName"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Job Title</span>
                                <span class="text-pair__value" id="mcJTitle"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Phone</span>
                                <span class="text-pair__value" id="mcPhone"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Email</span>
                                <span class="text-pair__value" id="mcEmail"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Website</span>
                                <span class="text-pair__value" id="cwebsite"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Facebook</span>
                                <span class="text-pair__value" id="cfacebook"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">LinkedIn</span>
                                <span class="text-pair__value" id="clinkenIn"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Average Income</span>
                                <span class="text-pair__value" id="caincome"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Opening Date</span>
                                <span class="text-pair__value" id="dPSdate"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Charity Link</span>
                                <span class="text-pair__value" id="ccharitylink"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Registration</span>
                                <span class="text-pair__value" id="cregno"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-xl-8">
                <div class="detail-section mt-4">
                    <div class="detail-section__header">
                        <h3>The Organisation "Ask" Details</h3>
                    </div>
                    <div class="detail-card">
                        <div class="pair-grid pair-grid--dense">
                            <div class="text-pair">
                                <span class="text-pair__label">Name</span>
                                <span class="text-pair__value readmore-target" data-readmore-max="120" id="proName"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Start Date</span>
                                <span class="text-pair__value" id="psDate"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Sponsorship Ask</span>
                                <span class="text-pair__value" id="dPRsponsorship"></span>
                            </div>
                            <div class="text-pair">
                                <span class="text-pair__label">Impact</span>
                                <span class="text-pair__value" id="impact"></span>
                            </div>
                            <div class="text-pair text-pair--full">
                                <span class="text-pair__label">Data Collected</span>
                                <span class="text-pair__value" id="pImpactData"></span>
                            </div>
                            <div class="text-pair text-pair--full">
                                <span class="text-pair__label">Provision's Existing Sponsors</span>
                                <div class="text-pair__value readmore-target" id="proSponsor"></div>
                            </div>
                            <div class="text-pair text-pair--full">
                                <span class="text-pair__label">Provision's Purpose in the Area</span>
                                <div class="text-pair__value readmore-target" data-readmore-max="150" id="proPurpose"></div>
                            </div>
                            <div class="text-pair text-pair--full">
                                <span class="text-pair__label">DICM Objectives</span>
                                <div class="text-pair__value readmore-target" data-readmore-max="150" id="proObjectives"></div>
                            </div>
                            <div class="text-pair text-pair--full">
                                <span class="text-pair__label">Support Required</span>
                                <div class="text-pair__value readmore-target" data-readmore-max="150" id="proRresources"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 g-3 cta-row">
            <div class="col text-center">
                <a class="btn-flip p-2" data-back="Back to Main Menu" data-front="Back" href="<?php echo base_url('/catalogue')?>"></a>
            </div>
            <div class="col text-center">
                <a class="btn-flip p-2" data-back="Sponsor Me Now" data-front="Sponsor Me" href="<?php echo base_url('spocreate/?project=' . esc($project_id, 'attr')) ?>"></a>
            </div>
        </div>
    </fieldset>
</div>

<!-- Sponsor Me form Table -->
<div class="modal fade" id="cseSModal" tabindex="-1" aria-labelledby="cseSModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="cseSModalLabel">Support Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure, you want to delete this user? You want be able to revert it.</p>
                <input type="hidden" name="cse_id" id="cse_id" value="<?php echo $id;?>">
            </div>
            <div class="modal-footer d-flex align-items-center justify-content-evenly">
                <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="d-flex align-items-center justify-content-evenly">
                            <button type="button" id="dellCse" class="btn notaction-button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function () {
        const payload = <?php echo $data;?>;
        const record = Array.isArray(payload) ? (payload[0] || {}) : {};
        const project = record.pro || {};
        const socials = record.socials || {};
        const mainContact = record.mc || {};

        const safeText = (value, fallback = 'Not Available') => {
            if (value === undefined || value === null || value === '') {
                return fallback;
            }
            return value;
        };

        $('#dCseName').text(safeText(record["Organisation Name"], ''));
        $('#dCseRegions').text(safeText(record["Regions"]));
        $('#dCseType').text(safeText(record["CSE Type"]));
        $('#dCseTheme').text(safeText(record["CSE Theme"]));
        $('#cseuId').text(safeText(record["unique_id"], ''));
        $('#caincome').text(safeText(record["Annual Income"], 'Not Available'));
        $('#dPSdate').text(safeText(project["Start Year"]));
        $('#psDate').text(safeText(project["Start Year"]));
        $('#dAdrress').text(safeText(mainContact["Organisation Address"]));

        const crno = record["Social Enterprise Registration Number"];
        const charityNo = record["Charity Registration Number"];
        $('#ccharitylink').empty().text('Not Registered');
        if (charityNo && !isNaN(Number(charityNo))) {
            $('#ccharitylink').html(`<a href="https://www.google.com/search?q=charity%20number+${charityNo}" target="_blank" rel="noopener">Charity ${charityNo}</a>`);
        }
        $('#cregno').empty().text('Not Available');
        if (crno) {
            $('#cregno').html(`<a href="https://find-and-update.company-information.service.gov.uk/company/${crno}" target="_blank" rel="noopener">${crno}</a>`);
        }

        const logo = socials["Logo"] ? `${base_url}public/images/cselogos/${socials["Logo"]}` : `${base_url}public/images/Sirlogo.jpg`;
        $('#logoImg').attr('src', logo);

        const linkTargets = [
            { selector: '#cfacebook', label: 'Facebook', value: socials["Facebook"] },
            { selector: '#clinkenIn', label: 'LinkedIn', value: socials["Instagram"] },
            { selector: '#cwebsite', label: 'Website', value: socials["Website"] },
        ];
        linkTargets.forEach((item) => {
            const $el = $(item.selector).empty();
            if (item.value) {
                $el.append(`<a href="${item.value}" target="_blank" rel="noopener">${item.label}</a>`);
            } else {
                $el.text('Not Available');
            }
        });

        $('#mcName').text(safeText(mainContact["Name"]));
        $('#mcPhone').text(safeText(mainContact["Phone"]));
        $('#mcEmail').text(safeText(mainContact["Email"]));
        $('#mcJTitle').text(safeText(mainContact["Job Title"]));

        $('#proName').text(safeText(project["Name"]));
        $('#proSponsor').text(safeText(record["Current Sponsors"]));
        $('#pImpactData').text(safeText(project["Project Impact"]));
        $('#impact').text(safeText(project["Collected Impact Data"]));
        $('#dPRsponsorship').text(project["Required Sponsorship"] ? `£${project["Required Sponsorship"]}` : 'Not Available');

        $('#proPurpose').text(safeText(project["Purpose"]));
        $('#proObjectives').text(safeText(project["Key Objectives"]));
        $('#proRresources').text(safeText(project["Addition Resources Needed"]));

        const summaryRows = [
            ['Organisation Name', record["Organisation Name"]],
            ['Regions', record["Regions"]],
            ['Organisation Type', record["CSE Type"]],
            ['Organisation Theme', record["CSE Theme"]],
            ['Project Name', project["Name"]],
            ['Project Start Year', project["Start Year"]],
            ['Project Purpose', project["Purpose"]],
            ['Required Resources', project["Addition Resources Needed"]],
            ['Required Sponsorship', project["Required Sponsorship"]],
            ['Business Benefits', project["Business Benefits"]],
        ];

        const $summary = $('#dfs').empty();
        summaryRows.forEach(([label, value]) => {
            $summary.append(`
                <tr>
                    <td class="fs-5">${label}:</td>
                    <td>${safeText(value, 'Not Available')}</td>
                </tr>
            `);
        });

        const initReadMore = () => {
            const DEFAULT_HEIGHT = 110;
            $('.readmore-target').each(function () {
                const $target = $(this);
                const customHeight = parseInt($target.data('readmore-max'), 10);
                const maxHeight = Number.isFinite(customHeight) ? customHeight : DEFAULT_HEIGHT;
                if (!$target.find('.readmore-content').length) {
                    const contentHtml = $target.html();
                    $target.empty().append(`<div class="readmore-content">${contentHtml}</div>`);
                }
                const $content = $target.find('.readmore-content');
                $content.css('max-height', `${maxHeight}px`);
                const needsToggle = $content[0] && $content[0].scrollHeight > maxHeight;
                const $existingToggle = $target.find('.readmore-toggle');
                if (!needsToggle) {
                    $target.removeClass('has-readmore expanded');
                    $existingToggle.remove();
                    return;
                }
                $target.addClass('has-readmore').removeClass('expanded');
                let $toggle = $existingToggle;
                if (!$toggle.length) {
                    $toggle = $('<button>', {
                        type: 'button',
                        class: 'readmore-toggle',
                        text: 'Read More',
                    });
                    $target.append($toggle);
                } else {
                    $toggle.text('Read More');
                }
                $toggle.off('click').on('click', function () {
                    $target.toggleClass('expanded');
                    $toggle.text($target.hasClass('expanded') ? 'Show Less' : 'Read More');
                });
            });
        };
        initReadMore();
    })();
</script>
<?= $this->endSection() ?>
