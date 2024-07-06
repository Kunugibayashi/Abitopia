<!-- Test detecting merge conflicts in inline HTML. -->
<div class="abc">
	<p id="test-this">Testing a merge conflict.</p>
</div>

<!-- Test detecting merge conflicts in inline HTML. -->
<div class="abc">
	<p id="test-this"><?= 'Testing a merge conflict.'; ?></p>
</div>

<?= $text; ?>
