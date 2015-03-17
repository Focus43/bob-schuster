<?php namespace Concrete\Package\Lineal\Controller\SinglePage {
    defined('C5_EXECUTE') or die("Access Denied.");

    use Loader;
    use PageList;
    use PageType;

    class News extends \Concrete\Package\Lineal\Controller\LinealPageController {

        const PAGINATION    = 15,
              COLUMN_COUNT  = 3;

        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
            $this->set('templateHandle', sprintf('pg-%s', 'news'));
        }

        public function view(){
            parent::view();
            $this->set('chunkedList', $this->chunkResults());
            $this->set('textHelper', Loader::helper('text'));
            $this->set('dateHelper', \Core::make('helper/date'));
            $this->set('navHelper', Loader::helper('navigation'));
        }


        protected function chunkResults(){
            $results    = $this->pageListResults();
            $chunked    = array();
            $iterator   = 0;
            if( !empty($results) ){
                foreach($results AS $pageObj){
                    if( !is_array($chunked[$iterator]) ){
                        $chunked[$iterator] = array();
                    }
                    array_push($chunked[$iterator], $pageObj);
                    $iterator = ($iterator < (self::COLUMN_COUNT-1)) ? $iterator + 1 : 0;
                }
            }
            return $chunked;
        }


        public function tag( $tag = null ){
            $this->pageListObj()->filterByTags(h($tag));
            $this->view();
        }


        /**
         * Return page list results *AND* implicitly setup pagination.
         * @return mixed
         */
        protected function pageListResults(){
            if( $this->_pageListResults === null ){
                $this->_paginationObj   = $this->pageListObj()->getPagination();
                $this->_pageListResults = $this->_paginationObj->getCurrentPageResults();
                if( $this->_paginationObj->getTotalPages() > 1 ){
                    $this->set('paginationView', $this->_paginationObj->renderDefaultView());
                }
            }
            return $this->_pageListResults;
        }


        /**
         * Setup the page list object
         * @return PageList
         */
        protected function pageListObj(){
            if( $this->_pageListObj === null ){
                $this->_pageListObj = new PageList();
                $this->_pageListObj->disableAutomaticSorting();
                $this->_pageListObj->sortByPublicDate();
                $this->_pageListObj->filterByPath( $this->getPageObject()->getCollectionPath() );
                $this->_pageListObj->filterByPageTypeID( PageType::getByHandle('news')->getPageTypeID() );
                $this->_pageListObj->setItemsPerPage(self::PAGINATION);

            }
            return $this->_pageListObj;
        }
    }

}