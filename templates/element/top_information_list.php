<div class="content" id="id-information">
    <header class="content-header">
        <h3><?= __('お知らせ') ?></h3>
        <div class="content-more"><?= $this->Html->link('≫ More', [
                'controller' => 'Informations',
                'action' => 'index'
            ]); ?>
        </div>
    </header>
    <div class="table-responsive" id="id-information-table">
    </div>
    <div id="id-information-reload">（自動更新）</div>
</div>
<script>
jQuery(function(){
    var getInformation = function() {
        var getInformationTimerObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'Informations', 'action' => 'topListTable',]); ?>',
            type: 'GET',
            dataType: 'html',
        }).done(function (data, status, jqXHR) {
            jQuery('#id-information-table').html(data);
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            // 自動更新を有効にする場合はコメントアウトを外してください
            // ここから
            // jQuery('#id-information-reload').show();
            // clearInterval(this.getInformationTimerObj);
            // this.getInformationTimerObj = setInterval(function() {
            //     getInformation();
            // }, 20 * 1000);
            // ここまで
        });
    }
    getInformation();
});
</script>
