<!DOCTYPE html>
<html lang="en" class="h-screen transition-colors duration-700 dark:bg-black no-scrollbar dark">

<?php snippet('head'); ?>

<body class="grid w-full h-full lg:overflow-x-scroll grid-rows-12 bg:white no-scrollbar">
<header class="flex row-span-3">
  <nav class="flex gap-16 font-serif">
    <h2 class="ml-3"><?php snippet('projectindex'); ?></h2>
    <?php snippet('about'); ?>
  </nav>
</header>

<main class="lg:overflow-x-scroll lg:row-span-6 scrollContainer no-scrollbar">
  <ul
    class="flex overflow-x-hidden flex-col gap-1 items-center pb-24 w-full max-w-full lg:overflow-x-scroll lg:flex-row lg:gap-10 lg:px-0 lg:pb-0 lg:h-full homeGallery no-scrollbar scroll-smooth snap-x">
    <?php foreach ($projects as $project): ?>
      <?php if ($project->type === 'image'): ?>
        <figure
          @mouseover="$store.activeProject.setActiveProject('<?= $project->id ?>', '<?= $project->title ?>')"
          hx-get="/htmx/<?= $project->id ?>"
          hx-trigger="click"
          hx-target="#content"
          class="h-full flex-none opacity-90 hover:opacity-100 cursor-crosshair px-12 lg:px-0 [&_img]:h-auto lg:[&_img]:h-full [&_img]:w-auto [&_img]:object-contain"
          data-project='<?= json_encode($project->title) ?>'
          x-data
          @click="$store.projectDrawer.openDrawer();"
        >
          <?= $project->image
              ->thumb([
                'quality' => 90,
                  'format' => 'webp',
            ])
              ->html() ?>
        </figure>
      <?php endif ?>

      <?php if ($project->type === 'video'): ?>
        <div class="flex opacity-90 hover:opacity-100 max-h-max cursor-crosshair">
          <figure
            @mouseover="$store.activeProject.setActiveProject('<?= $project->id ?>', '<?= $project->title ?>')"
            hx-get="/htmx/<?= $project->id ?>"
            hx-trigger="click"
            hx-target="#content"
            data-project='<?= json_encode($project->title) ?>'
            x-data
            @click="$store.projectDrawer.openDrawer();"
            class="video-container relative overflow-hidden w-screen h-[calc((100svw-6rem)*9/16)] px-12 lg:w-[calc(50svh*16/9)] lg:h-[50svh] lg:px-0"
          >
            <iframe
              id="vimeo-iframe"
              class="w-full h-full"
              src="https://player.vimeo.com/video/<?= $project->videoCode ?>?title=0&byline=0&portrait=0&autopause=0"
              frameborder="0"
              webkitallowfullscreen
              mozallowfullscreen
              allowfullscreen
            ></iframe>
          </figure>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  </ul>

  <button
    x-data
    @click="$store.darkMode.toggle()"
    class="hidden bottom-3 left-3 z-30 w-4 h-4 rounded-full lg:fixed dark:bg-white bg-neutral-900 cursor-crosshair"
  >
  </button>

  <div
    class="flex fixed bottom-2.5 inset-x-20 flex-col items-center font-serif text-base leading-tight lg:bottom-1 dark:text-white">
    <p
      class="hidden text-center lg:flex"
      x-data
      x-text="$store.activeProject.activeProjectName"
    ></p>
    <button
      x-data
      @click="$store.projectDrawer.openDrawer(); $nextTick(() => { htmx.ajax('GET', `/htmx/${$store.activeProject.activeProjectId}`, '#content'); })"
      :aria-expanded="$store.projectDrawer.open"
      aria-controls="navigation"
      class="z-40 py-0.5 px-2 font-serif text-sm rounded-lg lg:p-0 lg:bg-transparent lg:rounded-none dark:text-white hover:underline underline-offset-2 all-small-caps bg-white/65 backdrop-blur-xs cursor-crosshair lg:hover:underline lg:underline-offset-2 lg:backdrop-filter-none dark:bg-white/25 dark:lg:bg-transparent"
      aria-label="Navigation Menu"
    >
      More Info
    </button>
  </div>

  <?php snippet('projectDrawer'); ?>

</main>
</body>

</html>
