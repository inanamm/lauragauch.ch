<div
  class="relative z-30 h-full lg:z-50 dark:text-white"
  x-data="{ menuOpen: false }"
  x-init="() => $watch('menuOpen', (value) => document.body.style.overflow = value ? 'hidden' : 'auto')"
  @keyup.escape.window="menuOpen = false;"
>

  <button
    @click="menuOpen = !menuOpen; $nextTick(() => setTimeout(() => $refs.overlay.scrollTop = 0, 200))"
    class="fixed top-1 right-3 z-50 cursor-crosshair"
    :aria-expanded="menuOpen.toString()"
    aria-controls="about"
    aria-label="About"
  >
    <h1 class="font-sans lg:text-lg text-md">
      Laura Gauch
    </h1>
  </button>

  <button
    @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectIndexOverlay.scrollTop = 0, 200); $refs.projectIndexOverlay.style.backgroundColor = 'bg-white/50' })"
    class="fixed bottom-2.5 left-3 z-0 py-0.5 px-2 font-serif text-sm rounded-lg lg:top-2 lg:right-auto lg:bottom-auto lg:left-auto lg:p-0 lg:bg-transparent lg:rounded-none all-small-caps bg-white/65 backdrop-blur-xs cursor-crosshair lg:hover:underline lg:underline-offset-2 lg:backdrop-blur-0 dark:bg-white/25 dark:lg:bg-transparent"
    :aria-expanded="menuOpen"
    aria-controls="navigation"
    aria-label="About"
  >
    about
  </button>

  <button
    @click="menuOpen = !menuOpen"
    x-show="menuOpen"
    x-transition:enter.delay.800ms
    class="fixed bottom-2.5 right-3 z-50 py-0.5 px-2 font-serif text-sm rounded-lg lg:top-2 lg:left-3 lg:right-auto lg:bottom-auto lg:p-0 lg:bg-transparent lg:rounded-none all-small-caps bg-white/65 backdrop-blur-xs cursor-crosshair lg:hover:underline lg:underline-offset-2 lg:backdrop-blur-0 dark:bg-white/25 dark:lg:bg-transparent"
    :aria-expanded="menuOpen.toString()"
    aria-controls="about"
    aria-label="About"
  >
    close
  </button>


  <div
    id="about"
    x-show="menuOpen"
    x-ref="overlay"
    class="flex overflow-y-scroll fixed bottom-0 left-0 flex-col pb-6 w-full h-full backdrop-blur-md bg-white/50 dark:bg-black/50"
    x-transition:enter="transition lg:duration-1000 duration-700 ease-in-out"
    x-transition:enter-start="translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition ease-in-out lg:duration-1000 duration-700"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-full"
  >


    <article class="grid gap-6 px-3 pt-32 pb-20 font-sans text-2xl lg:grid-cols-3 top grid-row">
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
        ]) ?>
        </div>

        <div class="flex flex-col pt-6 lg:pt-10 lg:text-lg text-md">
          <h3 class="font-serif text-sm all-small-caps">social media</h3>
          <a
            href="<?= $site->page('about')->instagramLink()->toUrl() ?>"
            <?php e(
                $site->page('about')->target()->toBool(),
                'target="_blank"',
            ); ?>
          >
            <?= $site->page('about')->instagramLinkText() ?> </a>
        </div>
      </div>
    </article>

    <div class="grid gap-6 px-3 pb-3 font-serif lg:flex-row lg:grid-cols-3 bottom grid-row">
      <div class="flex flex-col gap-y-6 pb-6 column-1">

        <!-- UPCOMING -->
        <div class="flex flex-col gap-y-6 pb-6">
          <?php
          $upcoming = $site->page('about')->upcoming()->toStructure();
          $hasVisibleUpcoming = false;
          $visibleUpcoming = [];

          foreach ($upcoming as $linkObject):
              if ($linkObject->toggle()->toBool() === true):
                  $visibleUpcoming[] = $linkObject;
                  $hasVisibleUpcoming = true;
              endif;
          endforeach;
          ?>

          <?php if ($hasVisibleUpcoming): ?>
            <div class="flex flex-col upcoming">
              <h3 class="text-sm all-small-caps">upcoming</h3>
              <?php foreach ($visibleUpcoming as $linkObject): ?>
                <div class="flex gap-x-3 text-base">
                  <div class="block">
                    <?= str_replace(' ', '&nbsp;', $linkObject->date()->toDate('%B, %d %G')) ?>
                  </div>
                  <?php if ($linkObject->link()->toUrl()): ?>
                    <a
                      class="flex flex-wrap"
                      href="<?= $linkObject->link()->toUrl() ?>"
                      <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>
                    >
                      <?= $linkObject->title()->or($linkObject->link()) ?>
                    </a>
                  <?php else: ?>
                    <?= $linkObject->title() ?>
                  <?php endif ?>
                </div>
              <?php endforeach ?>
            </div>
          <?php endif ?>


          <!-- EXHIBITIONS -->
          <?php
          $exhibitions = $site->page('about')->exhibitions()->toStructure();
          $hasVisibleExhibitions = false;
          $visibleExhibitions = [];

          foreach ($exhibitions as $linkObject):
              if ($linkObject->toggle()->toBool() === true):
                  $visibleExhibitions[] = $linkObject;
                  $hasVisibleExhibitions = true;
              endif;
          endforeach;
          ?>

          <?php if ($hasVisibleExhibitions): ?>
            <div class="exhibition">
              <h3 class="text-sm all-small-caps">past exhibitions + film festivals</h3>
              <?php foreach ($visibleExhibitions as $linkObject): ?>
                <div class="flex gap-x-3 text-base">
                  <div class="">
                    <?= $linkObject->year()->toDate('%G') ?>
                  </div>
                  <?php if ($linkObject->link()->toUrl()): ?>
                    <a
                      class="flex flex-wrap"
                      href="<?= $linkObject->link()->toUrl() ?>"
                      <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>
                    >
                      <?= $linkObject->title()->or($linkObject->link()) ?>
                    </a>
                  <?php else: ?>
                    <?= $linkObject->title() ?>
                  <?php endif ?>
                </div>
              <?php endforeach ?>
            </div>
          <?php endif ?>

          <!-- AWARDS -->
          <?php
          $items = $site->page('about')->awards()->toStructure();
          $hasVisibleAwards = false;
          $visibleAwards = [];

          foreach ($items as $item):
              if ($item->toggle()->toBool() === true):
                  $visibleAwards[] = $item;
                  $hasVisibleAwards = true;
              endif;
          endforeach;
          ?>

          <?php if ($hasVisibleAwards): ?>
            <div class="grants">
              <h3 class="text-sm all-small-caps">grants, residencies and awards</h3>

              <?php foreach ($visibleAwards as $linkObject): ?>
                <div class="flex gap-x-3 text-base">
                  <div class="block">
                    <?= $linkObject->year()->toDate('%G') ?>
                  </div>
                  <?php if ($linkObject->link()->toUrl()): ?>
                    <a
                      class="flex flex-wrap"
                      href="<?= $linkObject->link()->toUrl() ?>"
                      <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>
                    >
                      <?= $linkObject->title()->or($linkObject->link()) ?>
                    </a>
                  <?php else: ?>
                    <?= $linkObject->title() ?>
                  <?php endif ?>

                </div>
              <?php endforeach ?>

            </div>
          <?php endif ?>
        </div>
      </div>

      <div class="flex flex-col gap-y-6 pb-6 column-2">
        <!-- PRESS -->
        <?php
        $pressItems = $site->page('about')->press()->toStructure();
          $hasVisiblePressItems = false;
          $visiblePressItems = [];

          foreach ($pressItems as $linkObject):
              if ($linkObject->toggle()->toBool() === true):
                  $visiblePressItems[] = $linkObject;
                  $hasVisiblePressItems = true;
              endif;
          endforeach;
          ?>

        <?php if ($hasVisiblePressItems): ?>
          <div class="selectedPress">
            <h3 class="text-sm all-small-caps">selected press</h3>
            <?php foreach ($visiblePressItems as $linkObject): ?>
              <div class="flex gap-x-3 text-base">
                <div class="">
                  <?= $linkObject->date()->toDate('%G') ?>
                </div>
                <?php if ($linkObject->link()->toUrl()): ?>
                  <a
                    class="flex flex-wrap"
                    href="<?= $linkObject->link()->toUrl() ?>"
                    <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>
                  >
                    <?= $linkObject->title()->or($linkObject->link()) ?>
                  </a>
                <?php else: ?>
                  <?= $linkObject->title() ?>
                <?php endif ?>
              </div>
            <?php endforeach ?>
          </div>
        <?php endif ?>

        <!-- PRESSKITS -->
        <?php
          $presskits = $site->page('about')->presskits()->toStructure();
          $hasVisiblePresskits = false;
          $visiblePresskits = [];

          foreach ($presskits as $linkObject):
              if ($linkObject->toggle()->toBool() === true):
                  $visiblePresskits[] = $linkObject;
                  $hasVisiblePresskits = true;
              endif;
          endforeach;
          ?>

        <?php if ($hasVisiblePresskits): ?>
          <div class="presskits">
            <h3 class="text-sm all-small-caps">presskits</h3>
            <div class="flex flex-col text-base">
              <?php foreach ($visiblePresskits as $linkObject): ?>
                <?php if ($linkObject->link()->toUrl()): ?>
                  <a
                    class="flex flex-wrap"
                    href="<?= $linkObject->link()->toUrl() ?>"
                    <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>
                  >
                    <?= $linkObject->title()->or($linkObject->link()) ?>
                  </a>
                <?php else: ?>
                  <?= $linkObject->title() ?>
                <?php endif ?>
              <?php endforeach ?>
            </div>
          </div>
        <?php endif ?>
      </div>

      <div class="flex flex-col gap-y-6 pb-6 column-3">
        <div class="flex flex-col text-base">
          <h3 class="text-sm all-small-caps">selected clients</h3>
          <?= $site->page('about')->clients() ?>
        </div>
        <div class="flex flex-col text-base">
          <h3 class="text-sm all-small-caps">talented friends and collaborators</h3>
          <?= $site->page('about')->friends() ?>
        </div>

        <div class="website">
          <h3 class="text-sm all-small-caps">website</h3>
          <div class="flex flex-col text-base">
            <?php if ($p = page('datasecurity')): ?>
              <a
                href="<?= $p->url() ?>"
                target="_blank"
              >
                <?= $p->title() ?>
              </a>
            <?php endif ?>
            <?= $site->page('home')->imprint() ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
