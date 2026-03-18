<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>

<div class="profile-shell">
    <div class="row g-4">
        <div class="col-12 col-xl-4 order-2 order-xl-1">
            <div class="profile-card">
                <div class="profile-card__header text-center">
                    <div class="profile-card__avatar">
                        <?php if (!empty($organisation['logo'])): ?>
                            <img src="<?= base_url('public/images/cselogos/' . esc($organisation['logo'])) ?>" alt="Logo" />
                        <?php else: ?>
                            <span class="avatar-placeholder"><?= strtoupper(substr($organisation['name'] ?? 'NA', 0, 2)) ?></span>
                        <?php endif; ?>
                    </div>
                    <h2><?= esc($organisation['name'] ?? 'Organisation') ?></h2>
                    <p class="text-muted mb-0"><?= esc($organisation['regions'] ?? 'Regions not defined') ?></p>
                    <p class="text-muted small"><?= esc($organisation['address'] ?? 'Address unavailable') ?></p>
                </div>
                <div class="profile-card__body">
                    <div class="profile-meta">
                        <span>Membership</span>
                        <strong><?= esc($u_id ?? ' ') ?></strong>
                    </div>
                    <div class="mt-3 text-center">
                        <a class="btn btn-outline-success btn-sm" href="mailto:membership_team@pluggin.org" target="_blank" rel="noopener">
                            Contact Pluggin Membership Support Team
                        </a>
                    </div>
                </div>
            </div>

            <div class="profile-card mb-4">
                <div class="profile-card__title"><?= esc($impactTitle ?? 'Commercial Overview') ?></div>
                <div class="profile-grid profile-grid--two">
                    <?php foreach ($impactBlocks as $block): ?>
                        <div class="profile-grid__tile readmore-target" data-readmore-max="180">
                            <span><?= esc($block['label']) ?></span>
                            <p><?= esc($block['value'] ?? 'Not Available') ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="profile-card">
                <div class="profile-card__title d-flex justify-content-between align-items-center">
                    <span>Profile Updates</span>
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#profileUpdateModal">
                        Request Change
                    </button>
                </div>
                <ul class="list-unstyled mb-0 profile-requests">
                    <?php if (!empty($updateRequests)): ?>
                        <?php foreach ($updateRequests as $request): ?>
                            <li>
                                <span class="badge bg-light text-dark"><?= esc(ucfirst($request['status'])) ?></span>
                                <small class="text-muted ms-2"><?= esc(date('d M Y', strtotime($request['created_at'] ?? 'now'))) ?></small>
                                <p class="mb-0 text-truncate small"><?= esc(substr($request['payload'] ?? '', 0, 120)) ?></p>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-muted small">No update requests submitted.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-12 col-xl-8 order-1 order-xl-2">
            <div class="profile-card mb-4">
                <div class="profile-card__title"><?= esc($contactTitle ?? 'Business Details') ?></div>
                <div class="profile-grid">
                    <?php foreach ($contactBlocks as $block): ?>
                        <div class="profile-grid__tile">
                            <span><?= esc($block['label']) ?></span>
                            <?php if (!empty($block['isLink']) && !empty($block['value'])): ?>
                                <a href="<?= esc($block['value']) ?>" target="_blank" rel="noopener">
                                    <?= esc($block['value']) ?>
                                </a>
                            <?php else: ?>
                                <p><?= esc($block['value'] ?? 'Not Available') ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="profile-card">
                <div class="profile-card__title d-flex justify-content-between align-items-center">
                    <span>Delegated Access</span>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#delegateModal">
                        Add Team Member
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-borderless mb-0" id="delegateTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="delegateTableBody">
                    <?php if (!empty($delegates)): ?>
                        <?php foreach ($delegates as $delegate): ?>
                            <tr data-delegate-id="<?= esc($delegate['delegate_id'] ?? 0) ?>">
                                <td><?= esc($delegate['invite_name'] ?? '') ?></td>
                                <td><?= esc($delegate['invite_email'] ?? '') ?></td>
                                <td><span class="badge bg-light text-dark"><?= esc(ucfirst($delegate['invite_status'] ?? 'pending')) ?></span></td>
                                <td class="text-end">
                                    <?php if (($delegate['invite_status'] ?? '') !== 'revoked'): ?>
                                        <button class="btn btn-link btn-sm text-decoration-none delegate-resend">Resend</button>
                                        <button class="btn btn-link text-danger btn-sm text-decoration-none delegate-revoke">Revoke</button>
                                    <?php else: ?>
                                        <span class="text-muted small">Revoked</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if (empty($delegates)): ?>
            <p class="text-muted small mt-2">No team members yet.</p>
        <?php endif; ?>
    </div>
        </div>
    </div>
</div>

<?= $this->include('profile/partials/delegate_modal') ?>
<?= $this->include('profile/partials/update_modal') ?>

<script>
    window.profileContext = {
        delegates: <?= json_encode($delegates ?? []) ?>,
        parentEmail: <?= json_encode($profile['display_email'] ?? $primaryEmail ?? '') ?>,
        organisation: <?= json_encode($organisation ?? []) ?>,
        contact: <?= json_encode($contactBlocks ?? []) ?>,
        rawProfile: <?= json_encode($raw ?? []) ?>,
    };
</script>

<?= $this->endSection() ?>
