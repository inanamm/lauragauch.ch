<div
  class="grid grid-rows-5 lg:grid-rows-3 dark:text-white fixed inset-0 h-screen z-30 no-scrollbar"
  x-data
  x-show="$store.projectDrawer.open"
  x-transition:enter="transition duration-1000 ease-in-out"
  x-transition:enter-start="translate-y-full"
  x-transition:enter-end="translate-y-0"
  x-transition:leave="transition duration-1000 ease-in-out"
  x-transition:leave-start="translate-y-0"
  x-transition:leave-end="translate-y-full"
  @keyup.escape.window="$store.projectDrawer.closeDrawer()"

>
  <div
    class="flex h-full w-full opacity-0 row-span-1 lg:row-span-1"
    x-data
    @click="$store.projectDrawer.closeDrawer()"
  ></div>

  <div
    x-ref="projectOverlay"
    class="w-full h-full overflow-y-scroll rounded-t-2xl drop-shadow-sm no-scrollbar row-span-4 lg:row-span-2 backdrop-blur-md"
  >
    <button
      @click="$store.projectDrawer.closeDrawer()"
      x-show="$store.projectDrawer.open"
      x-transition:enter.delay.350ms
      class="fixed z-50 gap-5 font-serif all-small-caps text-sm hover:underline underline-offset-2
      bottom-2.5 lg:top-2 lg:bottom-auto
      right-3 lg:left-3 lg:right-auto
      lg:hover:underline lg:underline-offset-2
      rounded-lg lg:rounded-none
      bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent
      px-2 lg:p-0
      py-0.5
      backdrop-blur-sm lg:backdrop-filter-none"
      :aria-expanded="$store.projectDrawer.open"
      aria-controls="projectDetails"
      aria-label="Project Details"
    >
      close
    </button>
    <div id="content" class="h-full"></div>
  </div>
</div>

