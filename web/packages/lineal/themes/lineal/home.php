<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $documentClasses; ?>" ng-app="lineal" ng-controller="CtrlDocument">
<?php $this->inc('elements/head.php'); ?>

<body class="<?php echo $templateHandle; ?>">

    <div id="c-level-1" class="<?php echo Page::getCurrentPage()->getPageWrapperClass(); ?>">
        <?php $this->inc('elements/header.php', array(
            'headerClass'       => 'home',
            'headerImages'      => $headerImages
        )); ?>

        <main>
            <div class="slants container-fluid">
                <div class="row padless">
                    <div class="col-md-4 palette-2">
                        <div class="box-pad">
                            <div class="inner">
                                <?php $a = new Area('Home Col 1'); $a->display($c); ?>
                                <!--<h2>Complex Litigation</h2>
                                <p>Recognized as one of the most successful trial firms in the country, our success relies on the simplest formula: personal attention to clients, creativity, unrelenting hard work, and aggressive devotion to excellence.</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 palette-3">
                        <div class="box-pad">
                            <div class="inner">
                                <?php $a = new Area('Home Col 2'); $a->display($c); ?>
                                <!--<h2>Practice Areas</h2>
                                <p>Lorem ipsum dolor sit amet consect et tetur ipsum dolor sit amet dolor sit amet consect et tetur.</p>
                                <a class="btn btn-custom-1 btn-block">Personal Injury</a>
                                <a class="btn btn-custom-1 btn-block">Commercial Litigation</a>
                                <a class="btn btn-custom-1 btn-block">White Collar Crime</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 palette-4">
                        <div class="box-pad">
                            <div class="inner">
                                <?php $a = new Area('Home Col 3'); $a->display($c); ?>
                                <!--<h2>Nationwide Practice</h2>
                                <p>Based in Jackson, WY, Robert P. Schuster is a team small in size, with a practice national in scope. Our principal, Robert P. Schuster has been recognized as one of the outstanding lawyers in the country by <i>The Best Lawyers In America</i> in both Commercial and Personal Injury Litigation.</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row padless">
                    <div class="col-sm-12">
                        <div parallax data-scale="35" style="background-image:url('<?php echo LINEAL_IMAGE_PATH; ?>field_blur2.jpg');">
                            <div class="parallax-inner1">
                                <div class="parallax-inner2">
                                    <?php $a = new Area('Home Sub 1'); $a->display($c); ?>
                                    <!--<h2>Lorem Ipsum Dolor</h2>
                                    <p>Lorem ipsum dolor sit amet, scripta instructior et mei, modo solum salutatus ea vis. Appellantur liberavisse te pri, his nobis scribentur conclusionemque id. Causae aliquam at duo, in vidit dolorum appellantur per. Causae imperdiet an vim. Te possim oporteat deserunt quo. Et aperiam commune conceptam sed, has elit efficiantur philosophia ad.</p>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->inc('elements/footer.php'); ?>
        </main>
    </div>

<?php Loader::element('footer_required'); ?>
</body>
</html>