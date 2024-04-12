<!DOCTYPE html>
<html lang="en" class="h-screen">

<?php snippet('head') ?>

<body class="h-full">
    <?php snippet('header') ?>
    <main class="px-3 pt-1">
        <div class="flex flex-row">
            <nav class="flex gap-5 font-serif all-small-caps ">
                <a class="" href=" ">index</a>
                <a class="" href=" ">sort</a>
            </nav>
            
        </div>

        <?php snippet('about') ?>

        <div x-data="scrollApp()" x-init="duplicateImages()" @scroll="handleScroll" class="image-container" x-ref="container">
                <li>
                    <img src="content/0003_13.jpg" class="h-[600px]">
                </li>
        </div>
        <!-- <ul class="flex flex-row flex-nowrap items-center">
                    <li>
                        <img src="content/0003_13.jpg" class="h-96 w-100%">
                    </li>
                    <li>
                        <img src="content/0033_33.jpg" class="h-96 w-100%">
                    </li>
                    <li>
                        <img src="content/0037_E.jpg" class="h-96 w-100%">
                    </li>
                    <li>
                        <img src="content/000061630010.jpg" class="h-96 w-100%">
                    </li>
                    <li>
                        <img src="content/000061660009.jpg" class="h-96 w-100%">
                    </li>
                </ul> -->




                
    <!-- Original images -->



    </main>
    <?php snippet('footer') ?>

    <script>
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
</script>
    <?= vite()->js('index.js') ?>
</body>

</html>