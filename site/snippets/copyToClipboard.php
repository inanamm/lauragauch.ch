<button
  x-ref="copyToClipboardRef"
  class="leading-tight block font-serif text-sm all-small-caps text-center pt-1 overflow-hidden hover:underline
  bottom-2.5 lg:top-2 lg:bottom-auto
        right-3 lg:left-3 lg:right-auto
        lg:hover:underline lg:underline-offset-2 
        rounded-lg lg:rounded-none 
        px-2 lg:p-0
        py-0.5 
        backdrop-blur-sm lg:backdrop-blur-0"
  x-data="copyToClipboard('<?= $copyText ?>')"
  @click="copyToClipboard"
>
  <?= $buttonText ?>
</button>