<article style="background-color: <?= $backgroundColor ?>"
  class="lg:grid w-full h-full lg:grid-cols-6 grid-row px-3 font-sans lg:text-lg text-md pb-20 overflow-scroll no-scrollbar scroll-smooth rounded-t-2xl auto-rows-min">


  <div class="flex flex-col items-center col-start-2 col-span-4 text-center lg:text-lg text-md pt-3 pb-4 lg:pt-18">
    <?= $page->title()->kt() ?>

    <?php snippet('dropdown', slots: true) ?>
    <?php snippet(
      'copyToClipboard',
      ["copyText" => $page->url(), "buttonText" => "Copy link"]
    ) ?>
    <a href="https://www.instagram.com/" target="_blank"
      class="font-serif text-sm all-small-caps lg:hover:underline lg:underline-offset-2 ">
      <?php snippet(
        'copyToClipboard',
        ["copyText" => $page->url(), "buttonText" => "Share on Instagram"]
      ) ?>
    </a>
    <a href="mailto:?subject=Check out this project by Laura Gauch&body=Here is the link to Laura Gauch's website: <?= $page->url() ?>"
      class="all-small-caps text-sm font-serif flex flex-col text-left lg:text-center  lg:underline-offset-2 lg:hover:underline lg:rounded-none rounded-lg
">
      Share via Email
    </a>
    <a href="<?= $page->url() ?>"
      class="all-small-caps text-sm font-serif flex flex-col lg:text-center text-left lg:underline-offset-2 lg:hover:underline lg:rounded-none rounded-lg">
      See full project
    </a>
    <?php endsnippet() ?>
  </div>

  <?php if ($page->description()->isNotEmpty()): ?>
    <article class="lg:row-start-2 lg:col-start-2 lg:col-end-6 lg:text-lg text-md pt-12 pb-16 flex flex-col gap-3">
      <?= $page->description()->kt() ?>
    </article>
  <?php endif; ?>


  <!-- ADDITIONAL INFO -->
  <div class="lg:col-start-2 lg:col-span-4 font-serif">

    <!-- REQUEST FULL MOVIE -->
    <?php if ($page->requestToggle()->toBool() === true): ?>
      <a href="mailto:?subject=Request access to full film by Laura Gauch&body=Hi! I saw the trailer to <?= $page->title() ?> on your website. Is it possible to get access to the full film? Thank you!"
        class="all-small-caps pt-6 text-sm">Full Film on Request</a>
    <?php endif; ?>

    <!-- YEAR LOCATION -->
    <?php if ($page->year()->isNotEmpty()): ?>
      <h3 class="all-small-caps pt-6 text-sm">Year</h3>
      <div class="flex flex-row gap-3 text-base">
        <?= $page->year()->escape() ?>
      </div>
    <?php endif; ?>

    <!-- PRESSKITS -->
    <?php if ($page->presskits()->kt()->isNotEmpty()): ?>
      <h3 class="all-small-caps pt-6 text-sm">presskits</h3>
      <?php
      foreach ($page->presskits()->toStructure() as $presskit):
        ?>
        <div class="flex flex-row gap-3 text-base">
          <?= $presskit->title() ?>
        </div>
        <?php
      endforeach;
      ?>
    <?php endif; ?>

    <!-- COLLABORATION -->
    <?php if ($page->collaboration()->kt()->isNotEmpty()): ?>
      <h3 class="all-small-caps pt-6 text-sm">in collaboration with</h3>
      <?php
      foreach ($page->collaboration()->toStructure() as $collab):
        ?>
        <div class="flex flex-row gap-3 text-base">
          <?= $collab->name() ?>
        </div>
        <?php
      endforeach;
      ?>
    <?php endif; ?>

    <!-- SUPPORT OF -->
    <?php if ($page->supportOf()->kt()->isNotEmpty()): ?>
      <h3 class="all-small-caps pt-6 text-sm">With the Support of</h3>
      <?php
      foreach ($page->supportOf()->toStructure() as $support):
        ?>
        <div class="flex flex-row gap-3 text-base">
          <?= $support->name() ?>
        </div>
        <?php
      endforeach;
      ?>
    <?php endif; ?>

    <!-- NEXT VIEWINGS -->
    <?php if ($page->nextViewings()->toStructure()->isNotEmpty()): ?>
      <h3 class="all-small-caps pt-6 text-sm">Next Viewings</h3>
      <?php
      $items = $page->nextViewings()->toStructure();
      foreach ($items as $item): ?>
        <div class="flex flex-col">
          <div class="flex flex-wrap gap-x-5 text-base">
            <?php if ($item->dateUntil()->isNotEmpty()): ?>
              <div class="flex flex-row gap-0.5">
                <?= $item->date()->toDate('%B, %d') ?>–<?= $item->dateUntil()->toDate('%B, %d %G') ?>
              </div>
            <?php else: ?>
              <div class="flex flex-row gap-0.5">
                <?= $item->date()->toDate('%B, %d %G') ?>
              </div>
            <?php endif; ?>
            <div>
              <?= $item->name()->kt() ?>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    <?php endif; ?>

  </div>
</article>