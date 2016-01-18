<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE; ?>" class="<?php echo $documentClasses; ?>" ng-app="lineal" ng-controller="CtrlDocument">
<?php $this->inc('elements/head.php'); ?>
	<body class="<?php echo $templateHandle; ?>">
		<div id="c-level-1" class="<?php echo Page::getCurrentPage()->getPageWrapperClass(); ?>">
    	<?php $this->inc('elements/header.php'); ?>
			<main>
      	<section>
					<h1 class="error"><?php echo t('Page Not Found')?></h1>
					<?php echo t('No page could be found at this address.')?>
					<?php $a = new Area('Main'); ?>
					<?php $a->display($c); ?>
					<a href="<?php echo DIR_REL?>/"><?php echo t('Back to Home')?></a>.
				</section>
			</main>
		</div>
		<?php Loader::element('footer_required'); ?>
	</body>
</html>