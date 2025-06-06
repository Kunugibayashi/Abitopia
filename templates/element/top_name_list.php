<div class="content" id="id-namelist">
    <header class="content-header">
        <h3><?= __('名簿') ?></h3>
        <div class="content-more"><?= $this->Html->link('≫ More', [
                'controller' => 'ChatCharacters',
                'action' => 'search'
            ]); ?>
        </div>
    </header>
    <div class="table-responsive" id="id-namelist-table">
    </div>
    <div id="id-namelist-reload">（自動更新）</div>
</div>
<script>
jQuery(function(){
    var getNameList = function() {
        var getNameListTimerObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'chatCharacters', 'action' => 'topListTable',]); ?>',
            type: 'GET',
            dataType: 'html',
        }).done(function (data, status, jqXHR) {
            jQuery('#id-namelist-table').html(data);
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            // 自動更新を有効にする場合はコメントアウトを外してください
            // ここから
            // jQuery('#id-namelist-reload').show();
            // clearInterval(this.getNameListTimerObj);
            // this.getNameListTimerObj = setInterval(function() {
            //     getNameList();
            // }, 20 * 1000);
            // ここまで
        });
    }
    getNameList();
});
</script>
