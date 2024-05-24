<div
  class="grid grid-rows-5 lg:grid-rows-3 dark:text-white fixed inset-0 h-screen z-40 overflow-y-scroll no-scrollbar"
  x-data
  x-show="$store.projectDrawer.open"
>

  <div x-data class="flex h-full w-full opacity-0 row-span-1 lg:row-span-1"
       @click="$store.projectDrawer.toggle()"
       x-show="$store.projectDrawer.open"
       :aria-expanded="$store.projectDrawer.open"
  ></div>

  <div
    x-data
    x-ref="projectOverlay"
    class="w-full h-full overflow-y-scroll rounded-t-2xl drop-shadow-sm no-scrollbar row-span-4 lg:row-span-2"
    x-transition:enter="transition duration-500 ease-in-out"
    x-transition:enter-start="translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition ease-in-out duration-500"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="translate-y-full"
  >
    <button
      x-data
      @click="$store.projectDrawer.toggle()"
      x-show="$store.projectDrawer.open"
      x-transition:enter.delay.350ms
      class="fixed top-2 left-3 z-40 gap-5 font-serif all-small-caps text-sm hover:underline underline-offset-2"
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
