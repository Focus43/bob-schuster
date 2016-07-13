<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $documentClasses; ?>" ng-app="lineal" ng-controller="CtrlDocument">
<?php $this->inc('elements/head.php'); ?>

<body class="<?php echo $templateHandle; ?>">

    <div id="c-level-1" class="<?php echo Page::getCurrentPage()->getPageWrapperClass(); ?>">
        <?php $this->inc('elements/header.php', array(
            'hideDescription'   => true,
            'showDateAndTags'   => true
        )); ?>

        <main>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
<!--                            --><?php
//                                $currentPageObj = Page::getCurrentPage();
//                                echo '<h1>'.$currentPageObj->getCollectionName().'</h1>';
//                            ?>
<!--                            <div class="date-and-tags">-->
<!--                                <span class="date">Published <strong>--><?php //echo \Core::make('helper/date')->formatDate(Page::getCurrentPage()->getCollectionDatePublic(), true); ?><!--</strong> in </span>-->
<!--                                --><?php
//                                    $bt = BlockType::getByHandle('tags');
//                                    $bt->controller->displayMode = 'page';
//                                    $bt->controller->targetCID = Page::getByPath('/news')->getCollectionID();
//                                    $bt->render('templates/custom');
//                                ?>
<!--                            </div>-->


                            <?php    /** @var $a \Concrete\Core\Area\Area */
                                $a = new Area(Concrete\Package\Lineal\Controller::AREA_MAIN);
                                $a->display($c);
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php Loader::packageElement('tags_list', 'lineal', array('selectedTag' => $selectedTag)); ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php $this->inc('elements/footer.php'); ?>
            <script type="application/ld+json">
                <?php 
                    include('elements/json_id.php');
                    echo json_encode($payload);
                ?>

            </script>
        </main>
    </div>

<?php Loader::element('footer_required'); ?>
</body>
</html>