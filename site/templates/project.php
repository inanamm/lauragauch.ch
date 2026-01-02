<!DOCTYPE html>
<html lang="en" class="h-screen dark:text-white">

<?php snippet('head'); ?>
<?php
$hslaColor = slothieHelpers()->HSLtoHSLA($page->backgroundColor()->escape());
$style = "background-color: {$hslaColor}";
?>
<script src="https://player.vimeo.com/api/player.js"></script>


<body style="<?= $style ?>" class="h-full no-scrollbar">
<?php snippet('header'); ?>

<main class="overflow-scroll h-full bg-white/10 no-scrollbar">
  <div class="px-3 pt-1 lg:grid lg:grid-cols-6">

    <a
      href="<?= site()->url() ?>"
      class="fixed top-1 right-3 z-30 font-sans lg:text-lg hover:no-underline text-md"
    >
      Laura Gauch
    </a>

    <div
      class="fixed bottom-2.5 right-3 z-30 py-0.5 px-2 font-serif text-sm rounded-lg lg:top-2 lg:left-3 lg:right-auto lg:bottom-auto lg:p-0 lg:bg-transparent lg:rounded-none all-small-caps bg-white/45 backdrop-blur-xs lg:hover:underline lg:underline-offset-2 lg:backdrop-blur-0">
      <a href="<?= site()->url() ?>">Back</a>
    </div>

    <div class="col-span-4 col-start-2 pt-16 pb-4 text-center lg:pt-24 lg:text-lg text-md">
      <?= $page->title()->kt() ?>
    </div>

    <?php if ($page->description()->isNotEmpty()): ?>
      <article
        class="flex flex-col gap-3 pt-24 pb-16 lg:col-start-2 lg:col-end-6 lg:row-start-2 lg:text-lg text-md">
        <?= $page->description()->kt() ?>
      </article>
    <?php endif ?>

    <!-- ADDITIONAL INFO -->
    <div class="font-serif lg:col-span-4 lg:col-start-2">

      <!-- REQUEST FULL MOVIE -->
      <?php if ($page->requestToggle()->toBool() === true): ?>
        <a
          href="mailto:?subject=Request access to full film by Laura Gauch&body=Hi! I saw the trailer to <?= $page->title() ?> on your website. Is it possible to get access to the full film? Thank you!"
          class="pt-6 text-sm all-small-caps">Full Film on Request</a>
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


    <!-- Gallery -->
    <section class="py-24 lg:col-span-6 lg:col-start-1">
      <div class="flex flex-wrap gap-1 w-full last:pb-0">
        <!-- VIDEO -->
        <?php if ($page->vimeo()->isNotEmpty()): ?>
          <div class="overflow-hidden relative h-52 w-auto lg:h-96 aspect-video">
            <iframe
              id="vimeo-iframe"
              class="absolute inset-0 w-full h-full"
              src="https://player.vimeo.com/video/<?= $page->vimeo()->escape() ?>?title=0&byline=0&portrait=0&autopause=0"
              frameborder="0"
              webkitallowfullscreen
              mozallowfullscreen
              allowfullscreen
            >
            </iframe>
          </div>
        <?php endif ?>

        <!-- BILDER -->
        <?php foreach ($page->gallery()->toFiles() as $image): ?>
          <figure class="h-52 lg:h-96 lg:w-auto [&_img]:h-full [&_img]:w-auto [&_img]:object-contain">
            <?= $image->thumb([
          'quality' => 90,
          'format' => 'webp',
      ])->html() ?>
          </figure>
        <?php endforeach ?>
      </div>
    </section>
  </div>

</main>
</body>
</html>
