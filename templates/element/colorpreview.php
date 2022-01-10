<?php
echo $this->Form->control('color', [
    'label' => 'キャラクター色',
]);
echo $this->Form->button(__('色選択'), [
    'type' => 'button',
    'id' => 'show-color-modal',
]);
echo $this->Form->control('backgroundcolor', [
    'label' => 'キャラクター背景色',
]);
echo $this->Form->button(__('色選択'), [
    'type' => 'button',
    'id' => 'show-background-color-modal',
]);
?>
<?php
// プレビューのみなので間にスペース許容
echo $this->Form->control('ColorPreview', [
        'label' => '選択色プレビュー',
        'value' => __('選択した色はこのように表示されます。'),
        'disabled' => true,
    ]
);
?>
<div class="modal-template" id="id-color-modal">
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <h3>キャラクター色の選択</h3>
                    <button class="modal-close-button" type="button">×</button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($colorCodes as $value) { ?>
                        <li>
                            <label style="color: <?= $value['code'] ?>">
                                <input type="radio" name="selectColor" value="<?= $value['code'] ?>">
                                <?= $value['name'] ?>
                            </label>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-template" id="id-background-color-modal">
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <h3>背景色の選択</h3>
                    <button class="modal-close-button" type="button">×</button>
                </div>
                <div class="modal-body">
                    <ul>
                        <?php foreach ($colorCodes as $value) { ?>
                        <li>
                            <label style="color: <?= $value['code'] ?>">
                                <input type="radio" name="selectBackgroundColor" value="<?= $value['code'] ?>">
                                <?= $value['name'] ?>
                            </label>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(function(){
    // 初期色
    jQuery('#colorpreview')
        .css('color', "<?php echo h($chatCharacter->color); ?>")
        .css('background-color', "<?php echo h($chatCharacter->backgroundcolor); ?>");
    //発言色
    jQuery('input:text[name="color"]').on('change', function(){
        var color = jQuery('input:text[name="color"]').val();
        jQuery('#colorpreview').css('color', color);
    });
    jQuery('button#show-color-modal').on('click', function(){
        var color = jQuery('input:text[name="color"]').val();
        $('input:radio[name="selectColor"]').val([color]);
        jQuery("#id-color-modal").show();
    });
    jQuery('input:radio[name="selectColor"]').on('change', function(){
        var color = jQuery(this).filter(':checked').val();
        jQuery('input:text[name="color"]').val(color);
        jQuery('#colorpreview').css('color', color);
    });
    // 背景色
    jQuery('input:text[name="backgroundcolor"]').on('change', function(){
        var color = jQuery('input:text[name="backgroundcolor"]').val();
        jQuery('#colorpreview').css('background-color', color);
    });
    jQuery('button#show-background-color-modal').on('click', function(){
        var color = jQuery('input:text[name="backgroundcolor"]').val();
        $('input:radio[name="selectBackgroundColor"]').val([color]);
        jQuery("#id-background-color-modal").show();
    });
    jQuery('input:radio[name="selectBackgroundColor"]').on('change', function(){
        var color = jQuery(this).filter(':checked').val();
        jQuery('input:text[name="backgroundcolor"]').val(color);
        jQuery('#colorpreview').css('background-color', color);
    });
});
</script>
