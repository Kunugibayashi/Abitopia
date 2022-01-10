<button id="show-modal" class="top-nav-links-settings-button">
    <?php echo $this->Html->image('site-setting.png'); ?>
    <?php echo __('設定'); ?>
</button>
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
});
</script>
