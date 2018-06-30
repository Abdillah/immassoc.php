<?php
require_once __DIR__.'/../vendor/autoload.php';
function assert_failure($file, $line, $code, $desc = null)
{
    throw new Exception("$file:$line: ($code) $desc");
}

assert_options(ASSERT_ACTIVE,   true);
assert_options(ASSERT_BAIL,     false);
assert_options(ASSERT_WARNING,  false);
assert_options(ASSERT_CALLBACK, 'assert_failure');
