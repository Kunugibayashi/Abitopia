<div class="top-nav-links">
    <div class="top-nav-links-login-username"><?php echo __('Hello, {0}.', [$loginUsername, ]); ?></div>
    <button id="show-modal" class="top-nav-links-settings-button">
        <?php echo $this->Html->image('site/gear.png', ['alt' => '設定', 'width' => '16px', 'height' => '16px', ]); ?>
        <div class="top-nav-links-settings-title"><?php echo __('設定'); ?></div>
    </button>
    <?php echo $this->Html->image('site/letter.png', [
        'alt' => '新しい私書',
        'id' => 'id-img-site-letter',
        'class' => 'top-nav-links-img-site-letter letter-animation',
        'width' => '16px',
        'height' => '16px',
        ]);
    ?>
</div>
<div class="modal-template" id="id-modal-template">
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <h3><?php echo __('設定'); ?></h3>
                    <button class="modal-close-button" type="button">×</button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li><?= $this->Html->link(__('ログアウト'), ['controller' => 'Users', 'action' => 'logout',]) ?></li>
                    </ul>
                    <ul>
                        <li><?= $this->Html->link(__('パスワード変更'), ['controller' => 'Users', 'action' => 'edit',]) ?></li>
                        <li><?= $this->Html->link(__('登録キャラクター編集'), ['controller' => 'ChatCharacters', 'action' => 'index',]) ?></li>
                        <li><?= $this->Html->link(__('発言編集'), ['controller' => 'ChatMessageEdit', 'action' => 'index',]) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(function(){
    jQuery('button#show-modal').on('click', function(){
        jQuery("#id-modal-template").show();
    });

    var getNewMessageAlert = function() {
        var getNewMessageAlertTimerObj;
        jQuery.ajax({
            url: '<?php echo $this->Url->build(['controller' => 'Messages', 'action' => 'isNewMessage',]); ?>',
            type: 'GET',
            dataType: 'json',
        }).done(function (data, status, jqXHR) {
            var dataStringify = JSON.stringify(data);
            var dataJson = JSON.parse(dataStringify);
            var isNewMessage = dataJson['isNewMessage'];
            if (isNewMessage) {
                jQuery('#id-img-site-letter').show();
            } else {
                jQuery('#id-img-site-letter').hide();
            }
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
            // 自動更新を有効にする場合はコメントアウトを外してください
            // ここから
            clearInterval(this.getNewMessageAlertTimerObj);
            this.getNewMessageAlertTimerObj = setInterval(function() {
                getNewMessageAlert();
            }, 20 * 1000);
            // ここまで
        });
    }
    getNewMessageAlert();

});
</script>
