<!DOCTYPE html>
<html lang="en" class="h-screen dark:text-white">

<?php snippet('head') ?>
<?php
$hslaColor = slothieHelpers()->HSLtoHSLA($page->backgroundColor()->escape());
$style = "background-color: $hslaColor";
?>
<script src="https://player.vimeo.com/api/player.js"></script>


<body style="<?= $style ?>" class="h-full no-scrollbar">
    <?php snippet('header') ?>

    <main class="bg-white/10 h-full overflow-scroll no-scrollbar">
        <div class="px-3 pt-1 lg:grid lg:grid-cols-6">

            <a href="<?= site()->url() ?>"
                class="font-sans lg:text-lg text-md fixed top-1 right-3 z-30 hover:no-underline">
                Laura Gauch
            </a>

            <div class="
                fixed
                bottom-2.5 lg:top-2 lg:bottom-auto
                right-3 lg:left-3 lg:right-auto
                font-serif all-small-caps text-sm
                lg:hover:underline lg:underline-offset-2
                rounded-lg lg:rounded-none
                bg-white/45 lg:bg-transparent
                px-2 lg:p-0
                py-0.5
                backdrop-blur-xs lg:backdrop-blur-0
                z-30">
                <a href="<?= site()->url() ?>">Back</a>
            </div>

            <div class="col-start-2 col-span-4 text-center lg:text-lg text-md pt-16 pb-4 lg:pt-24">
                <?= $page->title()->kt() ?>
            </div>

            <?php if ($page->description()->isNotEmpty()): ?>
                <article
                    class="lg:row-start-2 lg:col-start-2 lg:col-end-6 lg:text-lg text-md pt-24 pb-16 flex flex-col gap-3">
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
                <?php
                $presskits = $page->presskits()->toStructure();
                $hasVisiblePresskits = false;
                $visiblePresskits = [];

                foreach ($presskits as $presskit) {
                    if ($presskit->toggle()->toBool() === true) {
                        $visiblePresskits[] = $presskit;
                        $hasVisiblePresskits = true;
                    }
                }
                ?>

                <?php if ($hasVisiblePresskits): ?>
                    <h3 class="all-small-caps pt-6 text-sm">presskits</h3>
                    <?php foreach ($visiblePresskits as $presskit): ?>
                        <div class="flex flex-row gap-3 text-base">
                            <?= $presskit->title() ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


                <!-- COLLABORATION -->
                <?php
                $collaborations = $page->collaboration()->toStructure();
                $hasVisibleCollaborations = false;
                $visibleCollaborations = [];

                foreach ($collaborations as $collab) {
                    if ($collab->toggle()->toBool() === true) {
                        $visibleCollaborations[] = $collab;
                        $hasVisibleCollaborations = true;
                    }
                }
                ?>

                <?php if ($hasVisibleCollaborations): ?>
                    <h3 class="all-small-caps pt-6 text-sm">in collaboration with</h3>
                    <?php foreach ($visibleCollaborations as $collab): ?>
                        <div class="flex flex-row gap-3 text-base">
                            <?= $collab->name() ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


                <!-- SUPPORT OF -->
                <?php
                $supports = $page->supportOf()->toStructure();
                $hasVisibleSupports = false;
                $visibleSupports = [];

                foreach ($supports as $support) {
                    if ($support->toggle()->toBool() === true) {
                        $visibleSupports[] = $support;
                        $hasVisibleSupports = true;
                    }
                }
                ?>

                <?php if ($hasVisibleSupports): ?>
                    <h3 class="all-small-caps pt-6 text-sm">With the Support of</h3>
                    <?php foreach ($visibleSupports as $support): ?>
                        <div class="flex flex-row gap-3 text-base">
                            <?= $support->name() ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


                <!-- NEXT VIEWINGS -->
                <?php
                $viewings = $page->nextViewings()->toStructure();
                $hasVisibleViewings = false;
                $visibleViewings = [];

                foreach ($viewings as $item) {
                    if ($item->toggle()->toBool() === true) {
                        $visibleViewings[] = $item;
                        $hasVisibleViewings = true;
                    }
                }
                ?>

                <?php if ($hasVisibleViewings): ?>
                    <h3 class="all-small-caps pt-6 text-sm">Next Viewings</h3>
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
                                <?php endif; ?>
                                <div>
                                    <?= $item->name()->kt() ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>


            </div>


            <!-- Gallery -->
            <section class="py-24 lg:col-start-1 lg:col-span-6">
                <div class="flex flex-wrap last:pb-0 w-full gap-1">
                    <!-- VIDEO -->
                    <?php if ($page->vimeo()->isNotEmpty()): ?>
                        <div class="relative w-full aspect-video max-h-96 overflow-hidden">
                            <iframe id="vimeo-iframe" class="absolute inset-0 w-full h-full"
                                src="https://player.vimeo.com/video/<?= $page->vimeo()->escape() ?>?title=0&byline=0&portrait=0&autopause=0"
                                frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>

                    <!-- BILDER -->
                    <?php foreach ($page->gallery()->toFiles() as $image): ?>
                        <figure class="h-52 lg:h-96 lg:w-auto [&_img]:h-full [&_img]:w-auto [&_img]:object-contain">
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
    document.addEventListener('DOMContentLoaded', function () {
        // Get the Vimeo URL from the PHP variable and log it to the console
        console.log('Vimeo URL:', '<?= $page->vimeo()->escape() ?>');
    });
</script>
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