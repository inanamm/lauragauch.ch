<div class="relative h-full z-50" x-data="{ menuOpen: false }">

    <button @click="menuOpen = !menuOpen" class="fixed bottom-3 right-3 z-30" :aria-expanded="menuOpen" aria-controls="navigation" aria-label="Navigation Menu">
        <svg class="h-5 w-5 text-csorange group-open:rotate-45 transition-transform origin-left" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="4">
            <line x1="12.5" y1="0" x2="12.5" y2="25" x-show="!menuOpen" />
            <line x1="0" y1="12.5" x2="25" y2="12.5" />
        </svg>
    </button>

    <div id="navigation" x-show="menuOpen" class="h-auto w-full flex flex-col bg-cswhite border-t border-csorange divide-y divide-csorange text-csorange fixed bottom-0 left-0" x-transition:enter="transition duration-500 ease-in-out" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">

        <nav class="flex justify-between pt-2 pb-5 px-3 font-sans text-xl">

        </nav>
    </div>

</div>