<div class="container-fluid">
    <div class="row">
        <?php foreach($chunkedList AS $list): ?>
            <div class="col-sm-<?php echo floor(12 / Concrete\Package\Lineal\Controller\SinglePage\News::COLUMN_COUNT); ?>">
                <?php foreach($list AS $page){
                    $title = $textHelper->entities($page->getCollectionName());
                    $descr = $textHelper->wordSafeShortText($page->getCollectionDescription(), 255);
                    $descr = $textHelper->entities($descr);
                    $date = $dateHelper->formatDate($page->getCollectionDatePublic(), false);
                    $url = $navHelper->getLinkToCollection($page);
                    ?>
                    <a class="news-post" href="<?php echo $url; ?>">
                        <h4><?php echo $title; ?></h4>
                        <span class="date"><?php echo $date; ?></span>
                        <p class="descr"><?php echo $description; ?></p>
                    </a>
                <?php } ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php echo $paginationView; ?>
        </div>
    </div>
</div>
