<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $documentClasses; ?>" ng-app="lineal" ng-controller="CtrlDocument">
<?php $this->inc('elements/head.php'); ?>

<body class="<?php echo $templateHandle; ?>">

    <div id="c-level-1" class="<?php echo Page::getCurrentPage()->getPageWrapperClass(); ?>">
        <?php $this->inc('elements/header.php'); ?>

        <main>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <?php
                                /** @var $a \Concrete\Core\Area\Area */
                                $a = new Area(Concrete\Package\Lineal\Controller::AREA_MAIN);
                                $a->display($c);
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            /** @var $a \Concrete\Core\Area\Area */
                            $a = new Area(Concrete\Package\Lineal\Controller::AREA_MAIN_2);
                            $a->display($c);
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php $this->inc('elements/footer.php'); ?>
        </main>
    </div>

<?php Loader::element('footer_required'); ?>
</body>
</html>