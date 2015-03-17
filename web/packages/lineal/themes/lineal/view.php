<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $documentClasses; ?>" ng-app="lineal" ng-controller="CtrlDocument">
<?php $this->inc('elements/head.php'); ?>

<body class="<?php echo $templateHandle; ?>">

    <div id="c-level-1" class="<?php echo Page::getCurrentPage()->getPageWrapperClass(); ?>">
        <?php $this->inc('elements/header.php', array(
            'masthead'          => false,
            'mastheadHelper'    => $mastheadHelper
        )); ?>

        <main>
            <section>
                <?php print $innerContent; ?>
            </section>

            <?php $this->inc('elements/footer.php'); ?>
        </main>
    </div>

<?php Loader::element('footer_required'); ?>
</body>
</html>