<!DOCTYPE html>
<html lang="en">

<?php snippet('head') ?>

<body class="h-full no-scrollbar">
    <?php snippet('header') ?>

    <main class="bg-white/10 h-full overflow-scroll no-scrollbar">
        <div class="px-3 pt-1 lg:grid lg:grid-cols-6">

            <a href="<?= site()->url() ?>" class="font-sans lg:text-lg text-md fixed top-1 right-3 z-30 hover:no-underline">
                Laura Gauch
            </a>

            <div
                class="button absolute col-start-1 font-serif text-sm all-small-caps hover:underline underline-offset-2">
                <a href="<?= site()->url() ?>">Back</a>
            </div>
            <h1 class="col-start-2 col-span-4 text-center lg:text-lg text-md pt-16 lg:pt-24">
                <?= $page->title()->kt() ?>
            </h1>
            <h2 class="sr-only"> <?= $page->title()->kt() ?></h2>


            <article class="lg:row-start-2 lg:col-start-2 lg:col-end-6 font-serif pt-24 pb-16">
                <?= $site->page('datasecurity')->datasecurity()->kt() ?>
            </article>
    </main>

    <?php snippet('seo/schemas'); ?>
    <?= vite()->js('index.js') ?>
</body>

</html>