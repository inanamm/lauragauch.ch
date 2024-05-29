<button
  x-ref="copyToClipboardRef"
  class=" font-serif text-sm all-small-caps text-center pt-1 overflow-hidden hover:underline
        lg:block absolute lg:relative
        bottom-2.5 lg:bottom-auto
        left-auto right-auto
        bg-white/65 lg:bg-transparent
        lg:hover:underline lg:underline-offset-2 
        rounded-lg lg:rounded-none 
        px-2 lg:p-0
        py-0.5 
        backdrop-blur-sm lg:backdrop-blur-0 transition ease-in-out"
  x-data="copyToClipboard('<?= $copyText ?>')"
  @click="copyToClipboard"
>
  <?= $buttonText ?>
</button>