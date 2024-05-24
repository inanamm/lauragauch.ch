<div
  class="grid grid-rows-5 lg:grid-rows-3 dark:text-white fixed inset-0 h-screen z-40 overflow-y-scroll no-scrollbar"
  x-data
  x-show="$store.projectDrawer.open"
  x-transition:enter="transition duration-500 ease-in-out"
  x-transition:enter-start="translate-y-full"
  x-transition:enter-end="translate-y-0"
  x-transition:leave="transition ease-in-out duration-500"
  x-transition:leave-start="translate-y-0"
  x-transition:leave-end="translate-y-full"
>

  <div x-data class="flex h-full w-full opacity-0 row-span-1 lg:row-span-1"
       @click="$store.projectDrawer.toggle()"
       x-show="$store.projectDrawer.open"
       :aria-expanded="$store.projectDrawer.open"
  ></div>

  <div
    x-data
    x-ref="projectOverlay"
    class="w-full h-full overflow-y-scroll rounded-t-2xl drop-shadow-sm no-scrollbar row-span-4 lg:row-span-2 backdrop-blur-md"
  >
    <button
      x-data
      @click="$store.projectDrawer.toggle()"
      x-show="$store.projectDrawer.open"
      x-transition:enter.delay.350ms
      class="fixed z-40 gap-5 font-serif all-small-caps text-sm hover:underline underline-offset-2
      bottom-2.5 lg:top-2 lg:bottom-auto
      right-3 lg:left-3 lg:right-auto
      lg:hover:underline lg:underline-offset-2
      rounded-lg lg:rounded-none
      bg-white/65 lg:bg-transparent dark:bg-white/25 dark:lg:bg-transparent
      px-2 lg:p-0
      py-0.5
      backdrop-blur-sm lg:backdrop-blur-0
      "
      :aria-expanded="$store.projectDrawer.open"
      aria-controls="navigation"
      aria-label="Navigation Menu"
    >
      close
    </button>
    <div id="content" class="h-full"></div>

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
