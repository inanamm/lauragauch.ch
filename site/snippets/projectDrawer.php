<div class="dark:text-white relative h-full z-20 overflow-y-scroll no-scrollbar" x-data="drawer">

    <div class="h-screen w-full fixed inset-0" @click="menuOpen = false" x-show="menuOpen"
        :aria-expanded="menuOpen.toString()" style="display: none;">
    </div>

    <div class="fixed flex flex-col items-center bottom-2.5 lg:bottom-1 inset-x-20 font-serif text-base leading-tight">
        <p class="text-center hidden lg:flex" id="project-more-info">title</p>
        <button
            @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectOverlay.scrollTop = 0, 200); })"
            :aria-expanded="menuOpen" aria-controls="navigation" class="
            hover:underline 
            underline-offset-2 
            all-small-caps 
            text-sm
            font-serif
            lg:hover:underline lg:underline-offset-2
            rounded-lg lg:rounded-none
            bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent
            px-2 lg:p-0
            py-0.5
            backdrop-blur-sm lg:backdrop-blur-0
            z-20" aria-label="Navigation Menu">
            More Info
        </button>
    </div>

    <div id="navigation" x-show="menuOpen" x-ref="projectOverlay"
        class="w-full flex flex-col fixed bottom-0 top-[20%] lg:top-[35%] left-0 backdrop-blur-md overflow-y-scroll rounded-t-2xl drop-shadow-sm no-scrollbar"
        style="background-color:<?= $page->backgroundColor()->escape() ?>;"
        x-transition:enter="transition duration-500 ease-in-out" x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in-out duration-500"
        x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">


        <article
            class="top grid w-full lg:grid-cols-6 grid-row px-3 font-sans lg:text-lg text-md pb-20 gap-6 overflow-scroll">
            <button @click="menuOpen = !menuOpen" x-show="menuOpen" x-transition:enter.delay.350ms
                class="fixed top-2 left-3 z-30 gap-5 font-serif all-small-caps text-sm hover:underline underline-offset-2"
                :aria-expanded="menuOpen" aria-controls="navigation" aria-label="Navigation Menu">
                close
            </button>
            <div
                class="lg:row-start-1 row-start-2 lg:col-start-2 lg:col-end-6 lg:text-lg text-md pb-8 lg:pb-24 pt-12 lg:pt-2">
                <h2 id="project-title" class="lg:text-lg text-md text-center"></h2>
                <a id="project-url" href="" target="_blank"
                    class="block font-serif text-sm all-small-caps text-center pt-1.5"
                    data-copy-to-clipboard="project-url">Share this project
                </a>

                <article id="project-description" class="pt-16 lg:pt-24"></article>

        <h3 class="all-small-caps font-serif text-sm pt-12">Presskits</h3>
        <div id="project-presskits" class="flex flex-col font-serif text-base"></div>

      </div>
    </article>
  </div>

</div>

</div>

<script>
    // Function to copy text to clipboard
    function copyToClipboard(text) {
        var textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
    }

    // Event listener to copy text to clipboard
    document.addEventListener('click', function (event) {
        var target = event.target;
        if (target.closest("[data-copy-to-clipboard]")) {
            event.preventDefault(); // Prevent default link behavior
            copyToClipboard(target.dataset.copyToClipboard);
            target.classList.add("is-active");
            setTimeout(function () {
                target.classList.remove("is-active");
            }, 1000);
        }
    });
</script>
