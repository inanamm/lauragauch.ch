<!DOCTYPE html>
<html lang="en" class="h-screen dark dark:bg-black transition-colors duration-700">

<?php snippet('head') ?>

<body class="h-full w-full grid grid-rows-12 bg:white no-scrollbar">
<header class="flex row-span-3">
  <nav class="flex gap-16 font-serif">
    <h2 class="ml-3"><?php snippet('projectindex') ?></h2>
    <?php snippet('about') ?>
  </nav>
</header>

<main class="lg:row-span-6 no-scrollbar">
  <ul
    class="homeGallery flex flex-col lg:flex-row lg:overflow-x-scroll overflow-x-hidden gap-1 lg:gap-10 w-full max-w-full items-center lg:px-0 lg:h-full no-scrollbar scroll-smooth lg:snap-x snap-mandatory pb-24 lg:pb-0">
    <?php foreach ($projects as $project): ?>
      <?php if ($project->type === "image"): ?>
        <figure
          @mouseover="$store.activeProject.setActiveProject('<?= $project->id ?>', '<?= $project->title ?>')"
          hx-get="/htmx/<?= $project->id ?>" hx-trigger="click" hx-target="#content"
          class="h-full flex-none snap-always snap-center opacity-90 hover:opacity-100 cursor-crosshair"
          data-project='<?= json_encode($project->title) ?>'
          x-data
          @click="$store.projectDrawer.openDrawer();"
        >
          <?= $project->image->thumb([
            'quality' => 90,
            'format' => 'webp',
          ])->html(); ?>
        </figure>
      <?php endif; ?>

      <?php if ($project->type === "video"): ?>
        <div class="flex snap-center snap-always max-h-max opacity-90 hover:opacity-100 cursor-crosshair bg-red-200">
          <figure class="videohome relative w-full h- overflow-hidden ">
            <iframe id="vimeo-iframe" class="w-full h-full"
                    src="https://player.vimeo.com/video/<?= $project->videoCode ?>?title=0&byline=0&portrait=0&autopause=0"
                    frameborder="0"
                    webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </figure>
        </div>
      <?php endif; ?>
    <?php endforeach;
    ?>
  </ul>

  <button
    x-data
    @click="$store.darkMode.toggle()"
    class="fixed w-4 h-4 bottom-3 z-30 left-3 bg-neutral-900 rounded-full dark:bg-white cursor-crosshair"
  >
  </button>

  <div
    class="flex dark:text-white fixed flex-col items-center bottom-2.5 lg:bottom-1 inset-x-20 font-serif text-base leading-tight"
  >
    <p class="text-center hidden lg:flex"
       x-data x-text="$store.activeProject.activeProjectName"></p>
    <button
      x-data
      @click="$store.projectDrawer.openDrawer(); $nextTick(() => { htmx.ajax('GET', `/htmx/${$store.activeProject.activeProjectId}`, '#content'); })"
      :aria-expanded="$store.projectDrawer.open"
      aria-controls="navigation"
      class="hover:underline underline-offset-2 all-small-caps text-sm font-serif lg:hover:underline lg:underline-offset-2 rounded-lg lg:rounded-none
            bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent px-2 lg:p-0 py-0.5
            backdrop-blur-sm lg:backdrop-filter-none
            z-40 dark:text-white cursor-crosshair"
      aria-label="Navigation Menu"
    >
      More Info
    </button>
  </div>

  <?php snippet('projectDrawer') ?>

</main>
</body>
</html>
