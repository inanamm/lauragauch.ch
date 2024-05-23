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
                backdrop-blur-sm lg:backdrop-blur-0
                z-30">
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
                            <a href="<?= $linkObject->link()->toUrl() ?>" <?= $linkObject->target()->toBool() ? 'target="_blank"' : '' ?>> <?= $linkObject->title()->or($linkObject->link()) ?>
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
                <div class="flex flex-wrap last:pb-0 w-full gap-1">
                    <!-- VIDEO -->
                    <?php if ($page->vimeo()->isNotEmpty()): ?>
                        <div class="video-responsive lg:h-96 h-52">
                            <div class="relative w-full h-52 lg:h-96 max-h-96 overflow-hidden">
                                <iframe id="vimeo-iframe" class="w-full h-full"
                                    src="https://player.vimeo.com/video/<?= $page->vimeo()->escape() ?>?title=0&byline=0&portrait=0&autopause=0"
                                    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php foreach ($page->gallery()->toFiles() as $image): ?>
                        <figure class="h-52 lg:h-96">
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