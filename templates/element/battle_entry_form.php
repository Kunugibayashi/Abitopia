<h4 class="heading"><?= __('戦闘') ?></h4>
<?= $this->Form->create($battleSaveSkill, [
    'id' => 'id-battle-entry-form', // vue.js の指定で使用
    'url' => ['controller' => 'Battle', 'action' => 'start', $chatRoomId, ],
]) ?>
<fieldset>
    <?php echo $this->Form->hidden('chat_character_id'); ?>
    <?php echo $this->Form->control('enemy_chat_character_key',
        ['label' => '対戦相手', 'options' => $enemies, 'empty' => '索敵してください'],
    ); ?>
    <div class="button-container">
        <?php echo $this->Form->button(__('索敵'), [
            'type' => 'submit',
            'formaction' => $this->Url->build([
                        'controller' => 'Chat',
                        'action' => 'room',
                        $chatRoomId,
                    ]),
        ]) ?>
        <?= $this->Form->button(__('戦闘再開'), [
                'type' => 'submit',
                'class' => 'warning',
                'formaction' => $this->Url->build([
                            'controller' => 'Battle',
                            'action' => 'restart',
                            $chatRoomId,
                        ]),
        ]) ?>
    </div>
    <?php echo $this->Form->control('limit_skill_code', ['label' => '覚醒スキル', 'options' => $limitSkills, ]); ?>
    <?php echo $this->Form->control('passive_skill_code', ['label' => 'パッシブスキル', 'options' => $passiveSkills, ]); ?>
    <label><?= __('戦闘スキル') ?></label>
    <?php echo $this->Form->control('battle_skill1_code', ['label' => false, 'options' => $battleSkills, ]); ?>
    <?php echo $this->Form->control('battle_skill2_code', ['label' => false, 'options' => $battleSkills, ]); ?>
    <?php echo $this->Form->control('battle_skill3_code', ['label' => false, 'options' => $battleSkills, ]); ?>
    <?php echo $this->Form->control('battle_skill4_code', ['label' => false, 'options' => $battleSkills, ]); ?>
    <?php echo $this->Form->control('battle_skill5_code', ['label' => false, 'options' => $battleSkills, ]); ?>
    <?php echo $this->Form->control('battle_skill6_code', ['label' => false, 'options' => $battleSkills, ]); ?>
    <?php echo $this->Form->control('battle_skill7_code', ['label' => false, 'options' => $battleSkills, ]); ?>

</fieldset>
<div class="button-container">
    <?= $this->Form->button(__('宣戦布告'), [
        'class' => 'warning',
    ]) ?>
</div>
<?= $this->Form->end() ?>
<script>
jQuery(function(){
    const bscode = [
        'select[name="battle_skill1_code"]',
        'select[name="battle_skill2_code"]',
        'select[name="battle_skill3_code"]',
        'select[name="battle_skill4_code"]',
        'select[name="battle_skill5_code"]',
        'select[name="battle_skill6_code"]',
        'select[name="battle_skill7_code"]',
    ];
    jQuery(bscode.join(',')).on('change', function(){
        var code = jQuery(this).val();
        if (code === '201' || code === '301') { //炎
            jQuery(this).css('color', '#dc143c');
        } else if(code === '202' || code === '302') { //地
            jQuery(this).css('color', '#8b4513');
        } else if(code === '203' || code === '303') { //風
            jQuery(this).css('color', '#808000');
        } else if(code === '204' || code === '304') { //水
            jQuery(this).css('color', '#4682b4');
        } else {
            jQuery(this).css('color', '');
        }
    }).trigger('change');
});
</script>
