<?php
if ($chatRoomCss) {
    $this->Html->css($chatRoomCss .'?date=' .CSS_UPDATE_DATE, ['block' => true]);
}
?>
<?= $this->Form->create($chatLog, ['id' => "id-battleform", 'class'=> 'row']) ?>
<aside class="column-side" id="id-battle-entry-form-wrap">
    <div class="form content" >
        <?php echo $this->element('battle_form'); ?>
    </div>
    <?php if (!$battleRules[BT_HIDE_RULE_SKILL_HINTS]['active']) { ?>
        <div class="form content" >
            <?php echo $this->element('battle_danger'); ?>
        </div>
    <?php } ?>
</aside>
<div class="column-responsive main-container" >
    <div class="form content" >
        <?php echo $this->element('battle_chat_form'); ?>
    </div>
    <div class="content" >
        <?php echo $this->element('battle_commentary'); ?>
    </div>
    <?php echo $this->element('chat_entries_list'); ?>
    <?php echo $this->element('chat_log'); ?>
</div>
<?= $this->Form->end() ?>
<script>
jQuery(function(){
    jQuery('#id-defense-set-button').on('click', function(){
        var sendData = jQuery('#id-battleform').serializeArray();
        jQuery.ajax({
            data: sendData,
            url: '<?php echo $this->Url->build([
                        'controller' => 'Battle',
                        'action' => 'defenseSet',
                        $chatRoomId,
                    ]); ?>',
            type: 'POST',
        }).done(function (data, status, jqXHR) {
            jQuery('#id-reload-log-button').trigger('click');
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
        });
    });
    jQuery('#is-attack-label').on('click', function(){
        var checkbox = jQuery('#id-is-attack');
        var button = jQuery('#id-send-battle-message-button');
        if (checkbox.prop('checked')){
            button.addClass('warning');
            button.text('攻撃実行');
        } else {
            button.removeClass('warning');
            button.removeClass('mismatch');
            button.text('送信');
        }
    });
    $("#is-attack-label, select[name=attack_skill_code], input[name=attack_skill_attribute]").on('change', function(){
        var checkbox = jQuery('#id-is-attack');
        var button = jQuery('#id-send-battle-message-button');
        // チェックが入っていない場合は色を変えない
        if (checkbox.prop('checked')){
            // スキル位置のチェック
            var attkSkillCode = $('select[name=attack_skill_code] option:selected').val(); // 攻撃スキルコード
            var attkSkillAttribute = $('input[name=attack_skill_attribute]:checked').val(); // 攻撃スキル位置
            if (attkSkillCode == '<?= BT_AT_SEI_01 ?>' && attkSkillAttribute != '<?= BT_ATTR_01 ?>') { // 精密射撃（炎）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else if (attkSkillCode == '<?= BT_AT_SEI_02 ?>' && attkSkillAttribute != '<?= BT_ATTR_02 ?>') { // 精密射撃（地）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else if (attkSkillCode == '<?= BT_AT_SEI_03 ?>' && attkSkillAttribute != '<?= BT_ATTR_03 ?>') { // 精密射撃（風）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else if (attkSkillCode == '<?= BT_AT_SEI_04 ?>' && attkSkillAttribute != '<?= BT_ATTR_04 ?>') { // 精密射撃（水）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else if (attkSkillCode == '<?= BT_AT_BUI_01 ?>' && attkSkillAttribute != '<?= BT_ATTR_01 ?>') { // 部位破壊（炎）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else if (attkSkillCode == '<?= BT_AT_BUI_02 ?>' && attkSkillAttribute != '<?= BT_ATTR_02 ?>') { // 部位破壊（地）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else if (attkSkillCode == '<?= BT_AT_BUI_03 ?>' && attkSkillAttribute != '<?= BT_ATTR_03 ?>') { // 部位破壊（風）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else if (attkSkillCode == '<?= BT_AT_BUI_04 ?>' && attkSkillAttribute != '<?= BT_ATTR_04 ?>') { // 部位破壊（水）
                button.removeClass('warning');
                button.addClass('mismatch');
            } else {
                button.removeClass('mismatch');
                button.addClass('warning');
            }
        }
        return false;
    });

    jQuery('#id-reload-log-button').on('click', function(){
        jQuery('#id-chatentrieslist-reload').trigger('click');
        jQuery('#id-chatlog-reload').trigger('click');
        jQuery('#id-battlecommentary-reload').trigger('click');
        jQuery('#id-battledanger-reload').trigger('click');
        return false;
    });
    jQuery('#id-send-battle-message-button').on('click', function(){
        var mesObj = jQuery('#message');
        var message = mesObj.val();
        message = jQuery.trim(message);
        if (!message) return;
        mesObj.val(message);

        var errObj = jQuery('#id-send-error-message');

        var sendData = jQuery('#id-battleform').serializeArray();
        jQuery.ajax({
            data: sendData,
            url: '<?php echo $this->Url->build([
                        'controller' => 'Battle',
                        'action' => 'attackSet',
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

            // チェックボックスのリセット
            var checkbox = jQuery('#id-is-attack');
            var button = jQuery('#id-send-battle-message-button');
            if (checkbox.prop('checked')) {
                checkbox.removeAttr('checked').prop('checked', false).change();
                button.removeClass('warning');
                button.removeClass('mismatch');
                button.text('送信');
            }

            mesObj.val('');
            errObj.text('');
            jQuery('#id-reload-log-button').trigger('click');
        }).fail(function (jqXHR, status, error) {
            console.log(error);
        }).always(() => {
        });
    });

    jQuery('#id-display-change-button').on('click', function(){
        jQuery('#note').parent('.input').toggle();
        jQuery('#id-character-fullname').toggle();
        jQuery('label[for="message"]').toggle();
        jQuery('#id-allow-tag').toggle();
    });
});
</script>
