<?php namespace Concrete\Package\Lineal\Controller\PageType {
    defined('C5_EXECUTE') or die("Access Denied.");

    class Page extends \Concrete\Package\Lineal\Controller\LinealPageController {

        protected $_includeThemeAssets = true;

        public function view(){
            parent::view();
            $this->set('mastheadHelper', new \Concrete\Package\Lineal\Src\Helpers\Masthead($this->getPageObject()));
        }

    }
}

