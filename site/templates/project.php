<!DOCTYPE html>
<html lang="en" class="h-screen">

<?php snippet('head') ?>
<?php
$hslColor = $page->backgroundColor()->escape();
$alpha = 0.5; // 50% opacity
$hslColor = trim($hslColor);
$hslColor = substr($hslColor, 4, -1);
$hslParts = explode(' ', $hslColor);
$hue = trim($hslParts[0]);
$saturation = trim($hslParts[1]);
$lightness = trim($hslParts[2]);
$hslaColor = "hsla($hue, $saturation, $lightness, $alpha)";
$style = "background-color: $hslaColor";
?>

<body class="h-full bg-blue-100" style="<?= $style ?>">
    <?php snippet('header') ?>

    <main>
        <div class=" px-3 pt-1 lg:grid lg:grid-cols-6">

            <div class="button col-start-1 font-serif text-base all-small-caps"><a href="<?= site()->url() ?>">Back</a>
            </div>
            <div class="col-start-2 col-span-4 text-center text-2xl pb-24">
                <?= $page->title() ?>
            </div>

            <article class="lg:row-start-2 lg:col-start-2 lg:col-end-6 text-2xl pb-24">
                <?= $page->description() ?>
            </article>



            <!-- ADDITIONAL INFO -->
            <div class="lg:col-start-2 lg:col-span-4 font-serif">
                <?php if ($page->presskits()->kt()->isNotEmpty()): ?>
                    <h3 class="all-small-caps pt-6">presskits</h3>
                    <?php
                    $presskits = $page->presskits()->toStructure();
                    foreach ($presskits as $linkObject):
                        ?>
                        <div class="flex flex-row gap-3">
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
                        <h3 class="font-serif text-base all-small-caps pt-4"><?= $item->additionalDetails()->kt() ?></h3>
                        <div class="flex flex-row gap-5">
                            <?php if ($item->date()->kt()->isNotEmpty()): ?>
                                <div class="flex flex-row gap-0.5"><?= $item->date()->kt() ?>–<?= $item->dateUntil()->kt() ?>
                                </div>
                            <?php endif; ?>
                            <?= $item->value()->kt() ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>


        <!-- BILDER -->
        <section class="gallery pt-24">
            <ul class="flex flex-row gap-1 items-center">
                <?php foreach ($page->cover()->toFiles() as $image): ?>
                    <li class="<?= $image->ratio() > 1 ? 'w-full' : 'w-full' ?> pb-0.5 last:p-0">
                        <?php echo $image->thumb([
                            'quality' => 90,
                            'format' => 'webp',
                        ])->html(); ?>
                    </li>
                <?php endforeach ?>
                <?php foreach ($page->gallery()->toFiles() as $image): ?>
                    <li class="<?= $image->ratio() > 1 ? 'w-full' : 'w-full' ?> pb-0.5 last:p-0">
                        <?php echo $image->thumb([
                            'quality' => 90,
                            'format' => 'webp',
                        ])->html(); ?>
                    </li>
                <?php endforeach ?>
            </ul>

        </section>

    </main>

    <?= vite()->js('index.js') ?>
</body>

</html>