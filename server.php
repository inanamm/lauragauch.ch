<?php

// Thanks Johann Schopplich!
// https://github.com/johannschopplich/kirby-vue3-starterkit/blob/main/server.php

$root = __DIR__ . '/public_html';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// This file allows us to emulate Apache's `mod_rewrite`functionality from the 
// built-in PHP web server.
if ($uri !== '/' && file_exists($root . '/' . $uri)) {
  return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require_once $root . '/index.php';