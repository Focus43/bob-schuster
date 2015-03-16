<?php namespace Concrete\Package\Lineal\Src\Helpers {

    use File;
    use FileSet;
    use Loader;
    use Concrete\Package\Lineal\Controller AS PackageController;

    class Masthead {

        /** @var $pageObj \Concrete\Core\Page\Page */
        protected $pageObj;


        /**
         * When initializing the helper, pass in the $pageObject for methods to
         * pull attributes from, if necessary.
         * @param \Concrete\Core\Page\Page $pageObject
         */
        public function __construct( \Concrete\Core\Page\Page $pageObject ){
            $this->pageObj = $pageObject;
        }


        /**
         * Return a list of images.
         * @return array
         */
        public function getSlideshowImages(){
            /** @var $fileSetObj \Concrete\Core\File\Set\Set */
            $fileSetObj = FileSet::getByName(PackageController::FILESET_HOMEPAGE_SLIDESHOW);
            if( $fileSetObj instanceof \Concrete\Core\File\Set\Set ){
                $resizedSet  = array();
                $imagesInSet = $fileSetObj->getFiles();
                $imageHelper = \Core::make('helper/image'); /** @var $imageHelper ImageHelper */
                $imageHelper->setJpegCompression(PackageController::FULLSCREEN_IMG_COMPRESSION);
                if( ! empty($imagesInSet) ){
                    foreach($imagesInSet AS $fileObj){ /** @var $fileObj File */
                        if( $fileObj instanceof File ){
                            array_push($resizedSet, (object)array(
                                'path'  => $fileObj->getRelativePath(),
                                'descr' => $fileObj->getDescription()
                                //'thumbnailObj'  => $imageHelper->getThumbnail($fileObj, PackageController::FULLSCREEN_IMG_WIDTH, PackageController::FULLSCREEN_IMG_HEIGHT),
                                //'fileObj'       => $fileObj
                            ));
                        }
                    }
                }
                return $resizedSet;
            }
            return array();
        }


        /**
         * First, try and get a specific image assigned to the page attribute header_background,
         * and return the path to its' resized source.
         * Second, pull a random image from the Header Backgrounds file set and return the path
         * to its' resized source.
         *
         * @return string
         */
        public function getSingleImageSrc(){
            $fileObj = $this->pageObj->getAttribute('header_background');
            if( $fileObj instanceof File && $fileObj->getFileID() >= 1 ){
                return \Core::make('helper/image')->setJpegCompression(PackageController::FULLSCREEN_IMG_COMPRESSION)->getThumbnail($fileObj, PackageController::FULLSCREEN_IMG_WIDTH, PackageController::FULLSCREEN_IMG_HEIGHT)->src;
            }

            /** @var $fileSetObj \Concrete\Core\File\Set\Set */
            $fileSetObj = FileSet::getByName(PackageController::FILESET_HEADER_BACKGROUNDS);
            $filesInSet = $fileSetObj->getFiles();
            if( ! empty($filesInSet) ){
                $fileObj = $filesInSet[array_rand($filesInSet, 1)];
                if( $fileObj instanceof File ){
                    return \Core::make('helper/image')->setJpegCompression(PackageController::FULLSCREEN_IMG_COMPRESSION)->getThumbnail($fileObj, PackageController::FULLSCREEN_IMG_WIDTH, PackageController::FULLSCREEN_IMG_HEIGHT)->src;
                }
            }
        }

    }

}