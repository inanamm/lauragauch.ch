<div class="dark:text-white relative h-full z-30 lg:z-50 overflow-y-scroll " x-data="{ menuOpen: false }"
  x-init="() => $watch('menuOpen', (value) => document.body.style.overflow = value ? 'hidden' : 'auto')"
  @keyup.escape.window="menuOpen = false;">

  <button @click="menuOpen = !menuOpen; $nextTick(() => setTimeout(() => $refs.overlay.scrollTop = 0, 200))"
    class="fixed top-1 right-3 z-50 cursor-crosshair" :aria-expanded="menuOpen.toString()" aria-controls="about"
    aria-label="About">
    <h1 class="font-sans lg:text-lg text-md">
      Laura Gauch
    </h1>
  </button>

  <button
    @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectIndexOverlay.scrollTop = 0, 200); $refs.projectIndexOverlay.style.backgroundColor = 'bg-white/50' })"
    class="fixed
    bottom-10 lg:top-2 lg:bottom-auto
    lg:right-auto right-3 
    font-serif all-small-caps text-sm
    lg:hover:underline lg:underline-offset-2
    rounded-lg lg:rounded-none
    bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent
    px-2 lg:p-0
    py-0.5
    z-0
    backdrop-blur-sm lg:backdrop-blur-0 cursor-crosshair" :aria-expanded="menuOpen" aria-controls="navigation"
    aria-label="About">
    About
  </button>

  <button @click="menuOpen = !menuOpen" x-show="menuOpen" x-transition:enter.delay.800ms class="fixed
        bottom-2.5 lg:top-2 lg:bottom-auto
        right-3 lg:left-3 lg:right-auto
        font-serif all-small-caps text-sm 
        lg:hover:underline lg:underline-offset-2 
        rounded-lg lg:rounded-none 
        bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent
        px-2 lg:p-0
        py-0.5 
        z-50
        backdrop-blur-sm lg:backdrop-blur-0 cursor-crosshair" :aria-expanded="menuOpen.toString()"
    aria-controls="about" aria-label="About">
    close
  </button>


  <div id="about" x-show="menuOpen" x-ref="overlay"
    class="h-full w-full flex flex-col fixed bottom-0 left-0 backdrop-blur-md bg-white/50 dark:bg-black/50 overflow-y-scroll pb-6"
    x-transition:enter="transition lg:duration-1000 duration-700 ease-in-out"
    x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
    x-transition:leave="transition ease-in-out lg:duration-1000 duration-700" x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-full">


    <article class="top grid lg:grid-cols-3 grid-row px-3 font-sans text-2xl pt-32 pb-20 gap-6">
      <div class="col-span-2">
        <h3 class="font-serif text-sm all-small-caps">Biography</h3>
        <div class="lg:text-lg text-md">
          <?= $site->page('about')->biography() ?>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="lg:text-lg text-md">
          <h3 class="font-serif text-sm all-small-caps">Contact</h3>

          <?= kirbytag([
            'email' => $site->page('about')->email(),
            'text' => $site->page('about')->email(),
          ]);
          ?>
        </div>

        <div class="flex flex-col lg:text-lg text-md pt-6 lg:pt-10">
          <h3 class="font-serif text-sm all-small-caps">Social Media</h3>
          <a href="<?= $site->page('about')->instagramLink()->toUrl() ?>" <?php e($site->page('about')->target()->toBool(), 'target="_blank"') ?>>
            <?= $site->page('about')->instagramLinkText() ?> </a>
        </div>
      </div>
    </article>

    <div class="bottom grid lg:grid-cols-3 grid-row font-serif px-3 gap-6 lg:flex-row pb-3">
      <div class="flex flex-col gap-y-6 pb-6">
        <?php if ($site->page('about')->presskits()->isNotEmpty()): ?>
          <div class="presskits">
            <h3 class="all-small-caps text-sm">Presskits</h3>
            <div class="flex flex-col text-base">
              <?php
              $presskits = $site->page('about')->presskits()->toStructure();
              foreach ($presskits as $linkObject):
                ?>
                <a href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                  <?= $linkObject->title()->or($linkObject->link()) ?>
                </a>
                <?php
              endforeach;
              ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($site->page('about')->press()->isNotEmpty()): ?>
          <div class="selectedPress">
            <h3 class="all-small-caps text-sm">Selected Press</h3>
            <?php
            $presskits = $site->page('about')->press()->toStructure();
            foreach ($presskits as $linkObject):
              ?>
              <div class="flex gap-x-3 text-base">
                <div class="">
                  <?= $linkObject->date()->toDate('%G') ?>
                </div>
                <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                  <?= $linkObject->title()->or($linkObject->link()) ?>
                </a>
              </div>
              <?php
            endforeach;
            ?>
          </div>
        <?php endif; ?>

        <?php if ($site->page('about')->exhibitions()->isNotEmpty()): ?>
          <div class="exhibition">
            <h3 class="all-small-caps text-sm">Past Exhibitions + Film Festivals</h3>
            <?php
            $exhibitions = $site->page('about')->exhibitions()->toStructure();
            foreach ($exhibitions as $linkObject):
              ?>
              <div class="flex gap-x-3 text-base">
                <div class="">
                  <?= $linkObject->year()->toDate('%G') ?>
                </div>
                <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                  <?= $linkObject->title()->or($linkObject->link()) ?>
                </a>
              </div>
              <?php
            endforeach;
            ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="flex flex-col gap-y-6 pb-6">
        <?php if ($site->page('about')->upcoming()->isNotEmpty()): ?>
          <div class="flex flex-col upcoming">
            <h3 class="all-small-caps text-sm">Upcoming</h3>
            <?php
            $upcoming = $site->page('about')->upcoming()->toStructure();
            foreach ($upcoming as $linkObject):
              ?>
              <div class="flex gap-x-3 text-base">
                <div class="block">
                  <?= str_replace(' ', '&nbsp;', $linkObject->date()->toDate('%B, %d %G')) ?>
                </div>
                <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                  <?= $linkObject->title()->or($linkObject->link()) ?>
                </a>
              </div>

              <?php
            endforeach;
            ?>
          </div>
        <?php endif; ?>

        <?php if ($site->page('about')->awards()->isNotEmpty()): ?>
          <div class="grants">
            <h3 class="all-small-caps text-sm">Grants, Residencies and Awards</h3>
            <?php $items = $site->page('about')->awards()->toStructure();
            foreach ($items as $item):
              ?>
              <div class="flex gap-x-3 text-base">
                <div class="">
                  <?= $item->year()->toDate('%G') ?>
                </div>
                <div class="flex flex-wrap"><?= $item->title()->kt() ?></div>
              </div>
              <?php
            endforeach;
            ?>
          </div>
        <?php endif; ?>

        <div class="website">
          <h3 class="all-small-caps text-sm">Website</h3>
          <div class="flex flex-col text-base">
            <?php if ($p = page('datasecurity')): ?>
              <a href="<?= $p->url() ?>" target="_blank"> <?= $p->title() ?> </a>
            <?php endif ?>
            <?= $site->page('home')->imprint() ?>
          </div>
        </div>
      </div>

      <div class="flex flex-col gap-y-6 pb-6">
        <div class="flex flex-col text-base">
          <h3 class="all-small-caps text-sm">Selected Clients</h3>
          <?= $site->page('about')->clients() ?>
        </div>
        <div class="flex flex-col text-base">
          <h3 class="all-small-caps text-sm">Talented friends and collaborators</h3>
          <?= $site->page('about')->friends() ?>
        </div>

      </div>
    </div>
  </div>
</div>