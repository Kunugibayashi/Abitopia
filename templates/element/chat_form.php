<?= $this->Form->create($chatLog, ['id' => "id-chatform", ]) ?>
<fieldset>
    <legend><?php echo h($chatCharacter->fullname); ?></legend>
    <?php
        echo $this->Form->control('message', [
            'label' => '発言',
            'maxlength' => '3000',
        ]);
        echo $this->Html->link(__('使用可能タグ一覧'), ['controller' => 'Chat', 'action' => 'htmlTagList'], ['target' => '_blank']);
        echo $this->Form->control('note', ['label' => '備考',]);

        echo $this->Form->hidden('entry_key');
        echo $this->Form->hidden('chat_room_key');
        echo $this->Form->hidden('chat_character_key');
    ?>
    <div id="id-send-error-message"></div>
</fieldset>
<div class="button-container">
    <?= $this->Form->button(__('送信'), [
            'type' => 'button',
            'id' => 'id-send-message',
        ]) ?>
    <?= $this->Form->button(__('リロード'), [
            'type' => 'button',
            'id' => 'id-reload-log-button',
        ]) ?>
    <?= $this->Form->button(__('別ウィンドウでログを表示する'), [
            'type' => 'button',
            'id' => 'id-open-log-window-button',
        ]) ?>
    <?= $this->Form->button(__('退出'), [
            'type' => 'submit',
            'class' => 'warning',
            'formaction' => $this->Url->build([
                        'controller' => 'Chat',
                        'action' => 'exit',
                        $chatRoomId,
                    ]),
        ]) ?>
</div>
<?= $this->Form->end() ?>
<script>
jQuery(function(){
    jQuery('#id-reload-log-button').on('click', function(){
        jQuery('#id-chatentrieslist-reload').trigger('click');
        jQuery('#id-chatlog-reload').trigger('click');
    });
    jQuery('#id-open-log-window-button').on('click', function(){
        jQuery('#id-open-log-window').trigger('click');
    });
    jQuery('#id-send-message').on('click', function(){
        var mesObj = jQuery('#message');
        var message = mesObj.val();
        message = jQuery.trim(message);
        if (!message) return;
        mesObj.val(message);

        var errObj = jQuery('#id-send-error-message');

        var sendData = jQuery('#id-chatform').serializeArray();
        jQuery.ajax({
            data: sendData,
            url: '<?php echo $this->Url->build([
                        'controller' => 'Chat',
                        'action' => 'say',
                        $chatRoomId,
                    ]); ?>',
            type: 'post',
            dataType: 'json',
        }).done(function (data, status, jqXHR) {
            if (data['code'] != 200) {
                errMessage = "";
                if (jQuery.inArray('message', data)) errMessage = data['message'];
                errObj.text(errMessage);
                return;
            }
            mesObj.val('');
            errObj.text('');
            jQuery('#id-reload-log-button').trigger('click');
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
        });
    });
    jQuery('textarea[name="message"]').on('keypress', function(e){
        if (e.ctrlKey && e.keyCode === 13) {
            jQuery('#id-send-message').trigger('click');
        }
    });
});
</script>
