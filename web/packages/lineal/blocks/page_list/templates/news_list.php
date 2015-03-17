<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?=t('Empty Page List Block.')?></div>
<? } else {
    $columnCount = 3;
    $chunkedList = array();
    $iterator    = 0;
    foreach($pages AS $page){
        if( ! is_array($chunkedList[$iterator]) ){
            $chunkedList[$iterator] = array();
        }
        array_push($chunkedList[$iterator], $page);
        $iterator = ($iterator < ($columnCount-1)) ? $iterator + 1 : 0;
    }
?>

<div class="row">
    <?php foreach($chunkedList AS $list): ?>
        <div class="col-sm-<?php echo floor(12 / $columnCount); ?>">
            <?php foreach($list AS $page){
                $title = $th->entities($page->getCollectionName());
                $description = $page->getCollectionDescription();
                $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
                $description = $th->entities($description);
                $date = $dh->formatDate($page->getCollectionDatePublic(), false);
                $url = $nh->getLinkToCollection($page);
            ?>
                <a class="news-post" href="<?php echo $url; ?>">
                    <h4><?php echo $title; ?></h4>
                    <span class="date"><?php echo $date; ?></span>
                    <p class="descr"><?php echo $description; ?></p>
                </a>
            <?php } ?>
        </div>
    <?php endforeach; ?>
</div>

<? if (count($pages) == 0): ?>
    <div class="ccm-block-page-list-no-pages"><?=$noResultsMessage?></div>
<? endif;?>

<?php if ($showPagination): ?>
    <?php echo $pagination;?>
<?php endif; ?>

<?php } ?>