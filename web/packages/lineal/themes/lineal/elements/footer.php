<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-3 hidden-xs">
                <div class="box-pad border-5">
                    <a class="schuster-logo" href="/">
                        <span>Robert P.</span><span>Schuster<b>P.C.</b></span><span>Attorneys At Law</span>
                    </a>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="box-pad border-3">
                    <h4>Recognition</h4>
                    <ul class="list-unstyled memberships">
                        <li><a>MartinDale Hubbel</a></li>
                        <li><a>SuperLawyers</a></li>
                        <li><a>Best Lawyers</a></li>
                        <li><a>National Top 100 Trial Lawyers</a></li>
                    </ul>
                    <!--<div class="badges">
                        <img src="<?php echo LINEAL_IMAGE_PATH; ?>logos/ali_aba.png" alt="" />
                        <img src="<?php echo LINEAL_IMAGE_PATH; ?>logos/super_lawyers.png" alt="" />
                        <img src="<?php echo LINEAL_IMAGE_PATH; ?>logos/best_law_firms_us_news.png" alt="" />
                    </div>-->
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="box-pad border-2">
                    <h4>Recent News</h4>
                    <?php
                        $pageListObj = new \Concrete\Core\Page\PageList();
                        $pageListObj->disableAutomaticSorting();
                        $pageListObj->sortByPublicDate();
                        $pageListObj->filterByPageTypeID( PageType::getByHandle('news')->getPageTypeID() );
                        $pageListObj->setItemsPerPage(1);
                        $paginationObj = $pageListObj->getPagination();
                        $resultSet     = $paginationObj->getCurrentPageResults();
                        if( !empty($resultSet) ){ ?>
                            <a class="recent-news-item" href="<?php echo View::url($resultSet[0]->getCollectionPath()); ?>">
                                <span><?php echo Loader::helper('text')->wordSafeShortText($resultSet[0]->getCollectionName(), 75); ?></span>
                                <button type="button" class="btn btn-xs btn-translucent">Read More</button>
                            </a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="box-pad border-4">
                    <h4>Get In Touch</h4>
                    <address>
                        PO Box 13610, Suite 204<br>
                        250 Veronica Lane<br>
                        Jackson, WY 83002
                    </address>
                    <p><strong>Tel:</strong> (307) 732-7800<br><strong>Em:</strong> info@bobschuster.com</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box-pad translucent text-center">
                    <p>&copy; <?php echo date('Y'); ?> Robert P. Schuster. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>