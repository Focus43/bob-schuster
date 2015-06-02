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
                    <h4>Professional Honors</h4>
                    <ul class="list-unstyled memberships">
                        <li><a href="/professional-honors">Martindale-Hubbell</a></li>
                        <li><a href="/professional-honors">SuperLawyers</a></li>
                        <li><a href="/professional-honors">Best Lawyers</a></li>
                        <li><a href="/professional-honors">National Top 100 Trial Lawyers</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="box-pad border-2">
                    <h4>Developments in the Law</h4>
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
                    <div style="display:block;">
                        <address>
                            250 Veronica Lane<br/>
                            Suite 204<br/>
                            P.O. Box 13160<br>
                            Jackson, WY 83002
                        </address>
                        <p><strong>Telephone:</strong> (307) 732-7800<br><strong>Email:</strong> <a href="mailto:info@bobschuster.com" style="color:#cad2c5;text-decoration:underline;">info@bobschuster.com</a><br/><strong>Fax:</strong> (307) 732-7801</p>
                    </div>
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