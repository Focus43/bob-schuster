<?php namespace Concrete\Package\Lineal\Controller {
    defined('C5_EXECUTE') or die("Access Denied.");

    use Loader;
    use PageController;
    use File;
    use FileSet;
    use Concrete\Package\Lineal\Controller AS PackageController;

    abstract class LinealPageController extends PageController {

        /** @property $_includeThemeAssets bool */
        protected $_includeThemeAssets = false;


        /**
         * Base controller's view method.
         * @return void
         */
        public function view(){
            if( $this->_includeThemeAssets === true ){
                $this->attachThemeAssets( $this );
            }
        }


        /**
         * @return void
         */
        public function on_start(){
            $this->set('documentClasses', join(' ', array(
                $this->pagePermissionObject()->canWrite() ? 'cms-admin' : null,
                $this->getPageObject()->isEditMode() ? 'cms-edit-mode' : null
            )));

            $this->set('templateHandle', sprintf('pg-%s', $this->getPageObject()->getPageTemplateHandle()));
        }


        /**
         * Include css/js assets in page output.
         * @param $pageController Controller : Forces the page controller to be injected!
         * @return void
         */
        public function attachThemeAssets( $pageController ){
            $googleFonts = implode('|', array(
                'Roboto+Slab:400,100,300,700',
                'Libre+Baskerville:400,700,400italic'
            ));
            // CSS
            $pageController->addHeaderItem('<link href="//fonts.googleapis.com/css?family='.$googleFonts.'" rel="stylesheet" type="text/css">');
            $pageController->addHeaderItem( $this->getHelper('helper/html')->css('core.css', PackageController::PACKAGE_HANDLE) );
            $pageController->addHeaderItem( $this->getHelper('helper/html')->css('app.css', PackageController::PACKAGE_HANDLE) );
            // JS
            //$pageController->addFooterItem('<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=' . LinealPackage::GOOGLE_MAPS_API_KEY . '"></script>');
            //$pageController->addFooterItem( $this->getHelper('helper/html')->javascript('core.js', PackageController::PACKAGE_HANDLE) );
            //$pageController->addFooterItem( $this->getHelper('helper/html')->javascript('app.js', PackageController::PACKAGE_HANDLE) );
        }


        /**
         * If the page background attribute is set explicitly on the page, that
         * takes precedence. Otherwise, look for and return a randomized image from
         * the Page Backgrounds set.
         * @return string || void
         */
        protected function getPageHeaderImageURL(){
            // Use a specifically-assigned header image
//            $fileObj = $this->getPageObject()->getAttribute('header_background');
//            if( $fileObj instanceof File ){
//                return $this->getHelper('helper/image')->setJpegCompression(PackageController::FULLSCREEN_IMG_COMPRESSION)->getThumbnail($fileObj, PackageController::FULLSCREEN_IMG_WIDTH, PackageController::FULLSCREEN_IMG_HEIGHT)->src;
//            }
//
//            /** @var $fileSetObj \Concrete\Core\File\Set\Set */
//            $fileSetObj = FileSet::getByName(PackageController::FILESET_HEADER_BACKGROUNDS);
//            $filesInSet = $fileSetObj->getFiles();
//            if( ! empty($filesInSet) ){
//                $fileObj = $filesInSet[array_rand($filesInSet, 1)];
//                if( $fileObj instanceof File ){
//                    return $this->getHelper('helper/image')->setJpegCompression(PackageController::FULLSCREEN_IMG_COMPRESSION)->getThumbnail($fileObj, PackageController::FULLSCREEN_IMG_WIDTH, PackageController::FULLSCREEN_IMG_HEIGHT)->src;
//                }
//            }
//            $fileListObj = new FileList;
//            $fileListObj->setPermissionLevel('view_file_set_file');
//            $fileListObj->filterBySet( FileSet::getByName(LinealPackage::FILESET_HEADER_BACKGROUNDS) );
//            $imagesList = $fileListObj->get();
//            if( !empty($imagesList) ){
//                $imageObj = $imagesList[ array_rand($imagesList, 1) ];
//                if( $imageObj instanceof File ){
//                    return $this->getHelper('image')->setJpegCompression(LinealPackage::FULLSCREEN_IMG_COMPRESSION)->getThumbnail($imageObj, LinealPackage::FULLSCREEN_IMG_WIDTH, LinealPackage::FULLSCREEN_IMG_HEIGHT)->src;
//                }
//            }
        }


        /**
         * Memoize helpers (beware, once loaded its always the same instance).
         * @param string $handle Handle of the helper to load
         * @param bool | Package $pkg Package to get the helper from
         * @return ...Helper class of some sort
         */
        public function getHelper( $handle, $pkg = false ){
            $helper = '_helper_' . preg_replace("/[^a-zA-Z0-9]+/", "", $handle);
            if( $this->{$helper} === null ){
                $this->{$helper} = \Core::make($handle);
            }
            return $this->{$helper};
        }


        /**
         * Get the Concrete5 permission object for the given page.
         * @return Permissions
         */
        protected function pagePermissionObject(){
            if( $this->_pagePermissionObj === null ){
                $this->_pagePermissionObj = new \Concrete\Core\Permission\Checker( \Concrete\Core\Page\Page::getCurrentPage() );
            }
            return $this->_pagePermissionObj;
        }

    }
}