<div class="side-nav">
    <h4 class="heading"><?= $this->Html->link(__('適応ルール一覧'), [
        'controller' => 'Manual', 'action' => 'ruleSelect'], ['class' => 'side-nav-item']) ?>
    </h4>
    <ul class="manual-menu">
        <li><?= $this->Html->link(__('戦闘適応ルール'), [
            'controller' => 'Manual', 'action' => 'ruleSelect', '#' => 'batorururu'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('戦闘補正値'), [
            'controller' => 'Manual', 'action' => 'ruleSelect', '#' => 'hosei'], ['class' => 'side-nav-item']) ?>
        </li>
    </ul>

    <h4 class="heading"><?= $this->Html->link(__('設定'), [
        'controller' => 'Manual', 'action' => 'setting'], ['class' => 'side-nav-item']) ?>
    </h4>
    <ul class="manual-menu">
        <li><?= $this->Html->link(__('パスワード変更'), [
            'controller' => 'Manual', 'action' => 'setting', '#' => 'paswa'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('登録キャラクター編集'), [
            'controller' => 'Manual', 'action' => 'setting', '#' => 'touroku'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('発言編集'), [
            'controller' => 'Manual', 'action' => 'setting', '#' => 'hatsugen'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('未読私書お知らせ'), [
            'controller' => 'Manual', 'action' => 'setting', '#' => 'midoku'], ['class' => 'side-nav-item']) ?>
        </li>
    </ul>

    <h4 class="heading"><?= $this->Html->link(__('チャットシステム'), [
        'controller' => 'Manual', 'action' => 'chatSystem'], ['class' => 'side-nav-item']) ?>
    </h4>
    <ul class="manual-menu">
        <li><?= $this->Html->link(__('チャット参加'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'sanka'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('表示切替'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'hyouji'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('別ウィンドウにログを表示'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'betsu'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('ダイス'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'daisu'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('おみくじ'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'omikuji'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('手札'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'tefuda'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('自由設定ルーム変更'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'settei'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('使用可能タグ一覧'), [
            'controller' => 'Chat', 'action' => 'htmlTagList'], ['target' => '_blank', 'class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('ログ保存'), [
            'controller' => 'Manual', 'action' => 'chatSystem', '#' => 'log'], ['class' => 'side-nav-item']) ?>
        </li>
    </ul>

    <h4 class="heading"><?= $this->Html->link(__('戦闘ステータス'), [
        'controller' => 'Manual', 'action' => 'battleStatus'], ['class' => 'side-nav-item']) ?>
    </h4>
    <ul class="manual-menu">
        <li><?= $this->Html->link(__('レベル'), [
            'controller' => 'Manual', 'action' => 'battleStatus', '#' => 'level'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('ステータス'), [
            'controller' => 'Manual', 'action' => 'battleStatus', '#' => 'status'], ['class' => 'side-nav-item']) ?>
        </li>
    </ul>

    <h4 class="heading"><?= $this->Html->link(__('戦闘システム'), [
        'controller' => 'Manual', 'action' => 'battleSystem'], ['class' => 'side-nav-item']) ?>
    </h4>
    <ul class="manual-menu">
        <li><?= $this->Html->link(__('戦闘の基本'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'kihon'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('戦闘の流れ'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'nagare'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('中断再開'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'tyudan'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('属性'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'zokusei'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('コンボ'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'combo'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('スキル'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'sukiru'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('必殺技'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'hissatu'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('底力'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'soko'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('かすり傷'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'kasuri'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('判定式'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'hantei'], ['class' => 'side-nav-item']) ?>
        </li>
        <li><?= $this->Html->link(__('組み合わせ例'), [
            'controller' => 'Manual', 'action' => 'battleSystem', '#' => 'osusume'], ['class' => 'side-nav-item']) ?>
        </li>
    </ul>
</div>
