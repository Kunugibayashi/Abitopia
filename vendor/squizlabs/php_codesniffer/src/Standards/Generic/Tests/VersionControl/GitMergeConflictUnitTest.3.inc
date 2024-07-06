<!-- Test detecting merge conflicts in inline HTML. -->
<div class="abc">
	<p id="test-this">Testing a merge conflict.</p>
</div>

<!-- Test detecting merge conflicts in inline HTML. -->
<div class="abc">
	<p id="test-this"><?php echo 'Testing a merge conflict.'; ?></p>
</div>

<?php

// Break the tokenizer.
$a = 1;

/*
 * The above tests are based on "normal" tokens.
 * The below test checks that once the tokenizer breaks down because of
 * unexpected merge conflict boundaries - i.e. after the first merge conflict
 * opener in non-comment, non-heredoc/nowdoc, non-inline HTML code -, subsequent
 * merge conflict boundaries will still be detected correctly.
 */
?>

<div class="abc">
	<p id="test-this">Testing a merge conflict.</p>
</div>
