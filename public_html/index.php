<?php

(function /* staticache */ () {
  $root = __DIR__ . '/../storage/cache';

  // only execute Staticache for web requests
  if (php_sapi_name() === 'cli') {
    return;
  }

  // only use cached files for static responses, pass dynamic requests through
  if (in_array($_SERVER['REQUEST_METHOD'], ['GET', 'HEAD']) === false) {
    return;
  }

  // check if a cache for this domain exists
  $root .= '/' . $_SERVER['SERVER_NAME'] . '/pages';
  if (is_dir($root) !== true) {
    return;
  }

  // determine the exact file to use
  $path = $root . '/' . ltrim($_SERVER['REQUEST_URI'] ?? '', '/');
  if (is_file($path . '/index.html') === true) {
    // a HTML representation exists in the cache
    $path = $path . '/index.html';
  } elseif (is_file($path) !== true) {
    // neither a HTML representation nor a custom
    // representation exists in the cache
    return;
  }

  // try to determine the content type from the static file
  if ($mime = @mime_content_type($path)) {
    header("Content-Type: $mime");
  }

  die(file_get_contents($path));
})();


include __DIR__ . "/../vendor/autoload.php";

$kirby = new Kirby\Cms\App([
  "roots" => [
    "index" => __DIR__,
    "base" => ($base = dirname(__DIR__)),
    "content" => $base . "/content",
    "site" => $base . "/site",
    "storage" => ($storage = $base . "/storage"),
    "accounts" => $storage . "/accounts",
    "cache" => $storage . "/cache",
    "sessions" => $storage . "/sessions",
  ],
]);

echo $kirby->render();
