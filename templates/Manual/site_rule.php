<?php
?>
<div class="row">
    <aside class="column-side">
        <?php echo $this->element('manual_side_nav_item'); ?>
    </aside>
    <div class="column-responsive main-container">
        <div class="content">
            <h3>ルール一覧</h3>
            <table class="table-rule">
                <tbody>
                    <?php foreach ($siteRules as $siteRule): ?>
                        <tr>
                            <td class="table-rule-column-head"><?= h($siteRule['information']) ?></td>
                            <td class="table-rule-column-onoff"><?php
                                if ($siteRule['active']) {
                                    echo '<div class="rule-point-on">ON</div>';
                                } else {
                                    echo '<div class="rule-point-off">OFF</div>';
                                }
                            ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
