<?php namespace Concrete\Package\Lineal {
    defined('C5_EXECUTE') or die(_("Access Denied."));

    /** @link https://github.com/concrete5/concrete5-5.7.0/blob/develop/web/concrete/config/app.php#L10-L90 Aliases */
    use Loader; /** @see \Concrete\Core\Legacy\Loader */
    use Router; /** @see \Concrete\Core\Routing\Router */
    use Route; /** @see \Concrete\Core\Support\Facade\Route */
    use Package; /** @see \Concrete\Core\Package\Package */
    use BlockType; /** @see \Concrete\Core\Block\BlockType\BlockType */
    use BlockTypeSet; /** @see \Concrete\Core\Block\BlockType\Set */
    use PageType; /** @see \Concrete\Core\Page\Type\Type */
    use PageTemplate; /** @see \Concrete\Core\Page\Template */
    use PageTheme; /** @see \Concrete\Core\Page\Theme\Theme */
    use FileSet; /** @see \Concrete\Core\File\Set\Set */
    use CollectionAttributeKey; /** @see \Concrete\Core\Attribute\Key\CollectionKey */
    use UserAttributeKey; /** @see \Concrete\Core\Attribute\Key\UserKey */
    use FileAttributeKey; /** @see \Concrete\Core\Attribute\Key\FileKey */
    use Group; /** @see \Concrete\Core\User\Group\Group */
    use GroupSet; /** @see \Concrete\Core\User\Group\GroupSet */
    use SinglePage; /** @see \Concrete\Core\Page\Single */
    use Concrete\Core\Page\Type\PublishTarget\Type\Type as PublishTargetType;
    //use Concrete\Core\Backup\ContentImporter;

    class Controller extends Package {

        const PACKAGE_HANDLE                    = 'lineal';
        const GOOGLE_MAPS_API_KEY               = 'AIzaSyANFxVJuAgO4-wqXOeQnIfq38x7xmhMZXY';
        const FILESET_HOMEPAGE_SLIDESHOW        = 'Homepage Slideshow';
        const FILESET_HEADER_BACKGROUNDS        = 'Header Backgrounds';
        const ATTR_COLLECTION_HEADER_BACKGROUND = 'header_background';
        const FULLSCREEN_IMG_WIDTH              = 1536;
        const FULLSCREEN_IMG_HEIGHT             = 864;
        const FULLSCREEN_IMG_COMPRESSION        = 92;
        // Area names (as constants so we don't lose track!)
        const AREA_MAIN                         = 'Main';
        const AREA_MAIN_2                       = 'Main 2';



        protected $pkgHandle 			= self::PACKAGE_HANDLE;
        protected $appVersionRequired 	= '5.7.3.2';
        protected $pkgVersion 			= '0.13';


        /**
         * @return string
         */
        public function getPackageName(){
            return t('Lineal');
        }


        /**
         * @return string
         */
        public function getPackageDescription() {
            return t('Super Clean');
        }


        /**
         * Run hooks high up in the load chain.
         * @return void
         */
        public function on_start(){
            define('LINEAL_IMAGE_PATH', DIR_REL . '/packages/' . $this->pkgHandle . '/images/');
        }


        /**
         * Proxy to the parent uninstall method
         * @return void
         */
        public function uninstall() {
            parent::uninstall();

            try {
                // delete database tables (if applicable)
            }catch(Exception $e){ /* FAIL GRACEFULLY */ }
        }


        /**
         * Run before install or upgrade to ensure dependencies are present
         */
        private function checkDependencies(){

        }


        /**
         * @return void
         */
        public function upgrade(){
            $this->checkDependencies();
            parent::upgrade();
            $this->installAndUpdate();
        }


        /**
         * @return void
         */
        public function install() {
            $this->checkDependencies();
            $this->_packageObj = parent::install();
            $this->installAndUpdate();
        }


        /**
         * Handle all the updating methods.
         * @return void
         */
        private function installAndUpdate(){
            $this->setupPageTypes();return;
            $this->setupFileSets()
                ->setupAttributeTypes()
                ->setupCollectionAttributes()
                ->setupFileAttributes()
                ->setupTheme()
                ->setupTemplates()
                ->setupPageTypes()
                ->assignPageTypes()
                ->setupSinglePages()
                ->setupBlockTypeSets()
                ->setupBlocks();
        }


        /**
         * @return Controller
         */
        private function setupFileSets(){
            if( ! is_object(FileSet::getByName(self::FILESET_HOMEPAGE_SLIDESHOW)) ){
                FileSet::createAndGetSet(self::FILESET_HOMEPAGE_SLIDESHOW, FileSet::TYPE_PUBLIC);
            }

            if( ! is_object(FileSet::getByName(self::FILESET_HEADER_BACKGROUNDS)) ){
                FileSet::createAndGetSet(self::FILESET_HEADER_BACKGROUNDS, FileSet::TYPE_PUBLIC);
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupAttributeTypes(){
            $atPageSelector = $this->attributeType('page_selector');
            if( !($atPageSelector instanceof \Concrete\Core\Attribute\Type) ){
                \Concrete\Core\Attribute\Type::add('page_selector', t('Page Selector'), $this->packageObject());
                $this->attributeKeyCategory('file')->associateAttributeKeyType( $this->attributeType('page_selector') );
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupCollectionAttributes(){
            if( !is_object(CollectionAttributeKey::getByHandle(self::ATTR_COLLECTION_HEADER_BACKGROUND)) ){
                CollectionAttributeKey::add($this->attributeType('image_file'), array(
                    'akHandle'  => self::ATTR_COLLECTION_HEADER_BACKGROUND,
                    'akName'    => 'Header Background'
                ), $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupFileAttributes(){
            if( !(is_object(FileAttributeKey::getByHandle('link'))) ){
                FileAttributeKey::add($this->attributeType('page_selector'), array(
                    'akHandle'					=> 'link',
                    'akName'					=> t('Page Link')
                ), $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupTheme(){
            try {
                if( ! is_object(PageTheme::getByHandle('lineal')) ){
                    /** @var $themeObj \Concrete\Core\Page\Theme\Theme */
                    $themeObj = PageTheme::add('lineal', $this->packageObject());
                    $themeObj->applyToSite();
                }
            }catch(Exception $e){ /* fail gracefully */ }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupTemplates(){
            if( ! PageTemplate::getByHandle('home') ){
                PageTemplate::add('home', t('Home'), 'full.png', $this->packageObject());
            }

            if( ! PageTemplate::getByHandle('default') ){
                PageTemplate::add('default', t('Default'), 'full.png', $this->packageObject());
            }

            if( ! PageTemplate::getByHandle('two_column') ){
                PageTemplate::add('two_column', t('Two Column'), 'full.png', $this->packageObject());
            }

            if( ! PageTemplate::getByHandle('news_post') ){
                PageTemplate::add('news_post', t('News Post'), 'full.png', $this->packageObject());
            }

            if( is_object(PageTemplate::getByHandle('full')) ){
                PageTemplate::getByHandle('full')->delete();
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupPageTypes(){
            // "Page" page type
            $this->createPageType(array(
                'configs' => array(
                    'handle'            => 'page',
                    'name'              => 'Page',
                    'defaultTemplate'   => PageTemplate::getByHandle('default')
                ),
                'controls' => array(
                    'core_page_property' => array(
                        'name'           => true,
                        'publish_target' => true,
                        'page_template'  => true,
                        'description'    => false
                    )
                )
            ));

            // "News" Page Type
            $this->createPageType(array(
                'configs' => array(
                    'handle'            => 'news',
                    'name'              => t('News'),
                    'defaultTemplate'   => PageTemplate::getByHandle('news_post'),
                    'allowedTemplates'  => 'C',
                    'templates'         => array(
                        PageTemplate::getByHandle('news_post')
                    )
                ),
                'controls' => array(
                    'core_page_property' => array(
                        'name'           => true,
                        'publish_target' => true,
                        'page_template'  => true,
                        'description'    => false
                    ),
                    'block' => array('content'),
                    'collection_attribute' => array('tags')
                )
            ));

            return $this;
        }


        /**
         * @return Controller
         */
        function assignPageTypes(){
            Loader::db()->Execute('UPDATE Pages set pkgID = ? WHERE cID = 1', array(
                (int) $this->packageObject()->getPackageID()
            ));

            // Things available through the API
            $homePageCollection = \Concrete\Core\Page\Page::getByID(1)->getVersionToModify();
            $homePageCollection->update(array(
                'pTemplateID' => PageTemplate::getByHandle('home')->getPageTemplateID()
            ));
            $homePageCollection->setPageType(PageType::getByHandle('page'));

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupSinglePages(){
            $newsPage = SinglePage::add('/news', $this->packageObject());

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupBlockTypeSets(){
            if( !is_object(BlockTypeSet::getByHandle(self::PACKAGE_HANDLE)) ){
                BlockTypeSet::add(self::PACKAGE_HANDLE, self::PACKAGE_HANDLE, $this->packageObject());
            }

            return $this;
        }


        /**
         * @return Controller
         */
        private function setupBlocks(){
            if(!is_object(BlockType::getByHandle('button'))) {
                BlockType::installBlockTypeFromPackage('button', $this->packageObject());
            }

            return $this;
        }


        /**
         * Get the package object; if it hasn't been instantiated yet, load it.
         * @return Package
         */
        private function packageObject(){
            if( $this->_packageObj === null ){
                $this->_packageObj = Package::getByHandle( $this->pkgHandle );
            }
            return $this->_packageObj;
        }


        /**
         * @return mixed \Concrete\Core\Attribute\Type || null
         */
        private function attributeType( $handle ){
            if( is_null($this->{"at_{$handle}"}) ){
                $attributeType = \Concrete\Core\Attribute\Type::getByHandle($handle);
                if( is_object($attributeType) && $attributeType->getAttributeTypeID() >= 1 ){
                    $this->{"at_{$handle}"} = $attributeType;
                }
            }
            return $this->{"at_{$handle}"};
        }


        /**
         * @return mixed \Concrete\Core\Attribute\Key\Category || null
         */
        private function attributeKeyCategory( $handle ){
            if( is_null($this->{"akc_{$handle}"}) ){
                $attributeCategory = \Concrete\Core\Attribute\Key\Category::getByHandle($handle);
                if( is_object($attributeCategory) && $attributeCategory->getAttributeKeyCategoryID() >= 1 ){
                    $this->{"akc_{$handle}"} = $attributeCategory;
                }
            }
            return $this->{"akc_{$handle}"};
        }


        /**
         * Create a page type and assign defaults and shit
         */
        private function createPageType( array $settings ){
            // Cast to an object
            $settings = (object) $settings;

            // Get the page type if it exists previously
            $pageType = PageType::getByHandle($settings->handle);

            // Delete it? Only works if the $pageType isn't assigned to this package already
            if( is_object($pageType) && !((int)$pageType->getPackageID() >= 1) ){
                $pageType->delete();
            }

            if( !is_object(PageType::getByHandle($settings->handle)) ){
                /** @var $ptPage \Concrete\Core\Page\Type\Type */
                $ptPage = PageType::add(array_merge(array(
                    'ptIsFrequentlyAdded'   => 1,
                    'ptLaunchInComposer'    => 1
                ), $settings->configs), $this->packageObject());

                // Set configured publish target
                $ptPage->setConfiguredPageTypePublishTargetObject(
                    PublishTargetType::getByHandle('all')->configurePageTypePublishTarget($ptPage, array(
                        'ptID' => $ptPage->getPageTypeID()
                    ))
                );

                /** @var $layoutSet \Concrete\Core\Page\Type\Composer\FormLayoutSet */
                $layoutSet = $ptPage->addPageTypeComposerFormLayoutSet('Basics', 'Basics');

                // Are we adding composer controls?
                if( property_exists($settings, 'controls') && is_array($settings->controls) ){
                    // Core page properties
                    $corePageProperties = $settings->controls['core_page_property'];
                    if( is_array($corePageProperties) ){
                        /** @var $controlTypeObj \Concrete\Core\Page\Type\Composer\Control\Type\CorePagePropertyType */
                        $controlTypeObj = \Concrete\Core\Page\Type\Composer\Control\Type\Type::getByHandle('core_page_property');

                        if( is_object($controlTypeObj) ){
                            foreach($corePageProperties AS $controlName => $isRequired){
                                $control = $controlTypeObj->getPageTypeComposerControlByIdentifier($controlName);
                                $control->addToPageTypeComposerFormLayoutSet($layoutSet)
                                        ->updateFormLayoutSetControlRequired($isRequired);
                            }
                        }
                    }

                    // Blocks
                    $pageBlocks = $settings->controls['block'];
                    if( is_array($pageBlocks) ){
                        /** @var $controlTypeObj \Concrete\Core\Page\Type\Composer\Control\Type\CollectionAttributeType */
                        $controlTypeObj = \Concrete\Core\Page\Type\Composer\Control\Type\Type::getByHandle('block');

                        if( is_object($controlTypeObj) ){
                            foreach($pageBlocks AS $controlName){
                                $blockTypeObj = BlockType::getByHandle($controlName);
                                if( is_object($blockTypeObj) ){
                                    $control = $controlTypeObj->getPageTypeComposerControlByIdentifier($blockTypeObj->getBlockTypeID());
                                    $control->addToPageTypeComposerFormLayoutSet($layoutSet);
                                }
                            }
                        }
                    }

                    // Attributes
                    $pageAttributes = $settings->controls['collection_attribute'];
                    if( is_array($pageAttributes) ){
                        /** @var $controlTypeObj \Concrete\Core\Page\Type\Composer\Control\Type\CollectionAttributeType */
                        $controlTypeObj = \Concrete\Core\Page\Type\Composer\Control\Type\Type::getByHandle('collection_attribute');

                        if( is_object($controlTypeObj) ){
                            foreach($pageAttributes AS $controlName){
                                $collectionAttrKey = CollectionAttributeKey::getByHandle($controlName);
                                if( is_object($collectionAttrKey) ){
                                    $control = $controlTypeObj->getPageTypeComposerControlByIdentifier($collectionAttrKey->getAttributeKeyID());
                                    $control->addToPageTypeComposerFormLayoutSet($layoutSet);
                                }
                            }
                        }
                    }
                }
            }
        }

    }
}
