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
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 palette-3">
                        <div class="box-pad">
                            <div class="inner">
                                <?php $a = new Area('Home Col 2'); $a->display($c); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 palette-4">
                        <div class="box-pad">
                            <div class="inner">
                                <?php $a = new Area('Home Col 3'); $a->display($c); ?>
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