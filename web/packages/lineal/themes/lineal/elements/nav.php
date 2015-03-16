<nav data-dock-threshold="0">
    <a class="trigger icon-bars"><span>Navigation</span></a>

    <div class="inner">
        <ul class="minority">
            <li><a href="tel:1-307-732-7800"><i class="icon-phone"></i> <span>(307) 732-7800</span></a></li>
            <li><a href="mailto:info@bobschuster.com"><i class="icon-envelope"></i> <span>info@bobschuster.com</span></a></li>
            <li><a href="/glossary"><i class="icon-document"></i> <span>Glossary</span></a></li>
        </ul>

        <?php
            $blockTypeNav                                       = BlockType::getByHandle('autonav');
            $blockTypeNav->controller->orderBy                  = 'display_asc';
            $blockTypeNav->controller->displayPages             = 'top';
            $blockTypeNav->controller->displaySubPages          = 'all';
            $blockTypeNav->controller->displaySubPageLevels     = 'custom';
            $blockTypeNav->controller->displaySubPageLevelsNum  = 1;
            $blockTypeNav->render('templates/lineal_nav');
        ?>
    </div>
</nav>