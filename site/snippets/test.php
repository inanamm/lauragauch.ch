<article
  style="background-color: <?= $bgColor ?>"
  class="top lg:grid w-full h-full lg:grid-cols-6 grid-row px-3 font-sans lg:text-lg text-md pb-20 gap-6 overflow-scroll no-scrollbar"
>

  <div class="col-start-2 col-span-4 text-center lg:text-lg text-md pt-16 lg:pt-3">
    <?= $page->title()->kt() ?>
    <a id="project-url" href="" target="_blank"
       class="leading-tight block font-serif text-sm all-small-caps text-center pt-1.5"
       data-copy-to-clipboard="project-url">Share this project
    </a>
  </div>


  <article class="lg:row-start-2 lg:col-start-2 lg:col-end-6 lg:text-lg text-md pt-24 pb-16 ">
    <?= $page->description()->kt() ?>
  </article>

  <!-- ADDITIONAL INFO -->
  <div class="lg:col-start-2 lg:col-span-4 font-serif">

    <!-- PRESSKITS -->
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

    <!-- COLLABORATION -->
    <?php if ($page->collaboration()->kt()->isNotEmpty()): ?>
      <h3 class="all-small-caps pt-6 text-sm">in collaboration with</h3>
      <?php
      $presskits = $page->collaboration()->toStructure();
      foreach ($presskits as $linkObject):
        ?>
        <div class="flex flex-row gap-3 text-base">
          <a
            href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>> <?= $linkObject->name()->or($linkObject->link()) ?>
          </a>
        </div>
      <?php
      endforeach;
      ?>
    <?php endif; ?>

    <!-- SUPPORT OF -->
    <?php if ($page->supportOf()->kt()->isNotEmpty()): ?>
      <h3 class="all-small-caps pt-6 text-sm">With the Support of</h3>
      <?php
      $presskits = $page->supportOf()->toStructure();
      foreach ($presskits as $linkObject):
        ?>
        <div class="flex flex-row gap-3 text-base">
          <a
            href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>> <?= $linkObject->name()->or($linkObject->link()) ?>
          </a>
        </div>
      <?php
      endforeach;
      ?>
    <?php endif; ?>


    <!-- NEXT VIEWINGS -->
    <?php if ($page->nextViewings()->toStructure()->isNotEmpty()): ?>
      <?php
      $items = $page->nextViewings()->toStructure();
      foreach ($items as $item): ?>
        <div class="flex flex-col">
          <h3 class="all-small-caps pt-6 text-sm">Next Viewings</h3>
          <div class="flex flex-wrap gap-x-5 text-base">
            <?php if ($item->date()->isNotEmpty()): ?>
              <div class="flex flex-row gap-0.5"><?= $item->date()->toDate('%B, %d') ?>
                – <?= $item->dateUntil()->toDate('%B, %d %G') ?>
              </div>
            <?php endif; ?>
            <?= $item->name()->kt() ?>
          </div>
        </div>
      <?php endforeach ?>
    <?php endif; ?>

  </div>
</article>
