<?= $this->Form->create($chatLog, ['id' => "id-diceform", ]) ?>
<fieldset>
    <?php
        echo $this->Form->control('dice', [
            'label' => 'ダイス',
            'maxlength' => '8',
            'placeholder' => '1d100（100面サイコロ1個）, 2d6（6面サイコロ2個）など、 最大 10d100（100面サイコロ10個）',
            'id' => 'id-dice',
        ]);

        echo $this->Form->hidden('entry_key');
        echo $this->Form->hidden('chat_room_key');
        echo $this->Form->hidden('chat_character_key');
    ?>

    <div id="id-dice-error-message"></div>
</fieldset>
<div class="dice-container">
    <?= $this->Form->button(__('ダイスを振る'), [
            'type' => 'button',
            'id' => 'id-dice-button',
        ]) ?>
</div>
<?= $this->Form->end() ?>
<script>
jQuery(function(){
    jQuery('#id-dice-button').on('click', function(){
        var mesObj = jQuery('#id-dice');
        var errObj = jQuery('#id-dice-error-message');

        var message = mesObj.val();
        message = jQuery.trim(message);
        if (!message) return;

        var sendData = jQuery('#id-diceform').serializeArray();
        jQuery.ajax({
            data: sendData,
            url: '<?php echo $this->Url->build(['controller' => 'Chat', 'action' => 'dice', $chatRoomId, ]); ?>',
            type: 'post',
            dataType: 'json',
        }).done(function (data, status, jqXHR) {
            if (data['code'] != 200) {
                errMessage = "";
                if (jQuery.inArray('message', data)) errMessage = data['message'];
                errObj.text(errMessage);
                return;
            }
            errObj.text('');
            jQuery('#id-reload-log-button').trigger('click');
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
        });
    });
});
</script>
