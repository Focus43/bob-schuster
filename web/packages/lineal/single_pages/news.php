<div class="container-fluid">
    <?php
        $btPageList = BlockType::getByHandle('page_list');
        $btPageList->controller->num                = 15;
        $btPageList->controller->paginate           = 1;
        $btPageList->controller->cParentID          = Page::getCurrentPage()->getCollectionID();
        $btPageList->controller->orderBy            = 'chrono_desc';
        $btPageList->controller->includeDescription = 1;
        $btPageList->controller->truncateSummaries  = 1;
        $btPageList->controller->truncateChars      = 255;
        $btPageList->controller->includeDate        = 1;
        $btPageList->render('templates/news_list');
    ?>
</div>
