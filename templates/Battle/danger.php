<?php

?>
<fieldset>
    <h4 class="battle-danger-title"><?= __('戦闘スキルヒント') ?></h4>
    <div class="battleform-fieldset-container">
        <h6 class="battle-danger-title"><?= __('一撃圏内：与ダメージ') ?></h6>
        <ul class="battleform-danger-container">
            <?php if (!$battleTurn || $battleTurn->battle_status == BT_ST_KETYAKU) { ?>
                <li>―</li>
            <?php } else if (!$attackDamages || empty($attackDamages)) { ?>
                現状なし
            <?php } else { ?>
                <?php foreach ($attackDamages as $skill => $damage) { ?>
                    <ul class="baulttleform-danger-skill-wrap">
                        <li><?php echo h($skill) ?></li>
                        <li>= <?php echo h($damage) ?></li>
                    </ul>
                <?php }?>
            <?php } ?>
        </ul>
    </div>
    <div class="battleform-fieldset-container">
        <h6 class="battle-danger-title"><?= __('一撃圏内：被ダメージ') ?></h6>
        <ul class="battleform-danger-container">
            <?php if (!$battleTurn || $battleTurn->battle_status == BT_ST_KETYAKU) { ?>
                <li>―</li>
            <?php } else if (!$incomingDamages || empty($incomingDamages)) { ?>
                現状なし
            <?php } else { ?>
                <?php foreach ($incomingDamages as $skill => $damage) { ?>
                    <ul class="baulttleform-danger-skill-wrap">
                        <li><?php echo h($skill) ?></li>
                        <li>= <?php echo h($damage) ?></li>
                    </ul>
                <?php }?>
            <?php } ?>
        </ul>
    </div>
    <div class="battleform-fieldset-container">
        <div class="battle-danger-info">
            与ダメージ：<br>攻撃時に自分が選んだ場合、相手を一撃で戦闘不能にするスキルと必殺の組み合わせ。<br>
        </div>
        <div class="battle-danger-info">
            被ダメージ：<br>防御時に相手が選んだ場合、自分が一撃で戦闘不能になるスキルと必殺の組み合わせ。<br>
        </div>
    </div>
</fieldset>

