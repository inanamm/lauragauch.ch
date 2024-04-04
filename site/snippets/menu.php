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

        <div class="flex justify-between pt-1 pb-5 px-3 font-sans">
            <nav class="flex gap-5 font-serif all-small-caps">
                <a class="grow" href=" ">close</a>
            </nav>
        </div>
        
        <article class="px-3 font-sans text-2xl pt-32">
            BLablablablablabl bldblsabflsbfldsbfdkslfd  jfdkls ajfkdls jkdsla jkdlsa jkdljkfdlsajf kdls jfkdls jdfkls jdksla fjdksla fjdslkaö fjdksl jdksl jdkls jdkfsl jfdklsa jdfklsa jdkls ajdksl
        </article>

    </div>

</div>