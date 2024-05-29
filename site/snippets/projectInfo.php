<article style="background-color: <?= $backgroundColor ?>"
         class="top lg:grid w-full h-full lg:grid-cols-6 grid-row px-3 font-sans lg:text-lg text-md pb-20 gap-6 overflow-scroll no-scrollbar scroll-smooth">


  <div class="flex flex-col items-center col-start-2 col-span-4 text-center lg:text-lg text-md pt-3 lg:pt-18">
    <?= $page->title()->kt() ?>

    <?php snippet('dropdown') ?>

    <div
      x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
      x-on:keydown.escape.prevent.stop="close($refs.button)"
      x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
      x-id="['dropdown-button']"
      class="relative"
    >
      <button
        x-ref="button"
        x-on:click="toggle()"
        :aria-expanded="open"
        :aria-controls="$id('dropdown-button')"
        type="button"
        class="flex items-center gap-2 px-5 py-2.5"
      >
        Toggle me
      </button>

      <div
        x-ref="panel"
        x-show="open"
        x-transition.origin.top.left
        x-on:click.outside="close($refs.button)"
        :id="$id('dropdown-button')"
        style="display: none;"
        class="absolute left-0 mt-2 w-40"
      >
        <?php snippet(
          'copyToClipboard',
          ["copyText" => $page->url(), "buttonText" => "Share this project"]
        ) ?>
      </div>
    </div>

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

