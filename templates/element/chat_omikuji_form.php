<?= $this->Form->create($chatLog, ['id' => "id-omikuji1-form", ]) ?>
<fieldset>
    <?php
        echo $this->Form->hidden('entry_key');
        echo $this->Form->hidden('chat_room_key');
        echo $this->Form->hidden('chat_character_key');
        echo $this->Form->hidden('omikuji', array('value' => 'omikuji1'));
    ?>
</fieldset>
<div class="omikuji-container">
    <?= $this->Form->button(__('おみくじ1'), [
            'type' => 'button',
            'class' => 'omikuji-button',
            'id' => 'id-omikuji1-button',
            'value' => 'omikuji1',
        ]) ?>
</div>
<?= $this->Form->end() ?>
<?= $this->Form->create($chatLog, ['id' => "id-omikuji2-form", ]) ?>
<fieldset>
    <?php
        echo $this->Form->hidden('entry_key');
        echo $this->Form->hidden('chat_room_key');
        echo $this->Form->hidden('chat_character_key');
        echo $this->Form->hidden('omikuji', array('value' => 'omikuji2'));
    ?>
</fieldset>
<div class="omikuji-container">
    <?= $this->Form->button(__('おみくじ2'), [
            'type' => 'button',
            'class' => 'omikuji-button',
            'id' => 'id-omikuji2-button',
            'value' => 'omikuji2',
        ]) ?>
</div>
<?= $this->Form->end() ?>

<div id="id-omikuji-error-message"></div>
<script>
jQuery(function(){
    var errObj = jQuery('#id-omikuji-error-message');

    jQuery('.omikuji-button').on('click', function(){
        var formid = '#id-' + jQuery(this).val() + '-form';
        var sendData = jQuery(formid).serializeArray();
        jQuery.ajax({
            data: sendData,
            url: '<?php echo $this->Url->build(['controller' => 'Chat', 'action' => 'omikuji', $chatRoomId, ]); ?>',
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
