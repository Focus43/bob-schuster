<?php  defined('C5_EXECUTE') or die("Access Denied.");
	$f = $controller->getFileObject(); /** @var FileVersion $f */
	$fp = new Permissions($f);
	if ($fp->canViewFile()):
		$c = Page::getCurrentPage();
		if($c instanceof Page) {
			$cID = $c->getCollectionID();
		}
?>
<a class="file-icon-link" href="<?php echo View::url('/download_file', $controller->getFileID(),$cID); ?>">
    <?php echo $f->getThumbnail(1); ?>
    <span><?php echo stripslashes($controller->getLinkText()); ?></span>
</a>
<? endif;
