<?php
$dir    = __DIR__;
$files1 = scandir($dir);

echo '<pre>';
print_r(getcwd());
print_r($files1);


$dir = dirname(getcwd());
$files1 = scandir($dir);
print_r($dir);
print_r($files1);



$dir    = __DIR__.'/../public/';
$files1 = scandir($dir);

print_r($files1);

return;

require __DIR__ . '/../public/index.php';