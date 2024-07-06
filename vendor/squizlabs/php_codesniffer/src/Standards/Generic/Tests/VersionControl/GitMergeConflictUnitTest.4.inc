<?php

$string =
<<<EOD
Merge conflicts in heredocs
can be problematic.
And now they are.
EOD;

// Heredoc with a merge conflict starter, the closer is outside the heredoc.
$string =
<<<EOT
Merge conflicts in heredocs
can be problematic.
EOD;
$a = 1;

// Merge conflict starter outside with a closer inside of the heredoc.
// This breaks the tokenizer.
$string =
<<<EOT
Merge conflicts in heredocs
can be problematic.
EOD;

/*
 * The above tests are based on "normal" tokens.
 * The below test checks that once the tokenizer breaks down because of
 * unexpected merge conflict boundaries - i.e. after the first merge conflict
 * opener in non-comment, non-heredoc/nowdoc, non-inline HTML code -, subsequent
 * merge conflict boundaries will still be detected correctly.
 */

$string =
<<<EOD
Merge conflicts in heredocs
can be problematic.
And now they are.
EOD;

$string =
<<<EOD
Merge conflicts in heredocs
can be problematic.
EOD;
$a = 1;
