<div class="relative h-full z-30 overflow-y-scroll" x-data="{ menuOpen: false }"
     x-init="() => $watch('menuOpen', (value) => document.body.style.overflow = value ? 'hidden' : 'auto')">

  <button
    @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectIndexOverlay.scrollTop = 0, 200); $refs.projectIndexOverlay.style.backgroundColor = '#efefef' })"
    class="all-small-caps fixed top-1 font-serif text-sm hover:underline underline-offset-2" :aria-expanded="menuOpen"
    aria-controls="navigation" aria-label="Navigation Menu">
    Index
  </button>

  <button @click="menuOpen = !menuOpen" x-show="menuOpen" x-transition:enter.delay.550ms
          class="fixed top-1 left-3 z-30 gap-5 font-serif all-small-caps text-sm hover:underline underline-offset-2"
          :aria-expanded="menuOpen"
          aria-controls="navigation" aria-label="Navigation Menu">
    close
  </button>

  <div id="index" x-show="menuOpen" x-ref="projectIndexOverlay"
       class="h-full w-full flex flex-col fixed bottom-0 left-0 backdrop-blur-md bg-white/50 overflow-y-scroll"
       x-transition:enter="transition duration-700 ease-in-out" x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in-out duration-700"
       x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">


    <article class="top px-3 font-serif pt-32 pb-20">
      <ul class="flex flex-col">
        <?php
        $projects = $site->page('projects')->children()->published();
        foreach ($projects as $project): ?>
          <li class="all-small-caps text-sm">
            <?= $project->title()->or($project->link()) ?>
          </li>
          <div class="gallery flex flex-row pb-6 w-full gap-1">
            <?php
            // cover image
            $coverImage = $project->cover()->toFile();
            if ($coverImage): ?>
              <figure class="">
                <?= $coverImage->thumb([
                  'quality' => 90,
                  'format' => 'webp',
                ])->html(); ?>
              </figure>
            <?php endif; ?>
            <?php
            // gallery images
            foreach ($project->gallery()->toFiles() as $image): ?>
              <figure class="">
                <?= $image->thumb([
                  'quality' => 90,
                  'format' => 'webp',
                ])->html(); ?>
              </figure>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>
      </ul>
    </article>
  </div>
</div>

<?php snippet('footer') ?>