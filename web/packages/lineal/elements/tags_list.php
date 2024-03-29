<div class="tag-list">
    <h4>Categories</h4>
    <ul class="list-unstyled">
        <?php
        // $selectedOptObj is the current tag the page where this tag_list is embedded;
        // if $selectedOptObj is null, then nothing has been selected
        $tagsAK = CollectionAttributeKey::getByHandle('tags');
        $currentValue = null;
        if( is_object($selectedTag) ){
            $currentValue = $selectedTag->getSelectAttributeOptionID();
        }
        if( is_object($tagsAK) ){
            $controller = $tagsAK->getController();
            $options    = $controller->getOptions();
            if( !empty($options) ){ foreach($options AS $optObj): ?>
                <li class="<?php echo ($optObj->getSelectAttributeOptionID() === $currentValue) ? 'active' : ''; ?>">
                    <a href="<?php echo View::url('news', 'tag', $optObj->th->handle($optObj->value)); ?>"><?php echo $optObj; ?></a>
                </li>
            <?php endforeach; }
        }
        ?>
    </ul>
</div>
