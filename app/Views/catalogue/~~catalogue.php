<?= $this->extend('mainlayout/main') ?>
<?= $this->section('content') ?>
<div class="catalog-container">
    <div class="top-bar">
        <span id="result-count">62 Results</span>
        <div id="applied-filters"></div>
        <button id="clear-all" class="hidden">Reset</button>
    </div>

    <div class="main-content">
        <aside class="filters">
            <h3>Filters</h3>
            <div class="filter-group">
                <h4>Region</h4>
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
            <div class="filter-group">
                <h4>Keywords</h4>
                <label><input type="checkbox" value="Alternative Learning"> Alternative Learning</label>
                <label><input type="checkbox" value="Creative Pathway"> Creative Pathway</label>
                <label><input type="checkbox" value="Healthier Communities"> Healthier Communities</label>
                <label><input type="checkbox" value="Safer Communities"> Safer Communities</label>
                <label><input type="checkbox" value="Sport in Communities"> Sport in Communities</label>
            </div>
        </aside>
        <section class="products">
            <!-- <h3>Product Listings</h3> -->
            <div class="product-grid">
                <?php foreach(json_decode($cse) as $c): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <?php if($c->img): ?>
                            <img src="<?php echo base_url('public/images/cselogos/') . $c->img ?>" alt="Avatar" class="cimage">
                            <?php else: ?>
                            <img src="<?php echo base_url('public/images/Sirlogo.jpg') ?>" alt="Avatar" class="cimage">
                            <?php endif; ?>
                        </div>
                        <div class="product-details">
                            <p class="product-description"><?= $c->type ?></p>
                            <div class="buttons">
                            <a href="<?php echo base_url() . 'detail?id=' . base64_encode($c->id); ?>">
                                <button class="add-to-cart">More Info</button>
                            </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="load-more-container">
                <button id="load-more" class="hidden">Load More</button>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>
