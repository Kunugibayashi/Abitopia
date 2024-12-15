<div class="content" id="id-chatlogwarehouses">
    <header class="content-header">
        <h3><?= __('ログ倉庫') ?></h3>
        <div class="content-more"><?= $this->Html->link('≫ More', [
                'controller' => 'ChatLogWarehouses',
                'action' => 'index'
            ]); ?>
        </div>
    </header>
    <div class="table-responsive" id="id-chatlogwarehouses-table">
    </div>
    <div id="id-chatlogwarehouses-reload">（自動更新）</div>
</div>
<script>
jQuery(function(){
    var getChatLogWarehouses = function() {
        var getChatLogWarehousesObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'ChatLogWarehouses', 'action' => 'topListTable',]); ?>',
            type: 'GET',
            dataType: 'html',
        }).done(function (data, status, jqXHR) {
            jQuery('#id-chatlogwarehouses-table').html(data);
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            // 自動更新を有効にする場合はコメントアウトを外してください
            // ここから
            // jQuery('#id-chatlogwarehouses-reload').show();
            // clearInterval(this.getChatLogWarehousesObj);
            // this.getChatLogWarehousesObj = setInterval(function() {
            //     getChatLogWarehouses();
            // }, 20 * 1000);
            // ここまで
        });
    }
    getChatLogWarehouses();
});
</script>
