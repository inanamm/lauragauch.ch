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

  <?php snippet('projectDrawer') ?>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      let darkMode = localStorage.getItem('darkMode') === 'true';

      const updateDarkMode = () => {
        document.documentElement.classList.toggle('dark', darkMode);
        button.classList.toggle('bg-white', darkMode);
        button.classList.toggle('bg-neutral-900', !darkMode);
        button.classList.toggle('text-black', darkMode);
        button.classList.toggle('text-white', !darkMode);
      };

      const toggleDarkMode = () => {
        darkMode = !darkMode;
        localStorage.setItem('darkMode', darkMode);
        updateDarkMode();
      };

      const button = document.createElement('button');
      button.className = 'fixed w-4 h-4 bottom-3 z-20 left-3 bg-neutral-900 rounded-full';
      button.addEventListener('click', toggleDarkMode);

      updateDarkMode();

      document.body.appendChild(button);
    });
  </script>

</main>

<?= vite()->js('home.js') ?>
</body>

</html>