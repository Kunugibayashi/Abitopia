<div class="content" id="id-messages">
    <header class="content-header">
        <h3><?= __('私書') ?></h3>
        <div class="content-more"><?= $this->Html->link('≫ More', [
                'controller' => 'Messages',
                'action' => 'index'
            ]); ?>
        </div>
    </header>
    <div class="table-responsive" id="id-messages-table">
    </div>
    <div id="id-messages-reload">（自動更新）</div>
</div>
<script>
jQuery(function(){
    var getMessages = function() {
        var getMessagesTimerObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'Messages', 'action' => 'topListTable',]); ?>',
            type: 'GET',
            dataType: 'html',
        }).done(function (data, status, jqXHR) {
            jQuery('#id-messages-table').html(data);
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            // 自動更新を有効にする場合はコメントアウトを外してください
            // ここから
            // jQuery('#id-messages-reload').show();
            // clearInterval(this.getMessagesTimerObj);
            // this.getMessagesTimerObj = setInterval(function() {
            //     getMessages();
            // }, 20 * 1000);
            // ここまで
        });
    }
    getMessages();
});
</script>
