<div
  class="grid fixed inset-0 z-30 grid-rows-5 h-screen lg:grid-rows-3 dark:text-white no-scrollbar"
  x-data
  x-show="$store.projectDrawer.open"
  x-transition:enter="transition lg:duration-1000 duration-700 ease-in-out"
  x-transition:enter-start="translate-y-full"
  x-transition:enter-end="translate-y-0"
  x-transition:leave="transition lg:duration-1000 duration-700 ease-in-out"
  x-transition:leave-start="translate-y-0"
  x-transition:leave-end="translate-y-full"
  @keyup.escape.window="$store.projectDrawer.closeDrawer()"

>
  <div
    class="flex row-span-1 w-full h-full opacity-0 lg:row-span-1"
    x-data
    @click="$store.projectDrawer.closeDrawer()"
  ></div>

  <div
    x-ref="projectOverlay"
    class="overflow-y-scroll relative row-span-4 w-full h-full rounded-t-2xl lg:row-span-2 drop-shadow-xs no-scrollbar backdrop-blur-md"
  >
    <button
      @click="$store.projectDrawer.closeDrawer()"
      x-show="$store.projectDrawer.open"
      x-transition:enter.delay.350ms
      class="absolute bottom-2.5 right-3 z-50 gap-5 py-0.5 px-2 font-serif text-sm rounded-lg lg:top-2 lg:left-3 lg:right-auto lg:bottom-auto lg:p-0 lg:bg-transparent lg:rounded-none hover:underline all-small-caps underline-offset-2 bg-white/65 backdrop-blur-xs lg:hover:underline lg:underline-offset-2 lg:backdrop-filter-none dark:bg-white/25 dark:lg:bg-transparent"
      :aria-expanded="$store.projectDrawer.open"
      aria-controls="projectDetails"
      aria-label="Project Details"
    >
      close
    </button>
    <div id="content" class="h-full rounded-t-2xl"></div>
  </div>
</div>

