<table>
    <tbody>
        <?php foreach ($informations as $key => $information) { ?>
        <tr>
            <td class="table-column-date"><?= $information->created ?></td>
            <td class="table-column-information-title"><?php echo $this->Html->link($information->title, [
                'controller' => 'Informations', 'action' => 'view', $information->id]);
                ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
