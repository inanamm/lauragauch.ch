<!DOCTYPE html>
<html lang="en" class="h-screen">

<?php snippet('head') ?>

<body class="h-full">
    <?php snippet('header') ?>
    <main class="px-3 pt-1">
        <div class="flex flex-row fixed">
            <nav class="flex gap-5 font-serif all-small-caps ">
                <a class="relative" href=" ">index</a>
                <a class="relative" href=" ">sort</a>
            </nav>

        </div>

        <?php snippet('about') ?>

        <div class="pt-32 pb-32">
            <ul class="flex flex-row gap-12 overflow-x-auto h-auto w-min items-center">
                <?php $projectsPage = $site->find('projects');
                foreach ($projectsPage->children() as $project) {
                    foreach ($project->cover()->toFiles() as $image): ?>
                        <fic class="w-[50rem] h-max-[96rem]">
                            <?= $image->thumb([
                                'quality' => 90,
                                'format' => 'webp',
                            ])->html(); ?>
                            <figcaption class="flex flex-col font-serif">
                                <h3><?= $project->title() ?></h3>
                                <a href="" class="all-small-caps underline">More info</a>
                            </figcaption>
                        </fic>
                    <?php endforeach;
                }
                ?>
            </ul>
        </div>

        <div class="">
            <?php snippet('project') ?>
        </div>

    </main>
    <?php snippet('footer') ?>

    <!-- <script>
        function scrollApp() {
            return {
                container: null,

                duplicateImages() {
                    const container = this.$refs.container;
                    const images = Array.from(container.children);
                    images.forEach(img => container.appendChild(img.cloneNode(true)));
                },

                handleScroll(event) {
                    const container = this.$refs.container;
                    const scrollWidth = container.scrollWidth / 2; // Since we duplicated the images
                    const currentScroll = event.target.scrollLeft;

                    // Reset scroll position to start before the halfway point (to make it seamless)
                    if (currentScroll >= scrollWidth) {
                        container.scrollLeft = 0;
                    }
                }
            }
        }
    </script> -->
    <?= vite()->js('index.js') ?>
</body>

</html>