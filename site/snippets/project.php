<div class="relative h-full z-20 overflow-y-scroll" x-data="{ menuOpen: false }"
     x-init="() => $watch('menuOpen', (value) => document.body.style.overflow = value ? 'hidden' : 'auto')">

  <div
    class="fixed flex flex-col items-center bottom-1 inset-x-20 font-serif text-sm all-small-caps ">
    <p id="project-more-info">title</p>
    <button
      @click="menuOpen = !menuOpen; $nextTick(() => { setTimeout(() => $refs.projectOverlay.scrollTop = 0, 200); })"
      :aria-expanded="menuOpen" aria-controls="navigation"
      class="hover:underline underline-offset-2"
      aria-label="Navigation Menu">
      More Info
    </button>
  </div>

  <div id="navigation" x-show="menuOpen" x-ref="projectOverlay"
       class="w-full flex flex-col fixed bottom-0 top-[20%] left-0 backdrop-blur-md overflow-y-scroll rounded-t-2xl"
       style="background-color:<?= $page->backgroundColor()->escape() ?>;"
       x-transition:enter="transition duration-500 ease-in-out" x-transition:enter-start="translate-y-full"
       x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in-out duration-500"
       x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">


    <article class="top grid lg:grid-cols-6 grid-row px-3 font-sans text-lg pb-20 gap-6">
      <button @click="menuOpen = !menuOpen" x-show="menuOpen" x-transition:enter.delay.350ms
              class="fixed top-2 left-3 z-30 gap-5 font-serif all-small-caps text-sm hover:underline underline-offset-2"
              :aria-expanded="menuOpen"
              aria-controls="navigation" aria-label="Navigation Menu">
        close
      </button>
      <div class="lg:row-start-1 row-start-2 lg:col-start-2 lg:col-end-6 text-lg pb-24 pt-2">
        <h2 id="project-title" class="text-lg text-center">
        </h2>
        <h3 class="font-serif text-sm all-small-caps pb-24 text-center">Share this project</h3>
        <article id="project-description">
        </article>
        <div id="project-presskits" class="flex flex-col font-serif text-base pt-12">
          <h3 class="all-small-caps text-sm">Presskits</h3>
        </div>
      </div>


    </article>


  </div>

</div>

</div>