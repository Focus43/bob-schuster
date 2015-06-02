<?php
/**
 * @var $headerClass string
 * @var $headerImages array
 * @var $showInidicators bool
 */
?>

<header class="<?php echo $headerClass; ?>">
    <?php $this->inc('elements/nav.php'); ?>

    <div wrapper>
        <?php if( $headerClass === 'home' ): // Homepage only ?>
            <?php if(!empty($headerImages)): ?>
                <div masthead data-transition-time="4500">
                    <?php foreach($headerImages AS $index => $fileObj){ ?>
                        <figure class="<?php echo $index === 0 ? 'active' : ''; ?>" style="background-image:url('<?php echo $fileObj->getThumbnailURL('header'); ?>');">
                            <div class="tabular">
                                <div class="cellular">
                                    <h1><?php echo $fileObj->getDescription(); ?></h1>
                                </div>
                            </div>
                        </figure>
                    <?php } ?>
                    <div class="indicators">
                        <?php for($i = 0; $i < count($headerImages); $i++): ?>
                            <a class="indicator <?php echo $i === 0 ? 'active' : ''; ?>"><i class="icon-circle-o"></i><i class="icon-circle"></i></a>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else: // Default header style for all ?>
            <div masthead data-transition-time="2500">
                <?php if(!empty($headerImages)): foreach($headerImages AS $index => $fileObj){ ?>
                    <figure class="<?php echo $index === 0 ? 'active' : ''; ?>" style="background-image:url('<?php echo $fileObj->getThumbnailURL('header'); ?>');"></figure>
                <?php } endif; ?>
                <div class="page-title">
                    <div class="page-title-inner">
                        <h1><?php echo Page::getCurrentPage()->getCollectionName(); ?></h1>
                        <?php if( !($hideDescription === true) ): ?>
                            <p><?php echo \Core::make('helper/text')->shorten(Page::getCurrentPage()->getCollectionDescription(), 90); ?></p>
                        <?php endif; ?>
                        <?php if( $showDateAndTags === true ): ?>
                            <div class="date-and-tags">
                                <span class="date">Published <strong><?php echo \Core::make('helper/date')->formatDate(Page::getCurrentPage()->getCollectionDatePublic(), true); ?></strong> in </span>
                                <?php
                                    $bt = BlockType::getByHandle('tags');
                                    $bt->controller->displayMode = 'page';
                                    $bt->controller->targetCID = Page::getByPath('/news')->getCollectionID();
                                    $bt->render('templates/custom');
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <a class="schuster-logo" href="/">
            <span>Robert P.</span><span>Schuster<b>P.C.</b></span><span>Attorneys At Law</span>
        </a>
    </div>
</header>