<!DOCTYPE html>
<html lang="en">

<?php snippet('head') ?>

<body>
    <?php snippet('header') ?>
    <main>
        <h1><?= $page->title() ?></h1>
    </main>
    <?php snippet('footer') ?>

    <?= vite()->js('index.js') ?>
</body>

</html>