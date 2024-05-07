<div class="relative h-full z-20 overflow-y-scroll" x-data="{ menuOpen: false }"
    x-init="() => $watch('menuOpen', (value) => document.body.style.overflow = value ? 'hidden' : 'auto')">

    <button
        @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectOverlay.scrollTop = 0, 200); $refs.projectOverlay.style.backgroundColor = '#efefef' })"
        class="fixed bottom-1 z-10 font-serif text-base" :aria-expanded="menuOpen" aria-controls="navigation"
        aria-label="Navigation Menu">
        Projektdetails
    </button>

    <button @click="menuOpen = !menuOpen" x-show="menuOpen" x-transition:enter.delay.350ms
        class="fixed top-1 left-3 z-30 gap-5 font-serif all-small-caps" :aria-expanded="menuOpen"
        aria-controls="navigation" aria-label="Navigation Menu">
        close
    </button>


    <div id="navigation" x-show="menuOpen" x-ref="projectOverlay"
        class="w-full flex flex-col fixed bottom-0 top-[20%] left-0 backdrop-blur-md overflow-y-scroll rounded-t-2xl"
        style="background-color:<?= $page->backgroundColor()->escape() ?>;"
        x-transition:enter="transition duration-500 ease-in-out" x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in-out duration-500"
        x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">



        <article class="top grid lg:grid-cols-6 grid-row px-3 font-sans text-2xl pb-20 gap-6">
            <div class="col-span-4 row-start-2 row-end-">
                <h3 class="font-serif text-base all-small-caps">Share this project</h3>
                <?= $site->page('about')->biography() ?>
            </div>
        </article>

        <div class="bottom grid lg:grid-cols-3 grid-row font-serif px-3 lg:flex-row gap-6">

            <div class="flex flex-col">
                <h3 class="all-small-caps">Presskits</h3>
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

    </div>

</div>