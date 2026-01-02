<div class="dark:text-white relative h-full z-30 lg:z-50" x-data="{ menuOpen: false }"
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
    backdrop-blur-xs lg:backdrop-blur-0 cursor-crosshair" :aria-expanded="menuOpen" aria-controls="navigation"
    aria-label="About">
    about
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
        backdrop-blur-xs lg:backdrop-blur-0 cursor-crosshair" :aria-expanded="menuOpen.toString()"
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
        <h3 class="font-serif text-sm all-small-caps">biography</h3>
        <div class="lg:text-lg text-md">
          <?= $site->page('about')->biography() ?>
        </div>
      </div>
      <div class="flex flex-col">
        <div class="lg:text-lg text-md">
          <h3 class="font-serif text-sm all-small-caps">contact</h3>

          <?= kirbytag([
            'email' => $site->page('about')->email(),
            'text' => $site->page('about')->email(),
          ]);
          ?>
        </div>

        <div class="flex flex-col lg:text-lg text-md pt-6 lg:pt-10">
          <h3 class="font-serif text-sm all-small-caps">social media</h3>
          <a href="<?= $site->page('about')->instagramLink()->toUrl() ?>" <?php e($site->page('about')->target()->toBool(), 'target="_blank"') ?>>
            <?= $site->page('about')->instagramLinkText() ?> </a>
        </div>
      </div>
    </article>

    <div class="bottom grid lg:grid-cols-3 grid-row font-serif px-3 gap-6 lg:flex-row pb-3">
      <div class="flex flex-col gap-y-6 pb-6">

        <!-- PRESSKITS -->
        <?php
        $presskits = $site->page('about')->presskits()->toStructure();
        $hasVisiblePresskits = false;
        $visiblePresskits = [];

        foreach ($presskits as $linkObject) {
          if ($linkObject->toggle()->toBool() === true) {
            $visiblePresskits[] = $linkObject;
            $hasVisiblePresskits = true;
          }
        }
        ?>

        <?php if ($hasVisiblePresskits): ?>
          <div class="presskits">
            <h3 class="all-small-caps text-sm">presskits</h3>
            <div class="flex flex-col text-base">
              <?php foreach ($visiblePresskits as $linkObject): ?>
                <?php if ($linkObject->link()->toUrl()): ?>
                  <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                    <?= $linkObject->title()->or($linkObject->link()) ?>
                  </a>
                <?php else: ?>
                  <?= $linkObject->title() ?>
                <?php endif ?>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>


        <!-- PRESS -->
        <?php
        $pressItems = $site->page('about')->press()->toStructure();
        $hasVisiblePressItems = false;
        $visiblePressItems = [];

        foreach ($pressItems as $linkObject) {
          if ($linkObject->toggle()->toBool() === true) {
            $visiblePressItems[] = $linkObject;
            $hasVisiblePressItems = true;
          }
        }
        ?>

        <?php if ($hasVisiblePressItems): ?>
          <div class="selectedPress">
            <h3 class="all-small-caps text-sm">selected press</h3>
            <?php foreach ($visiblePressItems as $linkObject): ?>
              <div class="flex gap-x-3 text-base">
                <div class="">
                  <?= $linkObject->date()->toDate('%G') ?>
                </div>
                <?php if ($linkObject->link()->toUrl()): ?>
                  <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                    <?= $linkObject->title()->or($linkObject->link()) ?>
                  </a>
                <?php else: ?>
                  <?= $linkObject->title() ?>
                <?php endif ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>


        <!-- EXHIBITIONS -->
        <?php
        $exhibitions = $site->page('about')->exhibitions()->toStructure();
        $hasVisibleExhibitions = false;
        $visibleExhibitions = [];

        foreach ($exhibitions as $linkObject) {
          if ($linkObject->toggle()->toBool() === true) {
            $visibleExhibitions[] = $linkObject;
            $hasVisibleExhibitions = true;
          }
        }
        ?>

        <?php if ($hasVisibleExhibitions): ?>
          <div class="exhibition">
            <h3 class="all-small-caps text-sm">past exhibitions + film festivals</h3>
            <?php foreach ($visibleExhibitions as $linkObject): ?>
              <div class="flex gap-x-3 text-base">
                <div class="">
                  <?= $linkObject->year()->toDate('%G') ?>
                </div>
                <?php if ($linkObject->link()->toUrl()): ?>
                  <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                    <?= $linkObject->title()->or($linkObject->link()) ?>
                  </a>
                <?php else: ?>
                  <?= $linkObject->title() ?>
                <?php endif ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- UPCOMING -->
      <div class="flex flex-col gap-y-6 pb-6">
        <?php
        $upcoming = $site->page('about')->upcoming()->toStructure();
        $hasVisibleUpcoming = false;
        $visibleUpcoming = [];

        foreach ($upcoming as $linkObject) {
          if ($linkObject->toggle()->toBool() === true) {
            $visibleUpcoming[] = $linkObject;
            $hasVisibleUpcoming = true;
          }
        }
        ?>

        <?php if ($hasVisibleUpcoming): ?>
          <div class="flex flex-col upcoming">
            <h3 class="all-small-caps text-sm">upcoming</h3>
            <?php foreach ($visibleUpcoming as $linkObject): ?>
              <div class="flex gap-x-3 text-base">
                <div class="block">
                  <?= str_replace(' ', '&nbsp;', $linkObject->date()->toDate('%B, %d %G')) ?>
                </div>
                <?php if ($linkObject->link()->toUrl()): ?>
                  <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                    <?= $linkObject->title()->or($linkObject->link()) ?>
                  </a>
                <?php else: ?>
                  <?= $linkObject->title() ?>
                <?php endif ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <!-- AWARDS -->
        <?php
        $items = $site->page('about')->awards()->toStructure();
        $hasVisibleAwards = false;
        $visibleAwards = [];

        foreach ($items as $item) {
          if ($item->toggle()->toBool() === true) {
            $visibleAwards[] = $item;
            $hasVisibleAwards = true;
          }
        }
        ?>

        <?php if ($hasVisibleAwards): ?>
          <div class="grants">
            <h3 class="all-small-caps text-sm">grants, residencies and awards</h3>

            <?php foreach ($visibleAwards as $linkObject): ?>
              <div class="flex gap-x-3 text-base">
                <div class="block">
                  <?= $linkObject->year()->toDate('%G') ?>
                </div>
                <?php if ($linkObject->link()->toUrl()): ?>
                  <a class="flex flex-wrap" href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                    <?= $linkObject->title()->or($linkObject->link()) ?>
                  </a>
                <?php else: ?>
                  <?= $linkObject->title() ?>
                <?php endif ?>

              </div>
            <?php endforeach; ?>

          </div>
        <?php endif; ?>

        <div class="website">
          <h3 class="all-small-caps text-sm">website</h3>
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
          <h3 class="all-small-caps text-sm">selected clients</h3>
          <?= $site->page('about')->clients() ?>
        </div>
        <div class="flex flex-col text-base">
          <h3 class="all-small-caps text-sm">talented friends and collaborators</h3>
          <?= $site->page('about')->friends() ?>
        </div>

      </div>
    </div>
  </div>
</div>