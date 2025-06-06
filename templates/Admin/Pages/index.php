<div class="index content">
    <h3><?= __('サイト更新') ?></h3>
    <ul class="menu">
        <li>
            <?php echo $this->Html->link('お知らせ', '/admin/Informations'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('チャットルーム', '/admin/ChatRooms'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘ルール設定カスタム画面', '/admin/BattleRuleConfigs/indexCustom'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘補正値カスタム画面', '/admin/BattleCorrectionConfigs/indexCustom'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('DBチャットログをファイルに即時一括出力（※重くなります）', '/admin/DlAllLog/outputChatLog'); ?>
        </li>
    </ul>
</div>
<div class="index content">
    <h3><?= __('サイト内部データ') ?></h3>
    <ul class="menu">
        <li>
            <?php echo $this->Html->link('ユーザー', '/admin/Users'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('チャットキャラクター', '/admin/ChatCharacters'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('チャットログ倉庫', '/admin/ChatLogWarehouses'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('チャットログ', '/admin/ChatLogs'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('チャット参加者', '/admin/ChatEntries'); ?>
        </li>
    </ul>
</div>
<div class="index content">
    <h3><?= __('戦闘内部データ') ?></h3>
    <ul class="menu">
        <li>
            <?php echo $this->Html->link('戦闘キャラクターステータス保存', '/admin/BattleCharacterStatuses'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘キャラクター保存', '/admin/BattleCharacters');?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘ログ', '/admin/BattleLogs'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘スキル保存', '/admin/BattleSaveSkills'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘ターン保存', '/admin/BattleTurns'); ?>
        </li>
    </ul>
</div>
<div class="index content">
    <h3><?= __('サイト内システムデータ') ?></h3>
    <ul class="menu">
        <li>
            <?php echo $this->Html->link('セッション', '/admin/Sessions'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘ルール設定', '/admin/BattleRuleConfigs'); ?>
        </li>
        <li>
            <?php echo $this->Html->link('戦闘補正値設定', '/admin/BattleCorrectionConfigs'); ?>
        </li>
    </ul>
</div>
