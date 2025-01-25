<?php if(!is_null($chatRoom->omikuji1flg) && $chatRoom->omikuji1flg != 0) { ?>
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
        <?php $omikuji1Name = $chatRoom->omikuji1name; ?>
        <?= $this->Form->button(__($omikuji1Name), [
                'type' => 'button',
                'class' => 'omikuji-button',
                'id' => 'id-omikuji1-button',
                'value' => 'omikuji1',
            ]) ?>
    </div>
    <?= $this->Form->end() ?>
<?php } ?>
<?php if(!is_null($chatRoom->omikuji2flg) && $chatRoom->omikuji2flg != 0) { ?>
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
        <?php $omikuji2Name = $chatRoom->omikuji2name; ?>
        <?= $this->Form->button(__($omikuji2Name), [
                'type' => 'button',
                'class' => 'omikuji-button',
                'id' => 'id-omikuji2-button',
                'value' => 'omikuji2',
            ]) ?>
    </div>
    <?= $this->Form->end() ?>
<?php } ?>

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
