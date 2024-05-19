<!DOCTYPE html>
<html lang="en" class="h-screen">

<?php snippet('head') ?>
<?php
$hslaColor = slothieHelpers()->HSLtoHSLA($page->backgroundColor()->escape());
$style = "background-color: $hslaColor";
?>


<body style="<?= $style ?>" class="h-full ">
<?php snippet('header') ?>

<main class="bg-white/10 h-full overflow-scroll ">
  <div class="px-3 pt-1 lg:grid lg:grid-cols-6">

    <div class="button absolute col-start-1 font-serif text-sm all-small-caps hover:underline underline-offset-2">
      <a href="<?= site()->url() ?>">Back</a>
    </div>
    <div class="col-start-2 col-span-4 text-center lg:text-lg text-md pt-16 lg:pt-24">
      <?= $page->title()->kt() ?>
    </div>

    <article class="lg:row-start-2 lg:col-start-2 lg:col-end-6 lg:text-lg text-md pt-24 pb-16">
      <?= $page->description()->kt() ?>
    </article>


    <!-- ADDITIONAL INFO -->
    <div class="lg:col-start-2 lg:col-span-4 font-serif">
      <?php if ($page->presskits()->kt()->isNotEmpty()): ?>
        <h3 class="all-small-caps pt-6 text-sm">presskits</h3>
        <?php
        $presskits = $page->presskits()->toStructure();
        foreach ($presskits as $linkObject):
          ?>
          <div class="flex flex-row gap-3 text-base">
            <a
              href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>> <?= $linkObject->title()->or($linkObject->link()) ?>
            </a>
          </div>
        <?php
        endforeach;
        ?>
      <?php endif; ?>


      <?php
      $items = $page->additionalInfo()->toStructure();
      foreach ($items as $item): ?>
        <div class="flex flex-col">
          <h3 class="font-serif text-sm all-small-caps pt-4"><?= $item->additionalDetails()->kt() ?></h3>
          <div class="flex flex-row gap-5 text-base">
            <?php if ($item->date()->kt()->isNotEmpty()): ?>
              <div class="flex flex-row gap-0.5"><?= $item->date()->kt() ?>–<?= $item->dateUntil()->kt() ?>
              </div>
            <?php endif; ?>
            <?= $item->value()->kt() ?>
          </div>
        </div>
      <?php endforeach ?>
    </div>

    <!-- BILDER -->
    <section class="py-24 lg:col-start-2 lg:col-span-4">
      <div class="flex flex-wrap last:pb-0 w-full gap-1 ">
        <?php foreach ($page->cover()->toFiles() as $image): ?>
          <figure class="h-52 lg:h-96">
            <?php echo $image->thumb([
              'quality' => 90,
              'format' => 'webp',
            ])->html(); ?>
          </figure>
        <?php endforeach ?>

        <?php foreach ($page->gallery()->toFiles() as $image): ?>
          <figure class=" h-52 lg:h-96">
            <?php echo $image->thumb([
              'quality' => 90,
              'format' => 'webp',
            ])->html(); ?>
          </figure>
        <?php endforeach ?>
      </div>
    </section>
  </div>
</main>
<?= vite()->js('index.js') ?>
</body>

<script>
  function correctFigureSize(figureElement) {
    figureElement.onload = function () {
      const aspectRatio = figureElement.naturalWidth / figureElement.naturalHeight;
      const containerHeight = figureElement.closest('figure').clientHeight;
      figureElement.closest('figure').style.width = `${containerHeight * aspectRatio}px`;
    };
  }
</script>

</html>