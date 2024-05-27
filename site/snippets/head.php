<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, shrink-to-fit=no"/>

  <?php snippet('seo/head'); ?>
  <?php header("Cache-Control: max-age=3600"); ?>

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="language" content="English">

  <?= vite()->js('index.js', ['defer' => true]) ?>
  <?= vite()->css('index.css') ?>

  <?= vite()->js("templates/{{ page.template }}.js", ['defer' => true], try: true) ?>
  <?= vite()->css("templates/{{ page.template }}.css", try: true) ?>
</head>