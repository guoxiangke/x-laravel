<?php
$dir    = __DIR__;
$files1 = scandir($dir);
print_r($files1);

print_r(getcwd());

$dir = dirname(getcwd());
$files1 = scandir($dir);
print_r($files1);

print_r($dir);

require __DIR__ . '/../public/index.php';