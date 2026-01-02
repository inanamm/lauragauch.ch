<div
  class="dark:text-white relative h-full z-30 lg:z-40 overflow-y-scroll no-scrollbar scroll-smooth"
  x-data="{ menuOpen: false }"
  x-init="() => $watch('menuOpen', (value) => document.body.style.overflow = value ? 'hidden' : 'auto')"
  @keyup.escape.window="menuOpen = false;"
>

  <button
    @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectIndexOverlay.scrollTop = 0, 200); $refs.projectIndexOverlay.style.backgroundColor = 'bg-white/50' })"
    class="fixed
		bottom-2.5 lg:top-2 lg:bottom-auto
		right-3 lg:left-3 lg:right-auto
		font-serif all-small-caps text-sm
		lg:hover:underline lg:underline-offset-2
		rounded-lg lg:rounded-none
		bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent
		px-2 lg:p-0
		py-0.5
		backdrop-blur-xs lg:backdrop-blur-0 cursor-crosshair" :aria-expanded="menuOpen" aria-controls="navigation"
    aria-label="Navigation Menu">
    index
  </button>

  <button @click="menuOpen = !menuOpen" x-show="menuOpen" x-transition:enter.delay.800ms class="fixed bottom-2.5 lg:top-2 lg:bottom-auto
		right-3 lg:left-3 lg:right-auto
		font-serif all-small-caps text-sm
		lg:hover:underline lg:underline-offset-2
		rounded-lg lg:rounded-none
		bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent
		px-2 lg:p-0
		py-0.5
		z-50
		backdrop-blur-xs lg:backdrop-blur-0 cursor-crosshair" :aria-expanded="menuOpen" aria-controls="navigation"
          aria-label="Navigation Menu">
    close
  </button>

  <div id="index" x-show="menuOpen" x-ref="projectIndexOverlay"
       class="h-full w-full flex flex-col fixed bottom-0 left-0 backdrop-blur-md bg-white/50 dark:bg-black/50 overflow-y-scroll no-scrollbar"
       x-transition:enter="transition lg:duration-1000 duration-700 ease-in-out"
       x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in-out lg:duration-1000 duration-700 "
       x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">


    <article class="top px-3 font-serif pt-32 pb-20">
      <div
        class="gallery flex flex-wrap w-full gap-x-3 lg:gap-x-5 gap-y-3 lg:gap-y-4 [&:has(.group:hover)_.group>*]:opacity-20 [&:has(.group:hover)_.group>*]:blur-xs">
        <?php
        $projects = $site->page('projects')->children()->published();
        foreach ($projects as $project):
          $isFirstItem = true;
          ?>
          <div class="contents group">
            <?php
            // Video
            if ($project->vimeo()->isNotEmpty()):
              ?>
              <div
                class="relative w-fit mt-[calc(0.95rem+0.25rem)] group-hover:!opacity-100 group-hover:!blur-none transition-opacity duration-300">
                <h2
                  class="absolute all-small-caps text-sm mb-1 bottom-full left-0 whitespace-nowrap opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity duration-700">
                  <?= $project->title()->or($project->link()) ?>, <?= $project->year()->escape() ?>
                </h2>
                <figure class="relative h-24 lg:h-32 aspect-video">
                  <iframe id="vimeo-iframe" class="absolute inset-0 w-full h-full"
                          src="https://player.vimeo.com/video/<?= $project->vimeo()->escape() ?>?title=0&byline=0&portrait=0&autopause=0"
                          frameborder="0"
                          webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </figure>
              </div>
              <?php
              $isFirstItem = false;
            endif;

            // Images
            foreach ($project->gallery()->toFiles() as $image):
              if ($isFirstItem):
                ?>
                <div
                  class="relative w-fit mt-[calc(0.95rem+0.25rem)] group-hover:!opacity-100 group-hover:!blur-none transition-opacity duration-300">
                  <h2
                    class="absolute all-small-caps text-sm mb-1 bottom-full left-0 whitespace-nowrap opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity duration-700">
                    <?= $project->title()->or($project->link()) ?>, <?= $project->year()->escape() ?>
                  </h2>
                  <figure class="h-24 lg:h-32 w-fit [&_img]:h-full [&_img]:w-auto [&_img]:object-contain">
                    <?= $image->thumb([
                      'quality' => 90,
                      'format' => 'webp',
                    ])->html(); ?>
                  </figure>
                </div>
                <?php
                $isFirstItem = false;
              else:
                ?>
                <figure
                  class="h-24 lg:h-32 w-fit mt-[calc(0.95rem+0.25rem)] group-hover:!opacity-100 group-hover:!blur-none transition-opacity duration-300 [&_img]:h-full [&_img]:w-auto [&_img]:object-contain">
                  <?= $image->thumb([
                    'quality' => 90,
                    'format' => 'webp',
                  ])->html(); ?>
                </figure>
              <?php
              endif;
            endforeach;
            ?>
          </div>
        <?php
        endforeach;
        ?>
      </div>
    </article>
  </div>
</div>

<?php snippet('footer') ?>