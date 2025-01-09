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
        <div id="id-random-form-wrap" class="content random-form-wrap">
                <?php if(((!is_null($chatRoom->omikuji1flg) && $chatRoom->omikuji1flg != 0) || (!is_null($chatRoom->omikuji2flg) && $chatRoom->omikuji2flg != 0))
                    && (!is_null($chatRoom->deck1flg) && $chatRoom->deck1flg != 0)
                ){ ?>
                    <div class="form dice-form-wrap dice-form-50">
                <?php } else if(((!is_null($chatRoom->omikuji1flg) && $chatRoom->omikuji1flg == 0) && (!is_null($chatRoom->omikuji2flg) && $chatRoom->omikuji2flg == 0))
                    && (!is_null($chatRoom->deck1flg) && $chatRoom->deck1flg == 0)
                ){ ?>
                    <div class="form dice-form-wrap dice-form-100">
                <?php } else { ?>
                    <div class="form dice-form-wrap dice-form-70">
                <?php } ?>
                        <?php echo $this->element('chat_dice_form'); ?>
                    </div>
                <?php if(((!is_null($chatRoom->omikuji1flg) && $chatRoom->omikuji1flg != 0) || (!is_null($chatRoom->omikuji2flg) && $chatRoom->omikuji2flg != 0))) { ?>
                    <div class="form omikuji-form-wrap omikuji-form-20">
                        <?php echo $this->element('chat_omikuji_form'); ?>
                    </div>
                <?php } ?>
                <?php if((!is_null($chatRoom->deck1flg) && $chatRoom->deck1flg != 0)){ ?>
                    <div class="form deck-form-wrap omikuji-form-20">
                        <?php echo $this->element('chat_deck_form'); ?>
                    </div>
                <?php } ?>
        </div>
        <?php echo $this->element('chat_entries_list'); ?>
        <?php echo $this->element('chat_log'); ?>
    </div>
</div>
<script>
jQuery(function(){
    jQuery('#id-display-change-button').on('click', function(){
        jQuery('#id-random-form-wrap').toggle();
        jQuery('#note').parent('.input').toggle();
        jQuery('#id-character-fullname').toggle();
        jQuery('label[for="message"]').toggle();
        jQuery('#id-allow-tag').toggle();
        // 通常画面は戦闘項目も隠す
        jQuery('#id-battle-entry-form-wrap').toggle();
    });
});
</script>
