<div multifile-selector>
    <ul selected-files>
        <?php if( !empty($selectedFileIdsList) ): foreach($selectedFileIdsList AS $fileID): ?>
            <li data-fid="<?php echo $fileID; ?>">
                <div class="ccm-file-selector"></div>
                <span ordering><i class="fa fa-arrows-v"></i></span>
                <span remove><i class="fa fa-minus-circle"></i></span>
            </li>
        <?php endforeach; endif; ?>
    </ul>

    <a add class="btn btn-default btn-block">Add</a>
</div>

<script type="text/javascript">
    $(function(){
        var $wrapper        = $('[multifile-selector]'),
            $selectedList   = $('[selected-files]', $wrapper),
            $addBtn         = $('[add]', $wrapper),
            _inputName      = '_atMultifiles[]';

        // Init sorting on list
        $selectedList.sortable({
            items: 'li',
            cursor: 'move',
            containment: 'parent',
            tolerance: 'pointer',
            handle: '[ordering]'
        });

        // Initialize existing (already chosen) files
        $('[data-fid]', $selectedList).each(function( index, liNode ){
            var $li = $(liNode);
            $('.ccm-file-selector', $li).concreteFileSelector({
                fID: +($li.attr('data-fid')),
                inputName: _inputName
            });
        });

        // Add one
        $addBtn.on('click', function(){
            var $li = $('<li><div class="ccm-file-selector"></div><span ordering><i class="fa fa-arrows-v"></i></span><span remove><i class="fa fa-minus-circle"></i></span></li>').appendTo($selectedList);
            $('.ccm-file-selector', $li).concreteFileSelector({
                inputName: _inputName
            });
            $selectedList.sortable('refresh');
        });

        // Whenever a remove is clicked
        $selectedList.on('click', '[remove]', function(){
            $(this).parent('li').remove();
        });
    });
</script>