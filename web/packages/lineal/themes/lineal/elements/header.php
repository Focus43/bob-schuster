<header class="<?php echo $masthead ? 'masthead' : ''; ?>">
    <?php $this->inc('elements/nav.php'); ?>

    <div wrapper>
        <?php if( $masthead ): ?>
            <aside masthead data-transition-time="4500">
                <?php $images = $mastheadHelper->getSlideshowImages(); foreach($images AS $index => $stdObj){ ?>
                    <figure class="<?php echo $index === 0 ? 'active' : ''; ?>" style="background-image:url('<?php echo $stdObj->path; //$stdObj->thumbnailObj->src; ?>');">
                        <div class="tabular">
                            <div class="cellular">
                                <h1><?php echo $stdObj->descr;//$stdObj->fileObj->getDescription(); ?></h1>
                                <a class="btn btn-custom-1 btn-lg">Learn More</a>
                            </div>
                        </div>
                    </figure>
                <?php } ?>
                <div class="indicators">
                    <?php for($i = 0; $i < count($images); $i++): ?>
                        <a class="indicator <?php echo $i === 0 ? 'active' : ''; ?>"><i class="icon-circle-o"></i><i class="icon-circle"></i></a>
                    <?php endfor; ?>
                </div>
            </aside>
        <?php endif; ?>

        <a class="schuster-logo" href="/">
            <span>Robert P.</span><span>Schuster<b>P.C.</b></span><span>Attorneys At Law</span>
        </a>

        <?php if(! $masthead ): ?>
            <div class="page-title" style="background-image:url(<?php if(is_object($mastheadHelper)){ echo $mastheadHelper->getSingleImageSrc(); } ?>);">
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
        <?php endif; ?>
    </div>

    <span class="masker"></span>
</header>