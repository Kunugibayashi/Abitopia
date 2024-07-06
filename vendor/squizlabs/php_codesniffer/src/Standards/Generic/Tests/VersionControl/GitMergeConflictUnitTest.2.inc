<?php

/**
 * @var string $bar
 */

/*
 * Testing detecting merge conflicts using different comment styles.
 *
 * @var string $bar
 */
public function foo($bar){ }

/*
*/

// Comment
// Second comment line. NOTE: The above opener breaks the tokenizer.
// Third comment line
