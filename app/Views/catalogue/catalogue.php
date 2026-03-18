<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<?php
    $initialProjects = json_decode($projects ?? '[]', true) ?? [];
    $totalResults = isset($total) ? (int) $total : 0;
    $perPage = isset($per_page) ? (int) $per_page : 0;
    $showLoadMore = $perPage > 0 && $totalResults > $perPage;
?>
<div class="catalog-container">
    <div class="top-bar">
        <div id="applied-filters"></div>
        <button id="clear-all" class="hidden">Reset</button>
    </div>

    <div class="main-content">
        <aside class="filters">
            <h3>Filters</h3>
            <div class="filter-group">
                <h4 class="f-title">Region</h4>
                <label><input type="checkbox" value="East Midlands"> East Midlands</label>
                <label><input type="checkbox" value="East of England"> East of England</label>
                <label><input type="checkbox" value="London"> London</label>
                <label><input type="checkbox" value="North East"> North East</label>
                <label><input type="checkbox" value="North West"> North West</label>
                <label><input type="checkbox" value="South East"> South East</label>
                <label><input type="checkbox" value="South West"> South West</label>
                <label><input type="checkbox" value="West Midlands"> West Midlands</label>
                <label><input type="checkbox" value="Yorks and Humber"> Yorks and Humber</label>
                <label><input type="checkbox" value="Scotland"> Scotland</label>
                <label><input type="checkbox" value="Wales"> Wales</label>
                <label><input type="checkbox" value="N. Ireland"> N. Ireland</label>
                <!-- <label><input type="checkbox" value="National"> National</label> -->
            </div>
            <!-- <div class="filter-group">
                <h4 class="f-title">Keywords</h4>
                <label><input type="checkbox" value="Alternative Learning"> Alternative Learning</label>
                <label><input type="checkbox" value="Creative Pathway"> Creative Pathway</label>
                <label><input type="checkbox" value="Healthier Communities"> Healthier Communities</label>
                <label><input type="checkbox" value="Safer Communities"> Safer Communities</label>
                <label><input type="checkbox" value="Sport in Communities"> Sport in Communities</label>
            </div> -->
        </aside>
        <section class="products">
            <div
                class="product-grid"
                id="product-grid"
                data-total="<?= esc($totalResults) ?>"
                data-per-page="<?= esc(max($perPage, 1)) ?>"
                data-current-page="1"
            >
                <?php foreach ($initialProjects as $project): ?>
                    <?php
                        $projectId = $project['id'] ?? '';
                        $projectName = $project['project_name'] ?? '';
                        $charityName = $project['charity_name'] ?? '';
                        $regions = $project['regions'] ?? '';
                        $logo = $project['img'] ?? 'default.jpg';
                        $imgPath = base_url('public/images/cselogos/' . $logo);
                        $detailUrl = base_url('detail') . '?project=' . rawurlencode($projectId);
                    ?>
                    <div class="product-card" data-id="<?= esc($projectId) ?>">
                        <div class="product-image">
                            <img src="<?= esc($imgPath) ?>"
                                 alt="<?= esc($projectName) ?>">
                        </div>
                        <div class="product-details">
                            <h6 class="product-title" title="<?= esc($projectName) ?>">
                                <?= esc($projectName) ?>
                            </h6>
                            <p class="product-charity" title="<?= esc($charityName) ?>">
                                <?= esc($charityName) ?>
                            </p>
                            <p class="product-region" title="<?= esc($regions) ?>">
                                <?= esc($regions) ?>
                            </p>
                            <a href="<?= esc($detailUrl) ?>">
                                <button class="add-to-cart">More Info</button>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="load-more-container">
                <button id="load-more" class="<?= $showLoadMore ? '' : 'hidden' ?>">Load More</button>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>
