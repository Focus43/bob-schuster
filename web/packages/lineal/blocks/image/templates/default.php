<?php
    $imageHelper  = Loader::helper('image'); /** @var ImageHelper $imageHelper */
    $thumbnailObj = $imageHelper->setJpegCompression(LinealPackage::FULLSCREEN_IMG_COMPRESSION)->getThumbnail($controller->getFileObject(), LinealPackage::FULLSCREEN_IMG_WIDTH, LinealPackage::FULLSCREEN_IMG_HEIGHT);
?>

<img src="<?php echo $thumbnailObj->src ?>" alt="" />