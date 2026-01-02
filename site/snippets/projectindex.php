<div
  class="overflow-y-scroll relative z-30 h-full lg:z-40 dark:text-white no-scrollbar scroll-smooth"
  x-data="{ menuOpen: false }"
  x-init="() => $watch('menuOpen', (value) => document.body.style.overflow = value ? 'hidden' : 'auto')"
  @keyup.escape.window="menuOpen = false;"
>

  <button
    @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectIndexOverlay.scrollTop = 0, 200); $refs.projectIndexOverlay.style.backgroundColor = 'bg-white/50' })"
    class="fixed bottom-2.5 right-3 py-0.5 px-2 font-serif text-sm rounded-lg lg:top-2 lg:left-3 lg:right-auto lg:bottom-auto lg:p-0 lg:bg-transparent lg:rounded-none all-small-caps bg-white/65 backdrop-blur-xs cursor-crosshair lg:hover:underline lg:underline-offset-2 lg:backdrop-blur-0 dark:bg-white/25 dark:lg:bg-transparent"
    :aria-expanded="menuOpen"
    aria-controls="navigation"
    aria-label="Navigation Menu"
  >
    index
  </button>

  <button
    @click="menuOpen = !menuOpen"
    x-show="menuOpen"
    x-transition:enter.delay.800ms
    class="fixed bottom-2.5 right-3 z-50 py-0.5 px-2 font-serif text-sm rounded-lg lg:top-2 lg:left-3 lg:right-auto lg:bottom-auto lg:p-0 lg:bg-transparent lg:rounded-none all-small-caps bg-white/65 backdrop-blur-xs cursor-crosshair lg:hover:underline lg:underline-offset-2 lg:backdrop-blur-0 dark:bg-white/25 dark:lg:bg-transparent"
    :aria-expanded="menuOpen"
    aria-controls="navigation"
    aria-label="Navigation Menu"
  >
    close
  </button>

  <div
    id="index"
    x-show="menuOpen"
    x-ref="projectIndexOverlay"
    class="flex overflow-y-scroll fixed bottom-0 left-0 flex-col w-full h-full backdrop-blur-md bg-white/50 no-scrollbar dark:bg-black/50"
    x-transition:enter="transition lg:duration-1000 duration-700 ease-in-out"
    x-transition:enter-start="translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition ease-in-out lg:duration-1000 duration-700"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-full"
  >

    <article class="px-3 pt-32 pb-20 font-serif top">
      <div
        class="gallery flex flex-wrap w-full gap-x-1 lg:gap-x-5 gap-y-1 lg:gap-y-4 lg:[&:has(.group:hover)_.group>*]:opacity-20 lg:[&:has(.group:hover)_.group>*]:blur-xs">
        <?php
        $projects = $site->page('projects')->children()->published();
        foreach ($projects as $project):
            $isFirstItem = true; ?>
          <div class="flex flex-wrap gap-x-1 gap-y-1 mb-12 w-full lg:contents lg:mb-0 group">
            <?php
              // Video
              if ($project->vimeo()->isNotEmpty()): ?>
              <div
                class="relative w-fit mt-0 lg:mt-[calc(0.95rem+0.25rem)] lg:group-hover:!opacity-100 lg:group-hover:!blur-none transition-opacity duration-300">
                <h2
                  class="absolute left-0 bottom-full mb-1 text-sm whitespace-nowrap opacity-100 transition-opacity duration-700 lg:opacity-0 all-small-caps lg:group-hover:opacity-100">
                  <?= $project->title()->or($project->link()) ?>, <?= $project->year()->escape() ?>
                </h2>
                <figure class="relative h-24 lg:h-32 aspect-video">
                  <iframe
                    id="vimeo-iframe"
                    class="absolute inset-0 w-full h-full"
                    src="https://player.vimeo.com/video/<?= $project->vimeo()->escape() ?>?title=0&byline=0&portrait=0&autopause=0"
                    frameborder="0"
                    webkitallowfullscreen
                    mozallowfullscreen
                    allowfullscreen
                  ></iframe>
                </figure>
              </div>
              <?php $isFirstItem = false; endif;

            // Images
            foreach ($project->gallery()->toFiles() as $image):
                if ($isFirstItem): ?>
                <div
                  class="relative w-fit mt-0 lg:mt-[calc(0.95rem+0.25rem)] lg:group-hover:!opacity-100 lg:group-hover:!blur-none transition-opacity duration-300">
                  <h2
                    class="absolute left-0 bottom-full mb-1 text-sm whitespace-nowrap opacity-100 transition-opacity duration-700 lg:opacity-0 all-small-caps lg:group-hover:opacity-100">
                    <?= $project->title()->or($project->link()) ?>, <?= $project
                          ->year()
                          ->escape() ?>
                  </h2>
                  <figure class="h-24 lg:h-32 w-fit [&_img]:h-full [&_img]:w-auto [&_img]:object-contain">
                    <?= $image
                          ->thumb([
                            'quality' => 90,
                              'format' => 'webp',
                      ])
                          ->html() ?>
                  </figure>
                </div>
                <?php $isFirstItem = false;
                else: ?>
                <figure
                  class="h-24 lg:h-32 w-fit mt-0 lg:mt-[calc(0.95rem+0.25rem)] lg:group-hover:!opacity-100 lg:group-hover:!blur-none transition-opacity duration-300 [&_img]:h-full [&_img]:w-auto [&_img]:object-contain">
                  <?= $image
                        ->thumb([
                            'quality' => 90,
                            'format' => 'webp',
                        ])
                        ->html() ?>
                </figure>
              <?php endif;
            endforeach ?>
          </div>
        <?php endforeach ?>
      </div>
    </article>

  </div>
</div>

<?php snippet('footer'); ?>
