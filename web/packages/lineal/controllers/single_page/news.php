<?php namespace Concrete\Package\Lineal\Controller\SinglePage {
    defined('C5_EXECUTE') or die("Access Denied.");

    use Loader;
    use PageList;
    use PageType;
    use CollectionAttributeKey;

    class News extends \Concrete\Package\Lineal\Controller\LinealPageController {

        const PAGINATION = 10;

        /** @var $_pageListObj \Concrete\Core\Page\PageList */
        protected $_pageListObj;
        protected $_includeThemeAssets = true;

        public function on_start(){
            parent::on_start();
            $this->set('templateHandle', sprintf('pg-%s', 'news'));
        }

        public function view(){
            parent::view();
            $this->set('pageResults', $this->pageListResults());
            $this->set('textHelper', Loader::helper('text'));
            $this->set('dateHelper', \Core::make('helper/date'));
            $this->set('navHelper', Loader::helper('navigation'));
        }


        /**
         * PAGES NEED TO BE INDEXED FOR SEARCH TO WORK
         * @todo: auto-index pages on create?
         * @param null $tag
         */
        public function tag( $tag = null ){
            $tagTextValue = Loader::helper('text')->unhandle($tag);
            $attrKeyObj   = CollectionAttributeKey::getByHandle('tags');
            $optionObj    = \Concrete\Attribute\Select\Option::getByValue($tagTextValue, $attrKeyObj);
            if( is_object($optionObj) ){
                $this->pageListObj()->filterByAttribute('tags', $optionObj);
                $this->set('selectedTag', $optionObj);
            }else{
                $this->set('tagNotFound', true);
            }
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
         * @return \Concrete\Core\Page\PageList
         */
        protected function pageListObj(){
            if( $this->_pageListObj === null ){
                $this->_pageListObj = new PageList();
                $this->_pageListObj->disableAutomaticSorting();
                $this->_pageListObj->sortByPublicDateDescending();
                $this->_pageListObj->filterByPath( $this->getPageObject()->getCollectionPath() );
                $this->_pageListObj->filterByPageTypeID( PageType::getByHandle('news')->getPageTypeID() );
                $this->_pageListObj->setItemsPerPage(self::PAGINATION);

            }
            return $this->_pageListObj;
        }
    }

}