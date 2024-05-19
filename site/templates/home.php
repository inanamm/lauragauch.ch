<!DOCTYPE html>
<html lang="en" class="h-screen">

<?php snippet('head') ?>

<body class=" h-full grid grid-rows-12 bg:white dark:bg-black">
<header class="row-span-3">
  <nav class="flex gap-16 font-serif ">
    <h2 class="ml-3"><?php snippet('projectIndex') ?></h2>
    <?php snippet('about') ?>
  </nav>
</header>

<main class="lg:row-span-6">
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

  <?php snippet('projectDrawer') ?>

</main>

<?= vite()->js('index.js') ?>
<?= vite()->js('home.js') ?>
</body>

</html>