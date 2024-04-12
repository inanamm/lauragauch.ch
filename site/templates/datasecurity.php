<!DOCTYPE html>
<html lang="en">

<?php snippet('head') ?>

<body class="grid pt-1 font-sans px-3">
    <main>
        <h1>
        <?= $site->page('about')->datasecurity() ?>
            </h1>
        <div class="sr-only">
            <h2></h2>
        </div>
        <?= $page->privacyPolicy()->kirbytextinline() ?>
    </main>

    <?php snippet('seo/schemas'); ?>
    <?= vite()->js('index.js') ?>
</body>

</html>