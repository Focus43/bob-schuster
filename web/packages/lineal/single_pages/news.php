<div class="container spaced">
    <div class="row">
        <div class="col-sm-9">
            <?php if( is_object($selectedTag) ): ?>
                <div class="selected-tag">
                    <h5>Viewing articles in <i><?php echo $selectedTag; ?></i></h5>
                </div>
            <?php endif; ?>
            <div class="post-results">
                <?php foreach($pageResults AS $page): /** @var $page \Concrete\Core\Page\Page */
                    $title      = $textHelper->entities($page->getCollectionName());
                    $descr      = $textHelper->wordSafeShortText($page->getCollectionDescription(), 255);
                    $descr      = $textHelper->entities($descr);
                    $dateObj    = new \DateTime($page->getCollectionDatePublic());
                    $url        = $navHelper->getLinkToCollection($page);
                    $tags       = $page->getAttribute('tags');
                    ?>
                    <a class="news-post" href="<?php echo $url; ?>">
                        <h3><?php echo $title; ?></h3>
                        <span date>
                            <b month-year><?php echo $dateObj->format('M'); ?> <?php echo $dateObj->format('Y'); ?></b>
                            <b day><?php echo $dateObj->format('d'); ?></b>
                        </span>
                        <p class="descr"><?php echo $descr; ?></p>
                        <label tags>In
                            <?php if(!empty($tags)): foreach($tags AS $optTag): ?>
                                <span><?php echo $optTag; ?></span>
                            <?php endforeach; else: echo '<i>None</i>'; endif; ?>
                        </label>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php echo $paginationView; ?>
        </div>
        <div class="col-sm-3">
            <?php Loader::packageElement('tags_list', 'lineal', array('selectedTag' => $selectedTag)); ?>
        </div>
    </div>
</div>
