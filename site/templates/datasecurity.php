<!DOCTYPE html>
<html lang="en" class="h-screen bg-black">

<?php snippet('head'); ?>

<body class="h-full text-white no-scrollbar">
    <?php snippet('header'); ?>

    <main class="overflow-scroll h-full bg-black no-scrollbar">
        <div class="px-3 pt-1 lg:grid lg:grid-cols-6">

            <a href="<?= site()->url() ?>"
                class="fixed top-1 right-3 z-30 font-sans lg:text-lg hover:no-underline text-md">
                Laura Gauch
            </a>

            <div class="fixed bottom-2.5 right-3 z-30 py-0.5 px-2 font-serif text-sm rounded-lg lg:top-2 lg:left-3 lg:right-auto lg:bottom-auto lg:p-0 lg:bg-transparent lg:rounded-none all-small-caps bg-white/25 backdrop-blur-xs lg:hover:underline lg:underline-offset-2 lg:backdrop-blur-0">
             <a href="<?= site()->url() ?>">Back</a>
        </div>
        <h1 class="col-span-4 col-start-2 pt-16 text-center lg:pt-24 lg:text-lg text-md">
            <?= $page->title()->kt() ?>
        </h1>
        <h2 class="sr-only"> <?= $page->title()->kt() ?></h2>


        <article class="pt-24 pb-16 font-serif lg:col-start-2 lg:col-end-6 lg:row-start-2">
            <?= $site->page('datasecurity')->datasecurity()->kt() ?>
        </article>
    </main>

    <?php snippet('seo/schemas'); ?>
    <?= vite()->js('index.js') ?>
</body>

</html>