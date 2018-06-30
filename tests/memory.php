<?php
require_once __DIR__."/../src/ImmAssoc.php";

print "Creating 100.000 assoc array..." . PHP_EOL;
$dummies = [];
for ($i=0; $i < 100000; $i++) {
    $dummies["key$i"] = "Some Name $i";
}
$dummies['booni'] = 'A Rabbit';

print "Measure ImmAssoc memory footprint... ";
$mem = memory_get_usage();
$imma1 = new ImmAssoc($dummies);
$memory = memory_get_usage() - $mem;
print "$memory bytes" . PHP_EOL;

print "Measure cloned ImmAssoc memory footprint... ";
$mem = memory_get_usage();
$imma2 = $imma1->set('booni', 'A Hare');
$memory = memory_get_usage() - $mem;
print "$memory bytes" . PHP_EOL;
