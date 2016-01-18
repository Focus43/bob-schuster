<?php
	namespace Application\Controller\SinglePage;
	use \Concrete\Package\Lineal\Controller AS PackageController;
	class PageNotFound extends PageController {
		public function view() {
       //$this->set('pkgConfig', PackageController::getPackageConfigObj());
			exit;
    	}
	}
