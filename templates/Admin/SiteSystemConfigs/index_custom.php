<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SiteSystemConfig> $siteSystemConfigs
 */
?>
<div class="column">
    <div class="siteSystemConfigs form content">
    <h3><?= __('サイト設定カスタム画面') ?></h3>
        <?= $this->Form->create() ?>
        <fieldset>
        <table>
            <?php foreach ($siteRules as $siteRule): ?>
                <tr>
                    <th><?= h($siteRule['information']) ?></th>
                    <td><?php
                        $inputName = 'actives[' .$siteRule['code']. ']';
                        echo $this->Form->control($inputName, [
                            'label' => '有効化',
                            'type' => 'checkbox',
                            'name' => $inputName,
                            'value' => '1',
                            'checked' => $siteRule['active'],
                        ]); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        </fieldset>
        <?= $this->Form->button(__('設定')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>