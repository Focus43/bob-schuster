<?php namespace Concrete\Package\Lineal\Controller\SinglePage {
    defined('C5_EXECUTE') or die("Access Denied.");

    class News extends \Concrete\Package\Lineal\Controller\LinealPageController {

        protected $_includeThemeAssets = true;

        public function view(){
            parent::view();
            $this->set('mastheadHelper', new \Concrete\Package\Lineal\Src\Helpers\Masthead($this->getPageObject()));
        }

        public function on_start(){
            parent::on_start();
            $this->set('templateHandle', sprintf('pg-%s', 'news'));
        }

    }

}