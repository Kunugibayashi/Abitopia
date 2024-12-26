<?= $this->Form->create($chatLog, ['id' => "id-deck-flip-form", ]) ?>
<fieldset>
    <?php
        echo $this->Form->hidden('entry_key');
        echo $this->Form->hidden('chat_room_key');
        echo $this->Form->hidden('chat_character_key');
    ?>
</fieldset>
<div class="deck-container">
    <?php $deck1Name = $chatRoom->deck1name; ?>
    <?= $this->Form->button(__($deck1Name), [
            'type' => 'button',
            'id' => 'id-deck-flip-button',
        ]) ?>
</div>
<?= $this->Form->end() ?>

<?= $this->Form->create($chatLog, ['id' => "id-deck-reset-form", ]) ?>
<fieldset>
    <?php
        echo $this->Form->hidden('entry_key');
        echo $this->Form->hidden('chat_room_key');
        echo $this->Form->hidden('chat_character_key');
    ?>
</fieldset>
<div class="deck-container">
    <?php $deck1Name = $chatRoom->deck1name; ?>
    <?= $this->Form->button(__($deck1Name .'リセット'), [
            'type' => 'button',
            'id' => 'id-deck-reset-button',
        ]) ?>
</div>
<?= $this->Form->end() ?>

<div id="id-deck-error-message"></div>
<script>
jQuery(function(){
    var errObj = jQuery('#id-deck-error-message');

    jQuery('#id-deck-flip-button').on('click', function(){
        var sendData = jQuery('#id-deck-flip-form').serializeArray();
        jQuery.ajax({
            data: sendData,
            url: '<?php echo $this->Url->build(['controller' => 'Chat', 'action' => 'deckflip', $chatRoomId, ]); ?>',
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

    jQuery('#id-deck-reset-button').on('click', function(){
        var sendData = jQuery('#id-deck-reset-form').serializeArray();
        jQuery.ajax({
            data: sendData,
            url: '<?php echo $this->Url->build(['controller' => 'Chat', 'action' => 'deckreset', $chatRoomId, ]); ?>',
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
