<div class="relative h-full z-50" x-data="{ menuOpen: true }">

    <button @click="menuOpen = !menuOpen" class="fixed top-1 right-3 z-30" :aria-expanded="menuOpen"
        aria-controls="navigation" aria-label="Navigation Menu">
        <h1 class="font-sans text-2xl">
            Laura Gauch
        </h1>
    </button>

    <div id="navigation" x-show="menuOpen"
        class="h-full w-full flex flex-col fixed bottom-0 left-0 backdrop-blur-md bg-white/50"
        x-transition:enter="transition duration-500 ease-in-out" x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in-out duration-500"
        x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">

        <button @click="menuOpen = !menuOpen" class="fixed top-1 z-30" :aria-expanded="menuOpen"
            aria-controls="navigation" aria-label="Navigation Menu">
            <div class="flex justify-between pb-5 px-3 font-sans">
                <nav class="flex gap-5 font-serif all-small-caps">
                    <p class="">close</p>
                </nav>
            </div>
        </button>

        <article class="top grid lg:grid-cols-3 grid-row px-3 font-sans text-2xl pt-32 pb-20 gap-6">
            <div class="col-span-2">
                <h3 class="font-serif text-base all-small-caps">Biography</h3>
                <?= $site->page('about')->biography() ?>
            </div>
            <div class="flex flex-col gap-8">
                <div>
                    <h3 class="font-serif text-base all-small-caps">Contact</h3>

                    <?= kirbytag([
                        'email' => $site->page('about')->email(),
                        'text' => $site->page('about')->email(),
                    ]);
                    ?>
                    <?php if ($site->page('about')->contact()->isNotEmpty()): ?>
                        <dd><?= Html::tel($site->page('about')->contact()) ?></dd>
                    <?php endif ?>
                </div>
                <div class="flex flex-col">
                    <h3 class="font-serif text-base all-small-caps">Social Media</h3>
                    <a href="<?= $site->page('about')->instagramLink()->toUrl() ?>" <?php e($site->page('about')->target()->toBool(), 'target="_blank"') ?>>
                        <?= $site->page('about')->instagramLinkText() ?> </a>
                </div>
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


                <h3 class="all-small-caps pt-6">Selected Press</h3>
                <?php
                $presskits = $site->page('about')->press()->toStructure();
                foreach ($presskits as $linkObject):
                    ?>
                    <div class="flex flex-row gap-3">
                        <div class="w-[10%]">
                            <?= $linkObject->date()->toDate('Y') ?>
                        </div>
                        <a href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>>
                            <?= $linkObject->title()->or($linkObject->link()) ?>
                        </a>
                    </div>
                    <?php
                endforeach;
                ?>


                <h3 class="all-small-caps pt-6">Past Exhibitions + Film Festivals</h3>
                <?php $items = $site->page('about')->exhibitions()->toStructure();
                foreach ($items as $item):
                    ?>
                    <div class="flex flex-row gap-3">
                        <div class="w-[10%]">
                            <?= $item->year()->toDate('Y') ?>
                        </div>
                        <?= $item->title()->kt() ?>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>

            <div class="flex flex-col">
                <h3 class="all-small-caps">Upcoming</h3>
                <?php $items = $site->page('about')->upcoming()->toStructure();
                foreach ($items as $item):
                    ?>
                    <div class="flex flex-row gap-3">
                        <div class="w-[10%]">
                            <?= $item->date()->toDate('Y') ?>
                        </div>
                        <?= $item->title()->kt() ?>
                    </div>
                    <?php
                endforeach;
                ?>

                <h3 class="all-small-caps pt-6">Grants, Residencies and Awards</h3>
                <?php $items = $site->page('about')->awards()->toStructure();
                foreach ($items as $item):
                    ?>
                    <div class="flex flex-row gap-3">
                        <div class="w-[10%]">
                            <?= $item->year()->toDate('Y') ?>
                        </div>
                        <?= $item->title()->kt() ?>
                    </div>
                    <?php
                endforeach;
                ?>

                <h3 class="all-small-caps pt-6">Website</h3>
                <?= $site->page('about')->datasecurity() ?>
                <?= $site->page('home')->imprint() ?>
            </div>
            <div class="flex flex-col">
                <h3 class="all-small-caps">Selected Clients</h3>
                <?= $site->page('about')->clients() ?>
                <h3 class="all-small-caps pt-6">Talented friends and collaborators</h3>
                <?= $site->page('about')->friends() ?>
            </div>

        </div>


    </div>

</div>