<article style="background-color: <?= $backgroundColor ?>"
         class="overflow-scroll auto-rows-min px-3 pb-20 w-full h-full font-sans rounded-t-2xl lg:grid lg:grid-cols-6 lg:text-lg grid-row text-md no-scrollbar scroll-smooth">


  <div class="flex flex-col col-span-4 col-start-2 items-center pt-3 pb-4 text-center lg:text-lg text-md lg:pt-18">
    <?= $page->title()->kt() ?>

    <?php snippet('dropdown', slots: true); ?>
    <?php snippet('copyToClipboard', [
    'copyText' => $page->url(),
        'buttonText' => 'Copy link',
]); ?>
    <a
      href="https://www.instagram.com/"
      target="_blank"
      class="font-serif text-sm all-small-caps lg:hover:underline lg:underline-offset-2"
    >
      <?php snippet('copyToClipboard', [
        'copyText' => $page->url(),
          'buttonText' => 'Share on Instagram',
    ]); ?>
    </a>
    <a
      href="mailto:?subject=Check out this project by Laura Gauch&body=Here is the link to Laura Gauch's website: <?= $page->url() ?>"
      class="flex flex-col font-serif text-sm text-left rounded-lg lg:text-center lg:rounded-none all-small-caps lg:underline-offset-2 lg:hover:underline"
    >
      Share via Email
    </a>
    <a
      href="<?= $page->url() ?>"
      class="flex flex-col font-serif text-sm text-left rounded-lg lg:text-center lg:rounded-none all-small-caps lg:underline-offset-2 lg:hover:underline"
    >
      See full project
    </a>
    <?php endsnippet(); ?>
  </div>

  <?php if ($page->description()->isNotEmpty()): ?>
    <article class="flex flex-col gap-3 pt-12 pb-16 lg:col-start-2 lg:col-end-6 lg:row-start-2 lg:text-lg text-md">
      <?= $page->description()->kt() ?>
    </article>
  <?php endif ?>


  <!-- ADDITIONAL INFO -->
  <div class="font-serif lg:col-span-4 lg:col-start-2">

    <!-- REQUEST FULL MOVIE -->
    <?php if ($page->requestToggle()->toBool() === true): ?>
      <a
        href="mailto:?subject=Request access to full film by Laura Gauch&body=Hi! I saw the trailer to <?= $page->title() ?> on your website. Is it possible to get access to the full film? Thank you!"
        class="pt-6 text-sm all-small-caps"
      >
        Full Film on Request
      </a>
    <?php endif ?>

    <!-- YEAR LOCATION -->
    <?php if ($page->year()->isNotEmpty()): ?>
      <h3 class="pt-6 text-sm all-small-caps">Year</h3>
      <div class="flex flex-row gap-3 text-base">
        <?= $page->year()->escape() ?>
      </div>
    <?php endif ?>

    <!-- PRESSKITS -->
    <?php
    $presskits = $page->presskits()->toStructure();
$hasVisiblePresskits = false;
$visiblePresskits = [];

foreach ($presskits as $presskit):
    if ($presskit->toggle()->toBool() === true):
        $visiblePresskits[] = $presskit;
        $hasVisiblePresskits = true;
    endif;
endforeach;
?>

    <?php if ($hasVisiblePresskits): ?>
      <h3 class="pt-6 text-sm all-small-caps">presskits</h3>
      <?php foreach ($visiblePresskits as $presskit): ?>
        <div class="flex flex-row gap-3 text-base">
          <?= $presskit->title() ?>
        </div>
      <?php endforeach ?>
    <?php endif ?>

    <!-- COLLABORATION -->
    <?php
$collaborations = $page->collaboration()->toStructure();
$hasVisibleCollaborations = false;
$visibleCollaborations = [];

foreach ($collaborations as $collab):
    if ($collab->toggle()->toBool() === true):
        $visibleCollaborations[] = $collab;
        $hasVisibleCollaborations = true;
    endif;
endforeach;
?>

    <?php if ($hasVisibleCollaborations): ?>
      <h3 class="pt-6 text-sm all-small-caps">in collaboration with</h3>
      <?php foreach ($visibleCollaborations as $collab): ?>
        <div class="flex flex-row gap-3 text-base">
          <?= $collab->name() ?>
        </div>
      <?php endforeach ?>
    <?php endif ?>

    <!-- SUPPORT OF -->
    <?php
$supports = $page->supportOf()->toStructure();
$hasVisibleSupports = false;
$visibleSupports = [];

foreach ($supports as $support):
    if ($support->toggle()->toBool() === true):
        $visibleSupports[] = $support;
        $hasVisibleSupports = true;
    endif;
endforeach;
?>

    <?php if ($hasVisibleSupports): ?>
      <h3 class="pt-6 text-sm all-small-caps">With the Support of</h3>
      <?php foreach ($visibleSupports as $support): ?>
        <div class="flex flex-row gap-3 text-base">
          <?= $support->name() ?>
        </div>
      <?php endforeach ?>
    <?php endif ?>

    <!-- NEXT VIEWINGS -->
    <?php
$viewings = $page->nextViewings()->toStructure();
$hasVisibleViewings = false;
$visibleViewings = [];

foreach ($viewings as $item):
    if ($item->toggle()->toBool() === true):
        $visibleViewings[] = $item;
        $hasVisibleViewings = true;
    endif;
endforeach;
?>

    <?php if ($hasVisibleViewings): ?>
      <h3 class="pt-6 text-sm all-small-caps">Next Viewings</h3>
      <?php foreach ($visibleViewings as $item): ?>
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
            <?php endif ?>
            <div>
              <?= $item->name()->kt() ?>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    <?php endif ?>


  </div>
</article>
