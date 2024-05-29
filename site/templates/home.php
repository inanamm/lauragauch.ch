<!DOCTYPE html>
<html lang="en" class="h-screen dark dark:bg-black transition-colors duration-700">

<?php snippet('head') ?>

<body class="h-full grid grid-rows-12 bg:white no-scrollbar">
<header class="row-span-3">
  <nav class="flex gap-16 font-serif">
    <h2 class="ml-3"><?php snippet('projectIndex') ?></h2>
    <?php snippet('about') ?>
  </nav>
</header>

<main class="lg:row-span-6 no-scrollbar">
  <ul
    class="flex flex-col lg:flex-row lg:overflow-x-scroll gap-1 lg:gap-10 w-full items-center px-12 lg:px-0 lg:h-full no-scrollbar scroll-smooth snap-y lg:snap-x snap-mandatory pb-24 lg:pb-0">
    <?php foreach ($projects as $project): ?>
      <figure
        @mouseover="$store.activeProject.setActiveProject('<?= $project->id ?>', '<?= $project->title ?>')"
        hx-get="/htmx/<?= $project->id ?>" hx-trigger="click" hx-target="#content"
        class="h-full flex-none snap-always snap-center opacity-90 hover:opacity-100"
        data-project='<?= json_encode($project->title) ?>'
        x-data
        @click="$store.projectDrawer.toggle()"
      >
        <?= $project->image->thumb([
          'quality' => 90,
          'format' => 'webp',
        ])->html(); ?>
      </figure>
    <?php endforeach;
    ?>
  </ul>

  <button
    x-data
    @click="$store.darkMode.toggle()"
    class="fixed w-4 h-4 bottom-3 z-30 left-3 bg-neutral-900 rounded-full dark:bg-white"
  ></button>

  <div
    class="flex dark:text-white fixed flex-col items-center bottom-2.5 lg:bottom-1 inset-x-20 font-serif text-base leading-tight"
  >
    <p class="text-center hidden lg:flex"
       x-data x-text="$store.activeProject.activeProjectName"></p>
    <button
      x-data
      @click="$store.projectDrawer.toggle(); $nextTick(() => { htmx.ajax('GET', `/htmx/${$store.activeProject.activeProjectId}`, '#content'); })"
      :aria-expanded="$store.projectDrawer.open"
      aria-controls="navigation"
      class="hover:underline underline-offset-2 all-small-caps text-sm font-serif lg:hover:underline lg:underline-offset-2 rounded-lg lg:rounded-none
            bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent px-2 lg:p-0 py-0.5
            backdrop-blur-sm lg:backdrop-blur-0
            z-40 dark:text-white"
      aria-label="Navigation Menu"
    >
      More Info
    </button>
  </div>

  <?php snippet('projectDrawer') ?>

</main>
</body>
</html>