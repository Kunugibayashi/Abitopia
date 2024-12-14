<table>
    <tbody>
        <?php foreach ($chatCharacters as $key => $chatCharacter) { ?>
        <tr>
            <td class="table-column-date"><?= h($chatCharacter->timeModified) ?></td>
            <td class="table-column-fullname"><?php echo $this->Html->link($chatCharacter->fullname, [
                'controller' => 'ChatCharacters', 'action' => 'view', $chatCharacter->id]);
                ?>
            </td>
            <td class="table-column-detail"><?= h($chatCharacter->detailString) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
