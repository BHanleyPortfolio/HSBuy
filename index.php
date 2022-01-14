<?php include 'header.php'; ?>

<!-- End Preload -->

<?php if(file_exists('html/header.html')){require 'html/header.html';} ?>

<main>
    <div class="hero_home version_1">
        <div class="content">
            <h3>Find Your Cards!</h3>
            <p>
                Paste your deck code here to see what packs you should buy.
            </p>
            <form method="post" action="detail-page.php">
                <div id="custom-search-input">
                    <div class="input-group">
                        <input type="text" class=" search-query" name="code" placeholder="Paste deck code here...">
                        <input type="submit" class="btn_search" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /Hero -->

<?php //include 'main-title.php'; ?>

 <?php //include 'most-viewed.php'; ?>

 <?php //include 'location.php'; ?>

<?php //include 'app-section.php'; ?>
</main>
<!-- /main content -->

<?php include 'footer.php'; ?>