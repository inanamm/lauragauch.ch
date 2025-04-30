<!DOCTYPE html>
<html lang="en" class="h-screen bg-black">

<?php snippet('head') ?>

<body class="h-full no-scrollbar text-white">
    <?php snippet('header') ?>

    <main class="bg-black h-full overflow-scroll no-scrollbar">
        <div class="px-3 pt-1 lg:grid lg:grid-cols-6">

            <a href="<?= site()->url() ?>"
                class="font-sans lg:text-lg text-md fixed top-1 right-3 z-30 hover:no-underline">
                Laura Gauch
            </a>

            <div class="
                fixed
                bottom-2.5 lg:top-2 lg:bottom-auto
                right-3 lg:left-3 lg:right-auto
                font-serif all-small-caps text-sm
                lg:hover:underline lg:underline-offset-2
                rounded-lg lg:rounded-none
                bg-white/25 lg:bg-transparent
                px-2 lg:p-0
                py-0.5
                backdrop-blur-xs lg:backdrop-blur-0
                z-30">
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