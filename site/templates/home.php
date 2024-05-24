<!DOCTYPE html>
<html lang="en" class="h-screen dark dark:bg-black">

<?php snippet('head') ?>

<body class="h-full grid grid-rows-12 bg:white dark:bg-black no-scrollbar">
<header class="row-span-3">
  <nav class="flex gap-16 font-serif ">
    <h2 class="ml-3"><?php snippet('projectIndex') ?></h2>
    <?php snippet('about') ?>
  </nav>
</header>

<main class="lg:row-span-6 no-scrollbar">
  <ul
    class="flex flex-col lg:flex-row lg:overflow-x-scroll gap-1 lg:gap-10 w-full items-center px-12 lg:px-0 lg:h-full no-scrollbar scroll-smooth snap-y lg:snap-x snap-mandatory pb-24 lg:pb-0">
    <?php foreach ($projects as $project): ?>
      <figure class="h-full flex-none snap-always snap-center" data-project='<?= json_encode($project) ?>'>
        <?= $project->image->thumb([
          'quality' => 90,
          'format' => 'webp',
        ])->html(); ?>
      </figure>
    <?php endforeach;
    ?>
  </ul>

  <button x-data
          @click="$store.darkMode.toggle()"
          class="fixed w-4 h-4 bottom-3 z-30 left-3 bg-neutral-900 rounded-full dark:bg-white"
  ></button>

  <?php snippet('projectDrawer') ?>

</main>

<?= vite()->js('home.js') ?>
</body>

</html>