<?php
if ($chatRoomCss) {
    $this->Html->css($chatRoomCss .'?date=' .CSS_UPDATE_DATE, ['block' => true]);
}
?>
<div class="row">
    <aside id="id-battle-entry-form-wrap" class="column-side">
        <div class="form content" >
            <?php echo $this->element('battle_entry_form'); ?>
        </div>
    </aside>
    <div class="column-responsive main-container" >
        <div class="form content" id="id-chat-form-wrap">
            <?php echo $this->element('chat_form'); ?>
        </div>
        <div class="form content"  id="id-dice-form-wrap">
            <?php echo $this->element('chat_dice_form'); ?>
        </div>
        <?php echo $this->element('chat_entries_list'); ?>
        <?php echo $this->element('chat_log'); ?>
    </div>
</div>
<script>
jQuery(function(){
    jQuery('#id-display-change-button').on('click', function(){
        jQuery('#id-dice-form-wrap').toggle();
        jQuery('#note').parent('.input').toggle();
        jQuery('#id-character-fullname').toggle();
        jQuery('label[for="message"]').toggle();
        // 通常画面は戦闘項目も隠す
        jQuery('#id-battle-entry-form-wrap').toggle();
    });
});
</script>
