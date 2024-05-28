<?php
// 获取完整的请求 URI
$requestUri = $_SERVER['REQUEST_URI'];
// 从请求 URI 中解析出路径部分
$path = parse_url($requestUri, PHP_URL_PATH);

echo '<pre>';
echo $path;


$dir    = __DIR__.'/../public/build/assets/';
$files1 = scandir($dir);
print_r($files1);

return;

require __DIR__ . '/../public/index.php';